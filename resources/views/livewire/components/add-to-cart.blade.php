<div>
    <div class="flex">
        <div>
            <label for="quantity" class="sr-only">Qty</label>

            <input
                type="number"
                id="quantity"
                min="1"
                value="1"
                class="w-20 px-4 py-3 font-bold text-center border-2 border-black"
                wire:model="quantity"
            />
        </div>

        <button
            type="submit"
            class="block px-5 py-3 ml-3 text-xs font-medium text-white bg-green-600 rounded hover:bg-green-500"
            wire:click.prevent="addToCart"
        >
            <div wire:loading.remove wire:target="addToCart">
                Add to Cart
            </div>
            <div wire:loading wire:target="addToCart">
                Adding...
            </div>
        </button>


    </div>
    @if($errors->has('quantity'))
        <div class="mt-4 text-sm text-red-500">
            @foreach($errors->get('quantity') as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif

</div>
