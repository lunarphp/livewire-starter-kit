<?php

namespace App\Traits;

use Lunar\Models\Url;

trait FetchesUrls
{
    /**
     * The URL model from the slug.
     *
     * @var \Lunar\Models\Url
     */
    public ?Url $url = null;

    /**
     * Fetch a url model.
     *
     * @param  string  $slug
     * @param  string  $type
     * @param  array  $eagerLoad
     * @return \Lunar\Models\Url|null
     */
    public function fetchUrl($slug, $type, $eagerLoad = [])
    {
        return Url::whereElementType($type)
            ->whereDefault(true)
            ->whereSlug($slug)
            ->with($eagerLoad)->first();
    }
}
