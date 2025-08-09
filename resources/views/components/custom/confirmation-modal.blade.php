<form action="{{ $action }}" method="post">
    @method('delete')
    @csrf
    
    <x-custom.danger-button 
        type="button" 
        onclick="showModal('delete-modal-{{ $note->id }}')">
        {{ $slot }}
    </x-custom.danger-button>
    
    <div id="delete-modal-{{ $note->id }}" class="fixed inset-0 z-50 hidden items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl w-full max-w-sm mx-auto">
            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ $title }}</h3>
            <p class="text-sm mt-2 text-gray-600 dark:text-gray-400">{{ $message }}</p>
            
            <div class="mt-4 flex justify-end gap-2">
                <button type="button"
                        class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 focus:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
                        onclick="hideModal('delete-modal-{{ $note->id }}')">
                    Cancelar
                </button>
                
                <button type="submit"
                        class="px-4 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700 focus:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                    {{ $confirmText }}
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