<div>
    <x-promo-banner class="bg-gray-100 px-2 py-2 mb-4" />

    <div class="max-w-screen-xl p-4 mx-auto space-y-12 sm:px-6 lg:px-8">
        @if ($this->saleCollection)
            <x-collection-sale />
        @endif

        @if ($this->latestProducts)
            <livewire:components.carousel title="New Styles" collectionUrl="collections/sale" 
                :products="$this->latestProducts" />
        @endif

        @if ($collection = $this->randomCollection)
            <livewire:components.carousel 
                :title="$collection->translateAttribute('name')" 
                :collectionUrl="$collection->defaultUrl->slug" 
                :products="$collection->products" />
        @endif
    </div>
</div>
