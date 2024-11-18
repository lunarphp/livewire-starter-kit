@props(['product'])

<a class="group relative"
   href="{{ route('product.view', $product->defaultUrl->slug) }}"
   wire:navigate
>
    <div class="overflow-hidden rounded-lg">
        @if ($product->thumbnail)
            <img class="object-cover transition-transform duration-300 group-hover:scale-105"
                 src="{{ $product->thumbnail->getUrl('medium') }}"
                 alt="{{ $product->translateAttribute('name') }}" />
        @endif
    </div>

    <div class="mt-1 flex justify-between">
    <div>
        <h3 class="text-sm text-gray-700">{{ $product->brand->name }}</h3>
        <h3 class="mt-1 text-sm font-medium">{{ $product->translateAttribute('name') }}</h3>
    </div>

    <p class="text-right">
        <span class="sr-only">Price</span>
        <x-product-price :product="$product" />
    </p>
    </div>
</a>
