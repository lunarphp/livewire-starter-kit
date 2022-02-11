<div>
    <div class="flex">
        <div>
            <label
                for="quantity"
                class="sr-only"
            >
                Quantity
            </label>

            <input
                class="w-12 h-full p-2 text-xs font-medium text-center transition-colors border border-gray-100 rounded-lg hover:border-gray-200 no-spinners"
                type="number"
                id="quantity"
                min="1"
                value="1"
                wire:model="quantity"
            />
        </div>

        <button
            type="submit"
            class="block w-full p-3 ml-4 font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700"
            wire:click.prevent="addToCart"
        >
            <span
                wire:loading.remove.delay
                wire:target="addToCart"
            >
                Add to Cart
            </span>

            <span
                wire:loading.delay
                wire:target="addToCart"
            >
                Adding...
            </span>
        </button>
    </div>

    @if ($errors->has('quantity'))
        <div
            class="p-2 mt-4 text-xs font-medium text-center text-red-700 rounded bg-red-50"
            role="alert"
        >
            @foreach ($errors->get('quantity') as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
</div>
