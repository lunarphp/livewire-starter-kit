@props([
    'name',
    'slug',
    'thumbnail' => null,
    'price'
])

<div class="space-y-2">
    <div class="overflow-hidden rounded-lg aspect-w-1 aspect-h-1">
        @if ($thumbnail)
            <a href="{{ route('product.view', $slug) }}">
                <img class="object-cover transition-transform duration-300 group-hover:scale-105"
                     src="{{ $thumbnail }}"
                     alt="{{ $name }}" />
            </a>
        @endif
    </div>

    <a href="{{ route('product.view', $slug) }}" class="text-sm font-medium hover:underline block">
        {{ $name }}
    </a>

    <p class="mt-1 text-sm text-gray-600">
        <span class="sr-only">
            Price
        </span>
    </p>
    <div>
        {{ $price }}
    </div>
</div>
