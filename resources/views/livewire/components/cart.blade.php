<div class="relative" x-data="{
    linesVisible: @entangle('linesVisible')
}">
    <button
        class="inline-flex flex-col items-center justify-center w-16 h-16"
        x-on:click="linesVisible = !linesVisible"
        :class="{
            'bg-gray-900 text-white': linesVisible
        }"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"
        />
        </svg>

        <span class="block mt-1 text-xs font-medium">Cart</span>
    </button>
    <div class="absolute right-0 z-50 p-4 bg-gray-900 rounded-b shadow w-96" x-show="linesVisible" x-on:click.away="linesVisible = false" x-cloak>

        <div class="p-4 space-y-2 text-sm bg-white rounded">
            @if($this->cart)
                <div class="overflow-y-auto max-h-96">
                    @forelse($lines as $index => $line)
                        <div
                            class="flex items-center py-2 space-x-4 border-t first:border-none"
                            wire:key="line_{{ $line['id'] }}"
                        >
                            <div class="w-1/5">
                                <img src="{{ $line['thumbnail'] }}" class="rounded">
                            </div>
                            <div class="grow">
                                <strong>{{ $line['description'] }}</strong>
                                <span class="block text-xs">{{ $line['identifier'] }} /  {{ $line['option'] }}</span>
                                <div class="flex">
                                    <div class="flex items-center mt-2 space-x-4">
                                        <input
                                            type="number"
                                            class="w-1/3 p-2 text-xs border border-gray-900"
                                            wire:model="lines.{{ $index }}.quantity"
                                        />
                                        <div class="grow">
                                            @ {{ $line['sub_total'] }}
                                        </div>
                                    </div>
                                    <div class="px-3">
                                        <button type="button" wire:click="removeLine('{{ $line['id'] }}') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <span class="text-xs">Go buy something :)</span>
                    @endforelse
                </div>
                <div class="flex items-center justify-between pt-2 border-t">
                    <strong>Sub Total</strong>
                    {{ $this->cart->subTotal->formatted() }}
                </div>
            @else
                <span class="text-xs">Go buy something :)</span>
            @endif
        </div>
        @if($this->cart)
            <div class="flex justify-between pt-3">
                <button
                    type="button"
                    class="px-3 py-2 text-sm text-center text-gray-200 uppercase border border-gray-600 rounded-md hover:border-white hover:bg-white hover:text-gray-900"
                    wire:click="updateLines"
                >
                    Update Cart
                </button>

                <a href="{{ route('checkout.view') }}" class="px-3 py-2 text-sm text-center text-white uppercase bg-blue-600 rounded-md hover:bg-blue-700">
                    Checkout
                </a>
            </div>
        @endif
    </div>
</div>
