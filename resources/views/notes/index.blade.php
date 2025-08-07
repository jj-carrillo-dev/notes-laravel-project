<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Notes
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-link-button href="{{ route('notes.create') }}">
                New Note
            </x-link-button>
            @forelse ($notes as $note)
                <div class="bg-white dark:bg-gray-800 p-6 overflow-hidden shadow-sm sm:rounded-lg">
                    <h2 class="font-bold text-2xl text-indigo-600">
                        <a href="{{ route('notes.show', $note) }}" class="hover:underline">
                            {{ $note->title }}
                        </a>
                    </h2> 
                    <p class="mt-2 text-gray-900 dark:text-gray-100">
                        {{ Str::limit($note->text, 250, '...') }}
                    </p>
                    @if ($note->updated_at == null )
                        <span class="block mt-4 text-sm opacity-70">Created: {{ $note->created_at->diffForHumans() }}</span>
                    @else
                        <span class="block mt-4 text-sm opacity-70">Updated: {{ $note->updated_at->diffForHumans() }}</span>
                    @endif
                </div>
            @empty
                <p class="mt-2 text-gray-900 dark:text-gray-100">
                    You don-t have notes
                </p>
            @endforelse
            {{ $notes->links() }}
        </div>
    </div>
</x-app-layout>
