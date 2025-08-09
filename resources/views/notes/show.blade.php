<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ !$note->trashed() ? 'Note' : 'Note In Trash' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <p>
                <span class="inline-flex items-center px-2.5 py-1.5 rounded text-sm font-medium bg-blue-100 text-blue-800 border border-blue-600">
                    {{ $note->notebook->name }}
                </span>
            </p>
            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>

            @if (!$note->trashed())
                <div class="flex gap-6">
                    <p class="opacity-70">
                        <span class="font-bold">Created:</span> {{ $note->created_at->diffForHumans() }}
                    </p>
                    @if ($note->updated_at != null)
                        
                        <p class="bold opacity-70">
                            <span class="font-bold">Last changed:</span> {{ $note->updated_at->diffForHumans() }}
                        </p>
                    @endif
                    <x-link-button class="ml-auto" href="{{ route('notes.edit', $note) }}">
                        Edit Note
                    </x-link-button>
                    <x-custom.confirmation-modal :action="route('notes.destroy', $note)" :note="$note" title="Confirmation" confirm-text="Delete">
                        Move to Trash
                    </x-custom.confirmation-modal>
                </div>
            @else
                <div class="flex gap-6">
                    <p class="opacity-70">
                        <span class="font-bold">Deleted:</span> {{ $note->deleted_at->diffForHumans() }}
                    </p>

                    <form class="ml-auto" action="{{ route('trashed.update', $note) }}" method="post">
                        @method('put')
                        @csrf
                        <x-primary-button>Restore</x-primary-button>
                    </form>

                    <!--
                    <x-link-button class="ml-auto" href="{{ route('notes.edit', $note) }}">
                        Edit Note
                    </x-link-button>
                    <x-custom.confirmation-modal :action="route('notes.destroy', $note)" :note="$note" title="Confirmation" confirm-text="Delete">
                        Move to Trash
                    </x-custom.confirmation-modal>
                    -->
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <h3 class="font-bold text-2xl text-indigo-600">
                    {{ $note->title }}
                </h3>

                <p class="mt-4 whitespace-pre-wrap text-gray-900 dark:text-gray-100">{{ $note->text }}</p>
            </div>

        </div>
    </div>
</x-app-layout>
