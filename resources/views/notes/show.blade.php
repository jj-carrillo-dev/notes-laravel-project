<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                @unless ($note->trashed())
                    Note: {{ $note->title }}
                @else
                    Note In Trash: {{ $note->title }}
                @endunless
            </h2>
            <span class="inline-flex items-center px-2.5 py-1.5 rounded text-sm font-medium bg-blue-100 text-blue-800 border border-blue-600">
                {{ $note->notebook->name }}
            </span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>

            @unless ($note->trashed())
                <div class="flex gap-6">
                    <p class="opacity-70">
                        <span class="font-bold">Created:</span> {{ $note->created_at->diffForHumans() }}
                    </p>
                    
                    @unless($note->created_at->eq($note->updated_at))
                      <p class="opacity-70">
                            <span class="font-bold">Last changed:</span> {{ $note->updated_at->diffForHumans() }}
                        </p>
                    @endunless
 
                    <x-link-button class="ml-auto" href="{{ route('notes.edit', $note) }}">
                        Edit Note
                    </x-link-button>
                    <x-custom.confirmation-modal
                        :action="route('notes.destroy', $note)"
                        :note="$note"
                        title="Confirmation"
                        confirm-text="Delete">
                        Move to Trash
                    </x-custom.confirmation-modal>
                </div>
            @else
                <div class="flex gap-6">
                    <p class="opacity-70">
                        <span class="font-bold">Deleted:</span> {{ $note->deleted_at->diffForHumans() }}
                    </p>

                    <x-custom.restore-button class="ml-auto" :action="route('trashed.update', $note)">
                        Restore
                    </x-custom.restore-button>
                    <x-custom.confirmation-modal
                        :action="route('trashed.destroy', $note)"
                        :note="$note"
                        title="Confirmation Delete"
                        message="Are you sure you want to permanent delete the note?"
                        confirm-text="Delete">
                        Delete Forever
                    </x-custom.confirmation-modal>

                </div>
            @endunless

            <div class="bg-white dark:bg-gray-800 p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <p class="whitespace-pre-wrap text-gray-900 dark:text-gray-100">{{ $note->text }}</p>
            </div>

        </div>
    </div>
</x-app-layout>