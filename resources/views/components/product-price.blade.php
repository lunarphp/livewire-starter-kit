<p {{ $attributes }}>
    <span class="sr-only">Price</span>
    @if ($discountedPrice)
        <span class="font-bold">{{ $discountedPrice?->formatted() }}</span>
        <span class="text-xs text-gray-500 line-through">{{ $price?->price->formatted() }}</span>
    @else
        <span class="font-bold">{{ $price?->price->formatted() }}</span>
        @if ($price?->compare_price)
        <span class="text-xs text-gray-500 line-through">{{ $price?->compare_price->formatted() }}</span>
        @endif
    @endif
</p>