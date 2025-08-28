<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Notebook
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('notebooks.update', $notebook) }}" method="post">
                    @csrf
                    @method('put')

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                        <x-text-input 
                            id="name" 
                            name="name" 
                            class="w-full mt-1" 
                            placeholder="Title" 
                            value="{{ old('name', $notebook->name) }}" 
                        />
                        @error('name')
                            <div class="text-sm mt-1 text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="order" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Order</label>
                        <x-text-input 
                            id="order" 
                            name="order" 
                            type="number" 
                            class="w-full mt-1" 
                            placeholder="Order (Default: 9)" 
                            value="{{ old('order', $notebook->order) }}" 
                        />
                        @error('order')
                            <div class="text-sm mt-1 text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <x-primary-button class="mt-6">Update</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>