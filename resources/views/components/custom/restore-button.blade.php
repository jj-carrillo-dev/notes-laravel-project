<form {{ $attributes->merge(['method' => 'POST']) }} action="{{ $action }}">
    @method('PUT')
    @csrf
    <x-custom.secondary-button type="submit">
        {{ $slot }}
    </x-custom.secondary-button>
</form>