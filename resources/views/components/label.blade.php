@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-txt']) }}>
    {{ $value ?? $slot }}
</label>
