@props(['product'])

<a class="block group"
   href="{{ route('product.view', $product->defaultUrl->slug) }}"
   wire:navigate
>
    <div class="relative overflow-hidden rounded-lg">
        @if ($product->thumbnail)
            <img class="object-cover transition-transform duration-300 group-hover:scale-105 @if (!$product->isAvailable()) opacity-25 @endif"
                 src="{{ $product->thumbnail->getUrl('medium') }}"
                 alt="{{ $product->translateAttribute('name') }}" />
        @endif

        @if ($product->isAvailable())
            <x-flag :text="$product->discount()?->name" />
        @else 
            <x-flag text="Sold out" />
        @endif
    </div>

    <div class="mt-1 flex justify-between">
    <div>
        <h3 class="text-sm text-gray-700">{{ $product->brand?->name }}</h3>
        <h3 class="mt-1 text-sm font-medium">{{ $product->translateAttribute('name') }}</h3>
    </div>

    @if ($product->isAvailable())
        <x-product-price class="text-right" :product="$product" />
    @endif
    </div>
</a>
