@props(['disabled' => false])

<input
    @disabled($disabled)
    {{ $attributes->merge([
        'class' => '
            block w-full h-11 px-4
            rounded-xl
            bg-white text-gray-900 placeholder-gray-400
            border border-gray-300
            shadow-sm
            focus:outline-none
            focus:border-emerald-600
            focus:ring-2 focus:ring-emerald-200
            transition
        '
    ]) }}
>
