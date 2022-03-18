<div
    class="bg-white border border-gray-100 rounded-xl"
>
    <div class="flex items-center h-16 px-6 border-b border-gray-100">
        <h3 class="text-lg font-medium">
            Payment
        </h3>
    </div>

    @if ($currentStep >= $step)
        <div class="p-4 pb-0">
            <button
                class="px-3 py-2 text-sm font-medium
                    @if($paymentType == 'card')
                        text-green-600 border border-green-500 bg-green-100
                    @else
                        text-gray-400 border hover:text-gray-900
                    @endif
                    rounded-lg
                "
                type="button"
                wire:click.prevent="$set('paymentType', 'card')"
            >
                Pay by card
            </button>

            <button
                class="px-3 py-2 text-sm font-medium
                    @if($paymentType == 'cash')
                        text-green-600 border border-green-500 bg-green-100
                    @else
                        text-gray-400 border hover:text-gray-900
                    @endif
                    rounded-lg
                "
                type="button"
                wire:click.prevent="$set('paymentType', 'cash')"
            >
                Pay with cash
            </button>
        </div>
        @if($paymentType == 'card')
            <div class="p-6">
                @livewire('stripe.payment', [
                    'cart' => $cart,
                    'returnUrl' => route('checkout.view'),
                ])
            </div>
        @endif
        @if($paymentType == 'cash')
            <form class="p-6" wire:submit.prevent="checkout">
                <div class="p-4 text-sm text-center text-blue-700 rounded-lg bg-blue-50">
                    Payment is offline, no card details needed.
                </div>

                <button
                    class="px-5 py-3 mt-4 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-500"
                    type="submit"
                    wire:key="payment_submit_btn"
                >
                    <span
                        wire:loading.remove.delay
                        wire:target="checkout"
                    >
                        Submit Order
                    </span>
                    <span
                        wire:loading.delay
                        wire:target="checkout"
                    >
                        <svg
                            class="w-5 h-5 text-white animate-spin"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <circle
                                class="opacity-25"
                                cx="12"
                                cy="12"
                                r="10"
                                stroke="currentColor"
                                stroke-width="4"
                            ></circle>
                            <path
                                class="opacity-75"
                                fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                            ></path>
                        </svg>
                    </span>
                </button>
            </form>
        @endif
    @endif
</div>
