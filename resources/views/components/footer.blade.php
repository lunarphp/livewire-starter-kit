<footer class="bg-gray-50 sm:px-2 lg:px-4">
    <div class="max-w-screen-xl flex flex-wrap mx-auto py-6">
        <div class="w-full px-4 sm:w-1/2 lg:w-5/12">
        <x-brand.logo class="h-16 text-gray-500 mb-4" />
        <p class="max-w-sm text-gray-700 mb-4">
            This is a classic e-commerce store built with <a href="https://zabrdast.com">Zabrdast</a>.
            We are currently making a tutorial series to show you how we did it!
        </p>
        <x-icon.social class="text-gray-500 flex items-center" />
        </div>
        <div class="w-full px-4 sm:w-1/2 lg:w-3/12">
            <h4 class="my-4 text-2xl font-semibold">Customer</h4>
            <ul class="space-y-3 text-gray-500">
                <li><a href="javascript:void(0)">Order History</a></li>
                <li><a href="javascript:void(0)">Track your parcel</a></li>
                <li><a href="/about-us">About Us</a></li>
                <li><a href="/contact-us">Contact Us</a></li>
            </ul>
        </div>
        <div class="w-full px-4 lg:w-4/12">
            <h4 class="my-4 text-2xl font-semibold">Download App</h4>
            <x-icon.appstore class="sm:flex md:block" />
        </div>
    </div>

    <div class="items-centers grid grid-cols-1 justify-between gap-4 md:grid-cols-2 border-t border-gray-200 p-4">
        <p class="text-sm text-gray-500 max-sm:text-center">
            &copy; {{ now()->year }} | <a href="{{ config('app.url') }}">{{ config('app.name') }}</a> | All Rights Reserved
        </p>
        <div class="text-sm text-gray-500 flex justify-center sm:justify-end">
            <a href="/privacy-policy">Privacy Policy</a>
            &nbsp;|&nbsp;
            <a href="/terms-of-use">Terms and Conditions</a>
        </div>
    </div>
</footer>
