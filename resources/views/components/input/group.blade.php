@props([
    'label' => null,
    'errors' => [],
    'required' => false
])

<label class="space-y-2">
    <div class="font-medium font-sm">
        {{ $label }} @if($required)<small class="text-xs text-red-500">&#42;</small>@endif
    </div>
    {{ $slot }}
    @foreach($errors as $error)
        <p class="my-1 text-sm text-red-500">{{ $error }}</p>
    @endforeach
</label>
