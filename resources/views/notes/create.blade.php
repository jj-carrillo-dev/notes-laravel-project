<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Notes
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('notes.store') }}" method="post">
                    
                    @csrf

                    <x-text-input name="title" class="w-full" placeholder="Title" value="{{ @old('title') }}"></x-text-input>
                    @error('title')
                        <div class="text-sm mt-1 text-red-500">
                            {{ $message }}
                        </div>
                    @enderror

                    <x-textarea name="text" class="w-full mt-6" placeholder="Text" rows="8"  value="{{ @old('text') }}"></x-textarea>
                    @error('text')
                        <div class="text-sm mt-1 text-red-500">
                            {{ $message }}
                        </div>
                    @enderror

                    <x-forms.select id="notebook_id" name="notebook_id" class="mt-1 block w-full" :options="$notebooks->pluck('name', 'id')">
                        <option value="">-- Select Notebook --</option>
                    </x-forms.select>
                    @error('notebook_id')
                        <div class="text-sm mt-1 text-red-500">
                            The notebook field is required.
                        </div>
                    @enderror

                    <x-primary-button href="{{ route('notes.create') }}" class="mt-6">
                        Create
                    </x-primary-button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
