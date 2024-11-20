<div>
    <x-welcome-banner class="bg-gray-100" />

    <div class="max-w-screen-xl p-4 mx-auto space-y-12 sm:px-6 lg:px-8">
        @if ($this->saleCollection)
            <x-collection-sale />
        @endif

        @if ($this->randomCollection)
            <livewire:components.carousel :collection="$this->randomCollection" />
        @endif
    </div>
</div>
