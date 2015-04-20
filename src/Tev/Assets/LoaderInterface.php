<?php
namespace Tev\Assets;

/**
 * Asset loader interface.
 *
 * Asset loaders should provide a `load()` method, which returns a public path
 * to a versioned or non-versioned asset.
 */
interface LoaderInterface
{
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
    public function load($file, $checkVersioned = true);
}
