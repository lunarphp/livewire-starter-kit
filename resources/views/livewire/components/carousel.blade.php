<section>
    <a class="text-sm font-medium transition hover:opacity-75"
        href="{{ route('collection.view', $collectionUrl) }}" >
        <h2 class="text-2xl font-bold">{{ $title }}</h2>
    </a>

    <div class="grid grid-cols-2 my-4 sm:grid-cols-3 lg:grid-cols-4 gap-x-4 gap-y-8">
        @forelse($products as $product)
            <x-product-card :product="$product" />
        @empty
        @endforelse
    </div>
</section>