<div>
    <div class="flex gap-4">
        <div>
            <label for="quantity"
                   class="sr-only">
                Quantity
            </label>

            <input class="w-16 px-1 py-4 text-sm text-center transition border border-gray-100 rounded-lg no-spinner"
                   type="number" id="quantity" min="1" value="1"
                   wire:model.live="quantity"
                   @if (!$this->available) x-bind:disabled="true" @endif />
        </div>

        <button type="submit"
                class="w-full px-6 py-4 text-sm font-medium text-center text-white rounded-lg @if ($this->available) bg-indigo-600 hover:bg-indigo-700 @else bg-gray-400 @endif"
                wire:click.prevent="addToCart"
                @if (!$this->available) x-bind:disabled="true" @endif>
                {{ $this->available ? "Add to Cart" : "Out of Stock" }}
        </button>
    </div>

    @if ($errors->has('quantity'))
        <div class="p-2 mt-4 text-xs font-medium text-center text-red-700 rounded bg-red-50"
             role="alert">
            @foreach ($errors->get('quantity') as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
</div>
