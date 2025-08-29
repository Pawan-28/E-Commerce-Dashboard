<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create a test user
        $this->user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);
        
        // Create a test category
        $this->category = Category::create([
            'name' => 'Test Category',
            'slug' => 'test-category',
        ]);
    }

    public function test_user_can_view_products_list()
    {
        $response = $this->actingAs($this->user)->get('/products');
        
        $response->assertStatus(200);
        $response->assertViewIs('products.index');
    }

    public function test_user_can_create_product()
    {
        $productData = [
            'name' => 'Test Product',
            'description' => 'Test Description',
            'price' => 99.99,
            'category_id' => $this->category->id,
            'status' => 'active',
            'stock_count' => 10,
            'featured' => false,
            'images' => ['https://example.com/image.jpg'],
        ];

        $response = $this->actingAs($this->user)->post('/products', $productData);
        
        $response->assertRedirect();
        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'price' => 99.99,
        ]);
    }

    public function test_user_can_update_product()
    {
        $product = Product::create([
            'name' => 'Original Name',
            'description' => 'Original Description',
            'price' => 50.00,
            'category_id' => $this->category->id,
            'status' => 'draft',
            'stock_count' => 5,
            'featured' => false,
            'images' => [],
            'lock_version' => 0,
        ]);

        $updateData = [
            'name' => 'Updated Name',
            'description' => 'Updated Description',
            'price' => 75.00,
            'category_id' => $this->category->id,
            'status' => 'active',
            'stock_count' => 15,
            'featured' => true,
            'images' => ['https://example.com/updated.jpg'],
            'lock_version' => 0,
        ];

        $response = $this->actingAs($this->user)->put("/products/{$product->id}", $updateData);
        
        $response->assertRedirect();
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Name',
            'price' => 75.00,
        ]);
    }

    public function test_user_can_delete_product()
    {
        $product = Product::create([
            'name' => 'Product to Delete',
            'description' => 'Will be deleted',
            'price' => 25.00,
            'category_id' => $this->category->id,
            'status' => 'active',
            'stock_count' => 1,
            'featured' => false,
            'images' => [],
            'lock_version' => 0,
        ]);

        $response = $this->actingAs($this->user)->delete("/products/{$product->id}");
        
        $response->assertRedirect();
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    public function test_bulk_update_products()
    {
        // Create multiple products
        $products = [];
        for ($i = 1; $i <= 3; $i++) {
            $products[] = Product::create([
                'name' => "Product {$i}",
                'description' => "Description {$i}",
                'price' => 10.00 * $i,
                'category_id' => $this->category->id,
                'status' => 'draft',
                'stock_count' => $i * 5,
                'featured' => false,
                'images' => [],
                'lock_version' => 0,
            ]);
        }

        $productIds = array_column($products, 'id');
        
        $response = $this->actingAs($this->user)->post('/products/bulk-update', [
            'ids' => $productIds,
            'action' => 'status',
            'value' => 'active',
        ]);
        
        $response->assertRedirect();
        
        foreach ($products as $product) {
            $this->assertDatabaseHas('products', [
                'id' => $product->id,
                'status' => 'active',
            ]);
        }
    }

    public function test_csv_import_products()
    {
        $csvContent = "name,description,price,category,status,stock_count,featured,images\n";
        $csvContent .= "Imported Product,Imported Description,29.99,Test Category,active,50,false,https://example.com/imported.jpg";
        
        $file = $this->createTempFile($csvContent, 'products.csv');
        
        $response = $this->actingAs($this->user)->post('/products/import-csv', [
            'file' => $file,
        ]);
        
        $response->assertRedirect();
        $this->assertDatabaseHas('products', [
            'name' => 'Imported Product',
            'price' => 29.99,
        ]);
    }

    public function test_products_filtering()
    {
        // Create products with different statuses
        Product::create([
            'name' => 'Active Product',
            'description' => 'Active product',
            'price' => 100.00,
            'category_id' => $this->category->id,
            'status' => 'active',
            'stock_count' => 10,
            'featured' => false,
            'images' => [],
            'lock_version' => 0,
        ]);

        Product::create([
            'name' => 'Draft Product',
            'description' => 'Draft product',
            'price' => 50.00,
            'category_id' => $this->category->id,
            'status' => 'draft',
            'stock_count' => 5,
            'featured' => false,
            'images' => [],
            'lock_version' => 0,
        ]);

        $response = $this->actingAs($this->user)->get('/products?status=active');
        
        $response->assertStatus(200);
        $response->assertSee('Active Product');
        $response->assertDontSee('Draft Product');
    }

    private function createTempFile($content, $filename)
    {
        $tempFile = tempnam(sys_get_temp_dir(), 'test_csv_');
        file_put_contents($tempFile, $content);
        
        return new \Illuminate\Http\UploadedFile(
            $tempFile,
            $filename,
            'text/csv',
            null,
            true
        );
    }
}
