@props(['value'])

<label {{ $attributes->merge(['class' => 'block mb-1 font-semibold text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>
