<?php

if (!function_exists('tev_asset')) {

    /**
     * Load a path to an asset.
     *
     * By default, will check for a versioned asset first. If no versioned asset
     * exists, will fallback to a non-versioned URL.
     *
     * @param  string  $file           Asset path, e.g 'img/myimage.jpg'
     * @param  boolean $checkVersioned Whether or not to check for a versioned asset
     * @return string                  Public asset path
     */
    function tev_asset($file, $checkVersioned = true)
    {
        return app('Tev\Assets\LoaderInterface')->load($file, $checkVersioned);
    }
}
