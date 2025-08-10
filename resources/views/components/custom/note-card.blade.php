@props(['note'])

<div class="bg-white dark:bg-gray-800 p-6 overflow-hidden shadow-sm sm:rounded-lg">
    <h2 class="font-bold text-lg text-blue-600">
        @php
            $noteRoute = $note->trashed() ? route('trashed.show', $note) : route('notes.show', $note);
        @endphp
        <a href="{{ $noteRoute }}" class="hover:underline">
            {{ $note->title }}
        </a>
    </h2>
    <p class="mt-2 text-gray-900 dark:text-gray-100">
        {{ Str::limit($note->text, 250, '...') }}
    </p>
    <p class="mt-2">
        <span class="mt-4 text-sm opacity-70"><span class="font-bold">Created:</span> {{ $note->created_at->diffForHumans() }}</span>
        @unless($note->created_at->eq($note->updated_at))
            <span class="mt-4 text-sm opacity-70">| <span class="font-bold">Updated:</span> {{ $note->updated_at->diffForHumans() }}</span>
        @endunless
    </p>

</div>