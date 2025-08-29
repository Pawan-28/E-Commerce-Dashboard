<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user if it doesn't exist
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
            ]
        );

        // Create categories if they don't exist
        $categories = [
            ['name' => 'Electronics', 'slug' => 'electronics'],
            ['name' => 'Clothing', 'slug' => 'clothing'],
            ['name' => 'Books', 'slug' => 'books'],
            ['name' => 'Home & Garden', 'slug' => 'home-garden'],
            ['name' => 'Sports', 'slug' => 'sports'],
        ];

        foreach ($categories as $categoryData) {
            Category::firstOrCreate(['slug' => $categoryData['slug']], $categoryData);
        }

        // Create sample products if they don't exist
        $products = [
            [
                'name' => 'iPhone 15 Pro',
                'description' => 'Latest iPhone with advanced camera system',
                'price' => 999.99,
                'category_id' => 1,
                'images' => [
                    'https://picsum.photos/400/400?random=1',
                    'https://picsum.photos/400/400?random=2'
                ],
                'status' => 'active',
                'stock_count' => 50,
                'featured' => true,
            ],
            [
                'name' => 'Samsung Galaxy S24',
                'description' => 'Premium Android smartphone',
                'price' => 899.99,
                'category_id' => 1,
                'images' => [
                    'https://picsum.photos/400/400?random=3'
                ],
                'status' => 'active',
                'stock_count' => 30,
                'featured' => false,
            ],
            [
                'name' => 'Nike Air Max',
                'description' => 'Comfortable running shoes',
                'price' => 129.99,
                'category_id' => 2,
                'images' => [
                    'https://picsum.photos/400/400?random=4',
                    'https://picsum.photos/400/400?random=5'
                ],
                'status' => 'active',
                'stock_count' => 100,
                'featured' => true,
            ],
            [
                'name' => 'Laravel Documentation',
                'description' => 'Complete guide to Laravel framework',
                'price' => 29.99,
                'category_id' => 3,
                'images' => [
                    'https://picsum.photos/400/400?random=6'
                ],
                'status' => 'active',
                'stock_count' => 200,
                'featured' => false,
            ],
            [
                'name' => 'Garden Tool Set',
                'description' => 'Essential tools for gardening',
                'price' => 79.99,
                'category_id' => 4,
                'images' => [
                    'https://picsum.photos/400/400?random=7'
                ],
                'status' => 'draft',
                'stock_count' => 25,
                'featured' => false,
            ],
        ];

        foreach ($products as $productData) {
            Product::firstOrCreate(
                ['name' => $productData['name'], 'category_id' => $productData['category_id']], 
                $productData
            );
        }

        $this->command->info('Database seeded successfully!');
        $this->command->info('Admin user: admin@example.com / password');
        $this->command->info('Created ' . count($categories) . ' categories and ' . count($products) . ' products');
    }
}
