<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit Category</h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <form method="POST" action="{{ route('categories.update', $category) }}">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm">Name</label>
                            <input name="name" class="w-full rounded border-gray-300" required value="{{ $category->name }}" />
                        </div>
                        <div>
                            <label class="block text-sm">Slug</label>
                            <input name="slug" class="w-full rounded border-gray-300" required value="{{ $category->slug }}" />
                        </div>
                        <div class="flex justify-between items-center">
                            <a href="{{ route('categories.index') }}" class="px-4 py-2 rounded border">Back</a>
                            <x-primary-button>Save</x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>



