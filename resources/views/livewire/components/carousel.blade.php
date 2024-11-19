<section>
    <div class="max-w-screen-xl px-4 py-4 mx-auto sm:px-6 lg:px-8">
    <a class="text-sm font-medium transition hover:opacity-75"
        href="{{ route('collection.view', $this->collection->defaultUrl->slug) }}"
        wire:navigate>
        <h2 class="text-2xl font-bold">
            {{ $this->collection->translateAttribute('name') }}
        </h2>
    </a>

        <div class="grid grid-cols-2 mt-4 sm:grid-cols-3 lg:grid-cols-4 gap-x-4 gap-y-8">
            @forelse($this->collection->products as $product)
                <x-product-card :product="$product" />
            @empty
            @endforelse
        </div>
    </div>
</section>