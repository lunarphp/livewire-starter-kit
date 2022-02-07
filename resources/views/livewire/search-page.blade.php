<div>
  <div class="relative max-w-screen-xl px-4 py-8 mx-auto">
      <div class="grid grid-cols-4">
        @foreach($this->results as $result)
          <a
            href="{{ route('product.view', $result->defaultUrl->slug) }}"
            class="block p-4 space-y-6 bg-gray-50 rounded-xl"
          >
            <img
              alt="Tick Trainer Red"
              loading="lazy"
              src="{{ $result->thumbnail->getUrl('small') }}"
              class="object-cover w-full h-56 rounded-lg"
            />

            <div>
              <h5 class="text-lg font-bold">
                {{ $result->translateAttribute('name') }}
              </h5>

              <p class="mt-2 text-xs text-gray-600">
                {{ $result->translateAttribute('description') }}
              </p>
            </div>


            <span class="block py-3 font-medium text-center text-white bg-black rounded-lg">
              Buy {{ $result->variants->first()->basePrices->first()->price->formatted() }}
            </span>
          </a>
      @endforeach
    </div>
  </div>
</div>
