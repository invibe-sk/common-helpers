<?php

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

if (!function_exists('webpFileName')) {

    /**
     * @param $filename
     * @return string
     * @author Adam Ondrejkovic
     */
    function webpFileName($filename)
    {
        return explode(".", $filename)[0] . ".webp";
    }
}

if (!function_exists('createWebpVariant')) {

    /**
     * @param $disk
     * @param $filename
     * @author Adam Ondrejkovic
     * Create webp image variant
     */
    function createWebpVariant($disk, $filename) {
        $webp = Image::make(Storage::disk($disk)->path($filename))->encode('webp', 80)->stream();
        Storage::disk($disk)->put(webpFileName($filename), $webp);
    }
}

