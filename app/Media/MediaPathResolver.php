<?php

namespace App\Media;

use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class MediaPathResolver implements PathGenerator
{
    /**
     * Get the root folder for the media relative to the model name.
     *
     * @param  Media  $media
     * @return string
     */
    public function getRootMediaFolder($media)
    {
        return Str::plural(
            strtolower(class_basename($media->model_type))
        );
    }

    /*
     * Get the path for the given media, relative to the root storage path.
     */
    public function getPath(Media $media): string
    {
        return $this->getRootMediaFolder($media).'/'.$media->created_at->format('Y/m/d').'/';
    }

    /*
     * Get the path for conversions of the given media, relative to the root storage path.
     */
    public function getPathForConversions(Media $media): string
    {
        return $this->getRootMediaFolder($media).'/'.$media->created_at->format('Y/m/d').'/conversions/';
    }

    /*
     * Get the path for responsive images of the given media, relative to the root storage path.
     */
    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getRootMediaFolder($media).'/'.$media->created_at->format('Y/m/d').'/responsive-images/';
    }
}
