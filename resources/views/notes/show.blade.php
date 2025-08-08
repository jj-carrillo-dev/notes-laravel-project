<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Notes
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>

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
                <form action="{{ route('notes.destroy', $note) }}"  method="post">
                    @method('delete')
                    @csrf
                    <button type="button" 
                            class="bg-red-500 hover:bg-red-600 focus:bg-red-600 px-4 py-2 text-white font-bold rounded-lg"
                            onclick="showModal('delete-modal-{{ $note->id }}')">
                        Delete
                    </button>
                    <div id="delete-modal-{{ $note->id }}" class="fixed inset-0 z-50 hidden items-center justify-center bg-gray-900 bg-opacity-50">
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl w-full max-w-sm mx-auto">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Confirmación de eliminación</h3>
                            <p class="text-sm mt-2 text-gray-600 dark:text-gray-400">¿Estás seguro de que quieres eliminar esta nota? Esta acción no se puede deshacer.</p>
    
                            <div class="mt-4 flex justify-end gap-2">
                                <button type="button"
                                        class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 focus:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
                                        onclick="hideModal('delete-modal-{{ $note->id }}')">
                                    Cancelar
                                </button>
                                
                                <button type="submit"
                                        class="px-4 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700 focus:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                    Confirmar
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <script>
                    function showModal(id) {
                        document.getElementById(id).classList.remove('hidden');
                        document.getElementById(id).classList.add('flex');
                    }

                    function hideModal(id) {
                        document.getElementById(id).classList.add('hidden');
                        document.getElementById(id).classList.remove('flex');
                    }
                </script>
            </div>
            <div class="bg-white dark:bg-gray-800 p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-4xl text-indigo-600">
                    {{ $note->title }}
                </h2>
                <p class="font-bold text-2xl">
                    Notebook: {{ $note->notebook->name }}
                </p>  
                <p class="mt-4 whitespace-pre-wrap text-gray-900 dark:text-gray-100">{{ $note->text }}</p>
            </div>

        </div>
    </div>
</x-app-layout>
