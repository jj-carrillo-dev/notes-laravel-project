@props(['notebook'])

<div class="bg-white dark:bg-gray-800 p-4 overflow-hidden shadow-sm sm:rounded-lg">
    <h2 class="font-bold text-lg text-red-600">
        <a href="{{ route('notebooks.show', $notebook) }}" class="hover:underline">
            {{ $notebook->name }}
        </a>
    </h2> 
    <p class="mt-2">
        <span class="mt-4 text-sm opacity-70">Created: {{ $notebook->created_at->diffForHumans() }}</span>
        @unless ($notebook->created_at->eq($notebook->updated_at))
            <span class="mt-4 text-sm opacity-70">| Updated: {{ $notebook->updated_at->diffForHumans() }}</span>
        @endunless
    </p>
</div>