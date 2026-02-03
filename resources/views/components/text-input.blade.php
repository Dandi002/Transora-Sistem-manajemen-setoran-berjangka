@props(['disabled' => false])

<input
    @disabled($disabled)
    {{ $attributes->merge([
        'class' => '
            block w-full
            rounded-xl
            bg-white text-gray-900
            border border-gray-300
            shadow-sm
            focus:border-emerald-600
            focus:ring-emerald-600
        '
    ]) }}
>
