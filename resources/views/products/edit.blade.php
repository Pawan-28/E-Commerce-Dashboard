<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit Product</h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="bg-green-50 text-green-700 px-4 py-2 rounded mb-3">{{ session('status') }}</div>
            @endif
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="lock_version" value="{{ $product->lock_version }}" />
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block text-sm">Name <span class="text-red-500">*</span></label>
                            <input name="name" class="w-full rounded border-gray-300" required value="{{ $product->name }}" />
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm">Description</label>
                            <textarea name="description" class="w-full rounded border-gray-300">{{ $product->description }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                            <div>
                                <label class="block text-sm">Price</label>
                                <input type="number" step="0.01" name="price" class="w-full rounded border-gray-300" required value="{{ $product->price }}" />
                            </div>
                            <div>
                                <label class="block text-sm">Category</label>
                                <select name="category_id" class="w-full rounded border-gray-300" required>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}" @selected($product->category_id==$cat->id)>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm">Status</label>
                                <select name="status" class="w-full rounded border-gray-300">
                                    @foreach (['draft','active','inactive'] as $st)
                                        <option value="{{ $st }}" @selected($product->status==$st)>{{ ucfirst($st) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-sm">Stock Count <span class="text-red-500">*</span></label>
                                <input type="number" name="stock_count" min="0" required class="w-full rounded border-gray-300" value="{{ $product->stock_count }}" />
                            </div>
                            <div class="flex items-center mt-6">
                                <input type="checkbox" name="featured" value="1" class="mr-2" @checked($product->featured)>
                                <label class="text-sm">Featured</label>
                            </div>
                        </div>
                        
                        <!-- Image Upload Section -->
                        <div>
                            <label class="block text-sm font-medium mb-2">Product Images</label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gray-400 transition-colors">
                                <div class="space-y-2">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="text-sm text-gray-600">
                                        <label for="images" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500">
                                            <span>Upload new images</span>
                                            <input id="images" name="images[]" type="file" multiple accept="image/*" class="sr-only" />
                                        </label>
                                        <p>or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB each</p>
                                </div>
                                
                                <!-- Current Images Display -->
                                @if($product->images && count($product->images) > 0)
                                    <div class="mt-4">
                                        <h4 class="text-sm font-medium text-gray-700 mb-2">Current Images:</h4>
                                        <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                                            @foreach($product->images as $index => $imageUrl)
                                                <div class="relative">
                                                    <img src="{{ $imageUrl }}" alt="Product image {{ $index + 1 }}" class="w-full h-20 object-cover rounded border" />
                                                    <p class="text-xs text-gray-500 mt-1 truncate">Image {{ $index + 1 }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <a href="{{ route('products.index') }}" class="px-4 py-2 rounded border">Back</a>
                            <div>
                                <x-primary-button>Save</x-primary-button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Simple drag and drop functionality
        const uploadArea = document.querySelector('.border-dashed');
        const imageInput = document.getElementById('images');

        // Drag and drop handlers
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.classList.add('border-indigo-400', 'bg-indigo-50');
        });

        uploadArea.addEventListener('dragleave', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('border-indigo-400', 'bg-indigo-50');
        });

        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('border-indigo-400', 'bg-indigo-50');
            
            const files = e.dataTransfer.files;
            imageInput.files = files;
        });
    </script>
</x-app-layout>



