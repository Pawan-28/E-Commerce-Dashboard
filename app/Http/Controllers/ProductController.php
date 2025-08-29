<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::query()->with('category');
    
        // Category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
    
        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
    
        // Featured filter
        if ($request->filled('featured')) {
            $query->where('featured', $request->featured);
        }
    
        // Price Range filter
        if ($request->filled('price_range')) {
            switch ($request->price_range) {
                case '0-50':
                    $query->whereBetween('price', [0, 50]);
                    break;
                case '50-100':
                    $query->whereBetween('price', [50, 100]);
                    break;
                case '100-500':
                    $query->whereBetween('price', [100, 500]);
                    break;
                case '500+':
                    $query->where('price', '>=', 500);
                    break;
            }
        }
    
        $products = $query->orderByDesc('id')->paginate(15)->withQueryString();
        $categories = Category::orderBy('name')->get();
    
        return view('products.index', compact('products', 'categories'));
    }
    

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
    
        // Handle multiple image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $imagePaths[] = '/storage/' . $path;
            }
        }
        $data['images'] = $imagePaths;
    
        $data['featured'] = $request->has('featured');
        $data['lock_version'] = 0;
    
        $product = Product::create($data);
    
        return redirect()->route('products.edit', $product)
            ->with('status', 'Product created successfully!');
    }
    

    public function edit(Product $product): View
    {
        $categories = Category::orderBy('name')->get();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $data = $this->validatedData($request, $product);
    
        // Agar new images aayi hain to purani + nayi merge karo
        $imagePaths = $product->images ?? [];
    
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $imagePaths[] = '/storage/' . $path;
            }
        }
    
        $data['images'] = $imagePaths;
        $data['featured'] = $request->has('featured');
        $data['lock_version'] = $product->lock_version + 1;
    
        $product->update($data);
    
        return redirect()->route('products.edit', $product)
            ->with('status', 'Product updated successfully!');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return redirect()->route('products.index')->with('status', 'Product deleted');
    }

    public function bulkUpdate(Request $request): RedirectResponse
    {
        // Log the request data for debugging
        \Log::info('Bulk Update Request:', $request->all());
        
        $payload = $request->validate([
            'ids' => ['required', 'string'], // JSON string from JavaScript
            'action' => ['required', Rule::in(['update_price', 'update_stock', 'update_status'])],
            'price_value' => ['nullable', 'numeric', 'min:0'],
            'stock_value' => ['nullable', 'integer', 'min:0'],
            'status_value' => ['nullable', 'string', Rule::in(['active', 'draft', 'archived'])],
        ]);

        // Parse the JSON string to get the array of IDs
        $ids = json_decode($payload['ids'], true);
        if (!is_array($ids)) {
            return back()->withErrors(['ids' => 'Invalid product selection']);
        }
        
        // Remove duplicates and validate IDs
        $ids = array_unique($ids);
        if (empty($ids)) {
            return back()->withErrors(['ids' => 'No valid products selected']);
        }

        \Log::info('Parsed IDs:', ['ids' => $ids]);
        \Log::info('Action:', ['action' => $payload['action']]);
        \Log::info('Values:', [
            'price_value' => $payload['price_value'] ?? 'not set',
            'stock_value' => $payload['stock_value'] ?? 'not set',
            'status_value' => $payload['status_value'] ?? 'not set'
        ]);

        DB::transaction(function () use ($ids, $payload) {
            $products = Product::whereIn('id', $ids)->lockForUpdate()->get();
            foreach ($products as $product) {
                \Log::info("Updating product", ['id' => $product->id, 'name' => $product->name]);
                
                if ($payload['action'] === 'update_price' && isset($payload['price_value'])) {
                    $oldPrice = $product->price;
                    $product->price = (float) $payload['price_value'];
                    \Log::info("Price updated", [
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'old_price' => $oldPrice,
                        'new_price' => $product->price
                    ]);
                } elseif ($payload['action'] === 'update_status' && isset($payload['status_value'])) {
                    $oldStatus = $product->status;
                    $product->status = (string) $payload['status_value'];
                    \Log::info("Status updated", [
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'old_status' => $oldStatus,
                        'new_status' => $product->status
                    ]);
                } elseif ($payload['action'] === 'update_stock' && isset($payload['stock_value'])) {
                    $oldStock = $product->stock_count;
                    $product->stock_count = (int) $payload['stock_value'];
                    \Log::info("Stock updated", [
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'old_stock' => $oldStock,
                        'new_stock' => $product->stock_count
                    ]);
                }
                $product->lock_version++;
                $product->save();
            }
        });

        return back()->with('status', 'Bulk update completed successfully!');
    }

    public function importCsv(Request $request): RedirectResponse
    {
        $request->validate([
            'csv_file' => ['required', 'file', 'mimes:csv,txt', 'max:10240'],
        ]);

        $file = $request->file('csv_file');
        $path = $file->getRealPath();
        $handle = fopen($path, 'r');
        
        if (!$handle) {
            return back()->withErrors(['csv_file' => 'Could not read the CSV file']);
        }

        $header = fgetcsv($handle);
        if (!$header) {
            fclose($handle);
            return back()->withErrors(['csv_file' => 'Invalid CSV format - no header row found']);
        }

        $rowNum = 1;
        $errors = [];
        $imported = 0;
        $updated = 0;

        DB::beginTransaction();
        try {
            while (($row = fgetcsv($handle)) !== false) {
                $rowNum++;
                $data = array_combine($header, $row);
                if (!$data) {
                    $errors[] = "Row {$rowNum}: Invalid columns";
                    continue;
                }
                
                $name = trim((string)($data['name'] ?? ''));
                $price = (float)($data['price'] ?? 0);
                $categoryName = trim((string)($data['category'] ?? ''));
                
                if ($name === '' || $price <= 0 || $categoryName === '') {
                    $errors[] = "Row {$rowNum}: Missing or invalid required fields (name, price, category)";
                    continue;
                }

                // Create or find category
                $category = Category::firstOrCreate([
                    'name' => $categoryName,
                ]);

                // Check if product exists
                $product = Product::where('name', $name)->where('category_id', $category->id)->first();
                $isNew = !$product;
                
                if (!$product) {
                    $product = new Product();
                    $product->lock_version = 0;
                    $imported++;
                } else {
                    $updated++;
                }

                $product->fill([
                    'name' => $name,
                    'description' => $data['description'] ?? ($product->description ?? ''),
                    'price' => $price,
                    'status' => $data['status'] ?? ($product->status ?? 'active'),
                    'stock_count' => (int)($data['stock_count'] ?? ($product->stock_count ?? 0)),
                    'featured' => (bool)($data['featured'] ?? ($product->featured ?? false)),
                    'images' => $this->parseImages($data['images'] ?? ''),
                    'category_id' => $category->id,
                ]);

                if (!$isNew) {
                    $product->lock_version++;
                }

                $product->save();
            }
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            $errors[] = 'Import failed: ' . $e->getMessage();
        } finally {
            fclose($handle);
        }

        $message = "Import completed successfully! ";
        if ($imported > 0) $message .= "Imported: {$imported} ";
        if ($updated > 0) $message .= "Updated: {$updated} ";
        if (!empty($errors)) {
            $message .= "Errors: " . count($errors);
            return back()->with('status', $message)->with('import_errors', $errors);
        }
        
        return back()->with('status', $message);
    }

    public function csvTemplate(): \Symfony\Component\HttpFoundation\Response
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="products_template.csv"',
        ];

        $callback = function() {
            $file = fopen('php://output', 'w');
            
            // Add headers
            fputcsv($file, ['name', 'description', 'price', 'category', 'status', 'stock_count', 'featured', 'images']);
            
            // Add sample data
            fputcsv($file, ['Sample Product', 'This is a sample product description', '29.99', 'Electronics', 'active', '100', '1', 'image1.jpg,image2.jpg']);
            fputcsv($file, ['Another Product', 'Another sample product', '49.99', 'Clothing', 'active', '50', '0', '']);
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function validatedData(Request $request, ?Product $product = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'images' => ['nullable', 'array'],
            'images.*' => ['file', 'image', 'max:10240'], // 10MB max
            'status' => ['required', 'string'],
            'stock_count' => ['required', 'integer', 'min:0'],
            'featured' => ['sometimes', 'boolean'],
        ]);
    }

    private function parseImages(string $imagesCsv): array
    {
        $parts = array_filter(array_map('trim', explode(',', $imagesCsv)));
        return array_values($parts);
    }
}