<?php

use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Product Management Dashboard routes
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('products', ProductController::class)->except(['show']);
    Route::post('products/bulk-update', [ProductController::class, 'bulkUpdate'])->name('products.bulk-update');
    Route::post('products/import-csv', [ProductController::class, 'importCsv'])->name('products.import-csv');
    Route::get('products/csv-template', [ProductController::class, 'csvTemplate'])->name('products.csv-template');
    Route::get('audit-logs', [AuditLogController::class, 'index'])->name('audit.index');
    
    // Test route for debugging
    Route::get('/test-product', function() {
        try {
            $product = new \App\Models\Product();
            $product->name = 'Test Product';
            $product->description = 'Test Description';
            $product->price = 99.99;
            $product->category_id = 1;
            $product->status = 'active';
            $product->stock_count = 100;
            $product->featured = false;
            $product->lock_version = 0;
            $product->images = [];
            $result = $product->save();
            
            return response()->json([
                'success' => $result,
                'product_id' => $product->id,
                'message' => $result ? 'Product created successfully' : 'Failed to create product'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    })->name('test.product');
});

require __DIR__.'/auth.php';
