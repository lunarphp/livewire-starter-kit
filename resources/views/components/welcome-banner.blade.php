<section {{ $attributes }}>
    <div class="max-w-screen-xl p-4 mx-auto sm:px-6 lg:px-8">
        <div class="max-w-xl mx-auto text-center">
            <h1 class="text-3xl font-extrabold sm:text-5xl">
                Welcome to

                <span class="text-gray-500">{{ strtolower(config('app.name')) }}</span>
                Store
                <span role="img" aria-hidden="true">👋</span>
            </h1>

            <p class="mt-4 font-medium sm:leading-relaxed sm:text-xl">
                This is an example of a classic e-commerce store built with <a href="https://zabrdast.com">Zabrdast</a>.
                We are currently making a tutorial series to show you how we did it!
            </p>

            <div class="flex flex-wrap justify-center gap-4 mt-8">
                <a class="block w-full px-12 py-3 font-medium text-white bg-indigo-600 rounded shadow sm:w-auto active:bg-indigo-500 hover:bg-indigo-700 focus:outline-none focus:ring"
                   href="https://zabrdast.com/" target="_blank" rel="noopener noreferrer">
                    Zabrdast Website
                </a>

                <a class="block w-full px-12 py-3 font-medium text-indigo-600 rounded shadow sm:w-auto hover:text-indigo-700 active:text-indigo-500 focus:outline-none focus:ring"
                   href="#" target="_blank" rel="noopener noreferrer">
                   Start Shopping
                </a>
            </div>
        </div>
    </div>
</section>
