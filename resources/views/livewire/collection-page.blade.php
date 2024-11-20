<div class="max-w-screen-xl px-4 py-8 mx-auto sm:px-6 lg:px-8">
    <section>
        <h1 class="text-3xl font-bold">
            {{ $this->collection->translateAttribute('name') }}
        </h1>

        <div class="grid grid-cols-2 gap-8 my-4 sm:grid-cols-3 lg:grid-cols-4">
            @forelse($this->collection->products as $product)
                <x-product-card :product="$product" />
            @empty
                <div class="col-span-2 text-sm">
                    {!! $this->collection->translateAttribute('description') !!}
                </div>
            @endforelse
        </div>
    </section>
    @foreach ($this->collection->children as $collection)
        <livewire:components.carousel :collection="$collection" />
    @endforeach
</div>
