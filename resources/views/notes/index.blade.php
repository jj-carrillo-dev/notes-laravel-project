<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @unless (request()->routeIs('notes.index'))
                Trash
            @else
                Notes
            @endunless
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (request()->routeIs('notes.index'))
                <x-link-button href="{{ route('notes.create') }}">
                    New Note
                </x-link-button>
            @endif
            
            {{-- Filters --}}
            <x-custom.note-filter :notebooks="$notebooks" />

            @forelse ($notes as $note)
                <x-custom.note-card :note="$note" />
            @empty
                <p class="mt-2 text-gray-900 dark:text-gray-100">
                    You don't have notes
                </p>
            @endforelse
            {{ $notes->links() }}
        </div>
    </div>
</x-app-layout>