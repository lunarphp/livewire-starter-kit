<section class="bg-white">
    <div class="max-w-screen-xl px-4 py-32 mx-auto sm:px-6 lg:px-8 lg:py-48">
        <div class="max-w-xl mx-auto text-center">
            <span class="text-xs font-medium text-center bg-orange-100 text-orange-700 px-3 py-1.5 rounded-lg">
                This was a test order
            </span>

            <h1 class="mt-8 text-3xl font-extrabold sm:text-5xl">
                <span
                    class="block"
                    role="img"
                >
                    🥳
                </span>

                <span class="block mt-1 text-blue-500">
                    Order Successful!
                </span>
            </h1>

            <p class="mt-4 font-medium sm:text-lg">
                Your order reference number is

                <strong>
                    {{ $order->reference }}
                </strong>
            </p>

            <a
                class="inline-block px-8 py-3 mt-8 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:ring-1 hover:ring-blue-600"
                href="{{ url('/') }}"
            >
                Back Home
            </a>
        </div>
    </div>
</section>
