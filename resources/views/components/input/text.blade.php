@props([
    'error' => false,
])
<input
  {{ $attributes->merge([
    'type' => 'text',
    'class' => 'w-full p-4 pr-12 border-2 border-gray-200 rounded-lg sm:text-sm',
  ])->class([
    'border-red-400' => !!$error,
  ]) }}
  maxlength="255"
>
