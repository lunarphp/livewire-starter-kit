<header class="border-b border-gray-100">
    <div class="flex items-center justify-between h-16 pl-4 mx-auto max-w-screen-2xl sm:pl-6 lg:px-8">
        <div class="flex items-center">
            <a
                class="flex flex-shrink-0"
                href="{{ url('/') }}"
            >
                <x-brand.logo class="h-10" />
            </a>

            <nav
                class="hidden text-sm font-medium text-gray-700 border-l border-gray-100 lg:space-x-8 lg:ml-8 lg:pl-8 lg:flex">
                @foreach ($this->collections as $collection)
                    <a
                        class="transition-opacity hover:opacity-75"
                        href="{{ route('collection.view', $collection->defaultUrl->slug) }}"
                    >
                        {{ $collection->translateAttribute('name') }}
                    </a>
                @endforeach
            </nav>
        </div>

        <div class="flex items-center justify-between flex-1 ml-4 lg:justify-end">
            <x-header.search class="max-w-md" />

            <div class="flex items-center ml-4">
                @livewire('components.cart')

                <div
                    class="relative"
                    x-data="{ mobileMenu: false }"
                >
                    <button
                        type="button"
                        class="inline-flex items-center justify-center flex-shrink-0 w-16 h-16 border-l border-gray-100 lg:hidden"
                        aria-label="Open Mobile Menu"
                        x-on:click="mobileMenu = !mobileMenu"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                        </svg>
                    </button>

                    <ul
                        class="absolute top-auto z-50 w-screen max-w-xs p-6 mt-4 space-y-4 text-sm font-medium text-gray-700 bg-white border border-gray-100 shadow-xl right-4 rounded-xl"
                        x-show="mobileMenu"
                        x-transition
                        x-cloak
                        x-on:click.away="mobileMenu = false"
                    >
                        @foreach ($this->collections as $collection)
                            <li>
                                <a href="{{ route('collection.view', $collection->defaultUrl->slug) }}">
                                    {{ $collection->translateAttribute('name') }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
