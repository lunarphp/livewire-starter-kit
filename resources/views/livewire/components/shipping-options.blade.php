<form wire:submit.prevent="save" class="border rounded shadow-lg">
    <div class="flex justify-between p-4 font-medium">
        <span class="text-xl">Shipping Option</span>
    </div>
    @if($this->shippingAddress)
        <div class="p-4 border-t">
            @foreach($this->shippingOptions as $option)
                <label class="flex items-center w-full cursor-pointer">
                    <input type="radio" wire:model="chosenOption" value="{{ $option->getIdentifier() }}" />
                    <div class="flex items-center block ml-2">
                        <span class="block mr-2 text-2xl">{{ $option->getPrice()->formatted() }}</span>
                        {{ $option->getDescription() }}
                    </div>
                </label>
            @endforeach
        </div>
    @else
    @endif
    @if($errors->has('chosenOption'))
        <p class="p-4 text-sm text-red-500">{{ $errors->first('chosenOption') }}</p>
    @endif
    <div class="flex justify-end w-full p-4 bg-gray-100">
        <div>
            <button type="submit" wire:key="submit_btn" class="px-5 py-3 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-500">
                Continue
            </button>
        </div>
    </div>
</form>
