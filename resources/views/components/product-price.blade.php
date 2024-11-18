<span {{ $attributes }} class="font-bold text-gray-700">
    {{ $price?->price->formatted() }}
</span>
@if ($price?->compare_price->value)
<span class="text-sm text-gray-500 line-through">{{ $price?->compare_price->formatted() }}</span>
@endif