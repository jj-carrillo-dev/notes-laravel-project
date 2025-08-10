@props(['notebooks'])

<form action="{{ route('notes.index') }}" method="GET" class="flex items-end gap-4">
    @if (request()->routeIs('notes.index'))
        <div class="w-full sm:w-1/3">
            <label for="notebook_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Notebook
            </label>
            <x-forms.select id="notebook_id" name="notebook_id" class="mt-1 block w-full"
                            onchange="this.form.submit()"
                            :options="$notebooks->pluck('name', 'id')"
                            :selected="request('notebook_id')">
                <option value="">-- Select Notebook --</option>
            </x-forms.select>
        </div>
    @endif

    <div class="w-full sm:w-1/3">
        <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            Search
        </label>
        <x-text-input type="text" id="search" name="search" placeholder="Search notes..." class="w-full"
            value="{{ request('search') }}" />
    </div>

    <div>
        <x-primary-button type="submit">Search</x-primary-button>
    </div>
</form>