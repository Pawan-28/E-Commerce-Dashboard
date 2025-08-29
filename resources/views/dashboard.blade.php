<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
            <h2 class="font-bold text-xl sm:text-2xl text-gray-800 dark:text-gray-100">
                 E-commerce Dashboard
            </h2>
            <div class="text-sm text-gray-600 dark:text-gray-400">
                Welcome back, {{ Auth::user()->name }}! 👋
            </div>
        </div>
    </x-slot>

    <div class="py-4 sm:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 sm:space-y-8">
            
            <!-- Stats Cards -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl sm:rounded-2xl shadow-lg p-4 sm:p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-xs sm:text-sm font-medium">Total Products</p>
                            <p class="text-2xl sm:text-3xl font-bold">{{ \App\Models\Product::count() }}</p>
                        </div>
                        <div class="p-2 sm:p-3 bg-blue-400/30 rounded-full">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 sm:mt-4">
                        <span class="text-blue-100 text-xs sm:text-sm">Active inventory</span>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl sm:rounded-2xl shadow-lg p-4 sm:p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-xs sm:text-sm font-medium">Categories</p>
                            <p class="text-2xl sm:text-3xl font-bold">{{ \App\Models\Category::count() }}</p>
                        </div>
                        <div class="p-2 sm:p-3 bg-green-400/30 rounded-full">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 sm:mt-4">
                        <span class="text-green-100 text-xs sm:text-sm">Product groups</span>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl sm:rounded-2xl shadow-lg p-4 sm:p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-100 text-xs sm:text-sm font-medium">Featured</p>
                            <p class="text-2xl sm:text-3xl font-bold">{{ \App\Models\Product::where('featured', true)->count() }}</p>
                        </div>
                        <div class="p-2 sm:p-3 bg-purple-400/30 rounded-full">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 sm:mt-4">
                        <span class="text-purple-100 text-xs sm:text-sm">Star products</span>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl sm:rounded-2xl shadow-lg p-4 sm:p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-orange-100 text-xs sm:text-sm font-medium">Low Stock</p>
                            <p class="text-2xl sm:text-3xl font-bold">{{ \App\Models\Product::where('stock_count', '<', 10)->count() }}</p>
                        </div>
                        <div class="p-2 sm:p-3 bg-orange-400/30 rounded-full">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 sm:mt-4">
                        <span class="text-orange-100 text-xs sm:text-sm">Need attention</span>
                    </div>
                </div>
            </div>

            <!-- Main Navigation Cards -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8">
                <!-- Products Card -->
                <div class="group relative overflow-hidden bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 rounded-2xl sm:rounded-3xl border border-blue-200 dark:border-blue-700 hover:shadow-2xl hover:scale-105 transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-400/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative p-6 sm:p-8">
                        <div class="flex items-center justify-between mb-4 sm:mb-6">
                            <div class="p-3 sm:p-4 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl sm:rounded-2xl shadow-lg">
                                <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                    {{ \App\Models\Product::count() }} items
                                </span>
                            </div>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-bold text-blue-900 dark:text-blue-100 mb-2 sm:mb-3">Products</h3>
                        <p class="text-blue-700 dark:text-blue-300 mb-4 sm:mb-6 leading-relaxed text-sm sm:text-base">
                            Manage your product catalog, inventory, pricing, and featured items with our comprehensive product management system.
                        </p>
                        <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 sm:px-6 py-2 sm:py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold rounded-lg sm:rounded-xl hover:from-blue-600 hover:to-blue-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl text-sm sm:text-base">
                            Manage Products
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Categories Card -->
                <div class="group relative overflow-hidden bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 rounded-2xl sm:rounded-3xl border border-green-200 dark:border-green-700 hover:shadow-2xl hover:scale-105 transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-green-400/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative p-6 sm:p-8">
                        <div class="flex items-center justify-between mb-4 sm:mb-6">
                            <div class="p-3 sm:p-4 bg-gradient-to-br from-green-500 to-green-600 rounded-xl sm:rounded-2xl shadow-lg">
                                <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                    {{ \App\Models\Category::count() }} groups
                                </span>
                            </div>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-bold text-green-900 dark:text-green-100 mb-2 sm:mb-3">Categories</h3>
                        <p class="text-green-700 dark:text-green-300 mb-4 sm:mb-6 leading-relaxed text-sm sm:text-base">
                            Organize your products into logical categories and groups for better customer navigation and inventory management.
                        </p>
                        <a href="{{ route('categories.index') }}" class="inline-flex items-center px-4 sm:px-6 py-2 sm:py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold rounded-lg sm:rounded-xl hover:from-green-600 hover:to-green-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl text-sm sm:text-base">
                            Manage Categories
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Audit Logs Card -->
                <div class="group relative overflow-hidden bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20 rounded-2xl sm:rounded-3xl border border-purple-200 dark:border-purple-700 hover:shadow-2xl hover:scale-105 transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-400/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative p-6 sm:p-8">
                        <div class="flex items-center justify-between mb-4 sm:mb-6">
                            <div class="p-3 sm:p-4 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl sm:rounded-2xl shadow-lg">
                                <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                                    Track changes
                                </span>
                            </div>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-bold text-purple-900 dark:text-purple-100 mb-2 sm:mb-3">Audit Logs</h3>
                        <p class="text-purple-700 dark:text-purple-300 mb-4 sm:mb-6 leading-relaxed text-sm sm:text-base">
                            Monitor all changes, track user activities, and maintain a complete audit trail of your e-commerce operations.
                        </p>
                        <a href="{{ route('audit.index') }}" class="inline-flex items-center px-4 sm:px-6 py-2 sm:py-3 bg-gradient-to-r from-purple-500 to-purple-600 text-white font-semibold rounded-lg sm:rounded-xl hover:from-purple-600 hover:to-purple-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl text-sm sm:text-base">
                            View Logs
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Section -->
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 rounded-2xl sm:rounded-3xl p-6 sm:p-8 border border-gray-200 dark:border-gray-600">
                <div class="text-center mb-6 sm:mb-8">
                    <div class="inline-flex items-center justify-center w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl sm:rounded-2xl mb-4 shadow-lg">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">Quick Actions</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-base sm:text-lg">Get started with common tasks</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8 max-w-4xl mx-auto">
                    <!-- Add Product -->
                    <a href="{{ route('products.create') }}" class="group relative overflow-hidden bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 rounded-xl sm:rounded-2xl p-4 sm:p-6 border-2 border-blue-200 dark:border-blue-700 hover:border-blue-400 dark:hover:border-blue-500 hover:shadow-2xl hover:scale-105 transition-all duration-300 transform">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-400/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative">
                            <div class="flex items-center justify-center w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl sm:rounded-2xl mb-4 shadow-lg group-hover:shadow-xl transition-all duration-300">
                                <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <h4 class="text-lg sm:text-xl font-bold text-blue-900 dark:text-blue-100 mb-2 group-hover:text-blue-700 dark:group-hover:text-blue-300 transition-colors">Add Product</h4>
                            <p class="text-blue-700 dark:text-blue-300 text-xs sm:text-sm leading-relaxed">Create new product with images, pricing, and inventory details</p>
                            <div class="mt-3 sm:mt-4 flex items-center text-blue-600 dark:text-blue-400 text-xs sm:text-sm font-medium group-hover:text-blue-700 dark:group-hover:text-blue-300 transition-colors">
                                <span>Get Started</span>
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </div>
                        </div>
                    </a>

                    <!-- Add Category -->
                    <a href="{{ route('categories.create') }}" class="group relative overflow-hidden bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 rounded-xl sm:rounded-2xl p-4 sm:p-6 border-2 border-green-200 dark:border-green-700 hover:border-green-400 dark:hover:border-green-500 hover:shadow-2xl hover:scale-105 transition-all duration-300 transform">
                        <div class="absolute inset-0 bg-gradient-to-br from-green-400/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative">
                            <div class="flex items-center justify-center w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-xl sm:rounded-2xl mb-4 shadow-lg group-hover:shadow-xl transition-all duration-300">
                                <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                            <h4 class="text-lg sm:text-xl font-bold text-green-900 dark:text-green-100 mb-2 group-hover:text-green-700 dark:group-hover:text-green-300 transition-colors">Add Category</h4>
                            <p class="text-green-700 dark:text-green-300 text-xs sm:text-sm leading-relaxed">Organize products into logical groups and categories</p>
                            <div class="mt-3 sm:mt-4 flex items-center text-green-600 dark:text-green-400 text-xs sm:text-sm font-medium group-hover:text-green-700 dark:group-hover:text-green-300 transition-colors">
                                <span>Get Started</span>
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Recent Activity Section - Outside Box -->
            <div class="mt-6 sm:mt-8 text-center">
                <h3 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">Recent Activity</h3>
                <div class="max-w-2xl mx-auto">
                    @php
                        $recentLogs = \App\Models\AuditLog::with('admin')->latest()->take(5)->get();
                    @endphp
                    
                    @if($recentLogs->count() > 0)
                        <div class="space-y-3 sm:space-y-4">
                            @foreach($recentLogs as $log)
                                <div class="flex items-center justify-center space-x-3 sm:space-x-4 p-3 sm:p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg sm:rounded-xl">
                                    <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </div>
                                    <div class="text-left">
                                        <p class="text-xs sm:text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ ucfirst($log->action) }} on {{ class_basename($log->model_changed) }}
                                        </p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">
                                            {{ $log->admin?->name ?? 'System' }} • {{ $log->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-6 sm:py-8 text-gray-500 dark:text-gray-400">
                            <svg class="w-12 h-12 sm:w-16 sm:h-16 mx-auto mb-4 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <p class="text-base sm:text-lg font-medium">No recent activity</p>
                            <p class="text-xs sm:text-sm mt-1">Start managing your products to see activity here</p>
                        </div>
                    @endif
                </div>
            </div>
        </div> 
    </div>
</x-app-layout>
