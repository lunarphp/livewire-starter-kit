<div>
    <div class="flex items-center space-x-2">
        <label for="sort" class="uppercase text-xs text-gray-500">Sort</label>
        <div class="grid grid-cols-1">
            <select wire:model.live="sort" id="sort" name="sort" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pl-3 pr-8 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                <option value>Relevancy</option>
                <option value="min_price:asc">Price Asc</option>
                <option value="min_price:desc">Price Desc</option>
            </select>
        </div>
    </div>

</div>
