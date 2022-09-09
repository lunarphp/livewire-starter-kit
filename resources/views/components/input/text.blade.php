@props([
    'error' => false,
])
<input {{ $attributes->merge([
        'type' => 'text',
        'class' => 'w-full p-3 border border-gray-200 rounded-lg sm:text-sm',
    ])->class([
        'border-red-400' => !!$error,
    ]) }}
       maxlength="255">
