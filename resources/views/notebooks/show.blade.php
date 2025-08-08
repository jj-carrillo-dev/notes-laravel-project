<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Notebooks
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex gap-6">
                <p class="opacity-70">
                    <span class="font-bold">Created:</span> {{ $notebook->created_at->diffForHumans() }}
                </p>
                @if ($notebook->updated_at != null)
                    
                    <p class="bold opacity-70">
                        <span class="font-bold">Last changed:</span> {{ $notebook->updated_at->diffForHumans() }}
                    </p>
                @endif
                 <x-link-button class="ml-auto" href="{{ route('notebooks.edit', $notebook) }}">
                    Edit Notebook
                </x-link-button>
            </div>
            <div class="bg-white dark:bg-gray-800 p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-4xl text-indigo-600">
                    {{ $notebook->name }}
                </h2> 
            </div>

        </div>
    </div>
</x-app-layout>
