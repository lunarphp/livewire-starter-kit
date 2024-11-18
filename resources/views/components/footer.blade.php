<footer class="bg-gray-50">
    <div class="max-w-screen-xl px-4 py-12 mx-auto sm:px-6 lg:px-8">
        <x-brand.logo class="w-auto h-16 text-gray-500" />

        <p class="max-w-sm mt-4 text-gray-700">
            This is a classic e-commerce store built with <a href="https://zabrdast.com">Zabrdast</a>.
            We are currently making a tutorial series to show you how we did it!
        </p>

        <p class="pt-4 mt-4 text-sm text-gray-500 border-t border-gray-100">
            &copy; {{ now()->year }} {{ config('app.name') }}
        </p>
    </div>
</footer>
