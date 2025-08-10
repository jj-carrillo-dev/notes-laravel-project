<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Notebooks
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-link-button href="{{ route('notebooks.create') }}">
                New Notebook
            </x-link-button>

            @forelse ($notebooks as $notebook)
                <x-custom.notebook-card :notebook="$notebook" />
            @empty
                <p class="mt-2 text-gray-900 dark:text-gray-100">
                    You don't have notebooks
                </p>
            @endforelse

            {{ $notebooks->links() }}
        </div>
    </div>
</x-app-layout>