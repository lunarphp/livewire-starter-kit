<?php

namespace App\Traits;

use Lunar\Models\Url;

trait FetchesUrls
{
    /**
     * The URL model from the slug.
     */
    public ?Url $url = null;

    /**
     * Fetch a url model.
     *
     * @param  string  $slug
     * @param  string  $type
     * @param  array  $eagerLoad
     */
    public function fetchUrl($slug, $type, $eagerLoad = []): ?Url
    {
        return Url::whereElementType($type)
            ->whereDefault(true)
            ->whereSlug($slug)
            ->with($eagerLoad)->first();
    }
}
