<?php

namespace App\Traits;

use GetCandy\Models\Url;

trait FetchesUrls
{
    /**
     * The URL model from the slug.
     *
     * @var \GetCandy\Models\Url
     */
    public ?Url $url = null;

    /**
     * Fetch a url model.
     *
     * @param string $slug
     * @param string $type
     * @param array $eagerLoad
     * @return \GetCandy\Models\Url|null
     */
    public function fetchUrl($slug, $type, $eagerLoad = [])
    {
        return Url::whereElementType($type)
            ->whereDefault(true)
            ->whereSlug($slug)
            ->with($eagerLoad)->first();
    }
}
