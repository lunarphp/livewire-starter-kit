<div>
    <x-promo-banner class="bg-gray-100 px-2 py-2 mb-4" />

    <div class="max-w-screen-xl p-4 mx-auto space-y-12 sm:px-6 lg:px-8">
        @if ($this->saleCollection)
            <x-collection-sale />
        @endif

        @if ($this->randomCollection)
            <livewire:components.carousel :collection="$this->randomCollection" />
        @endif
    </div>
</div>
