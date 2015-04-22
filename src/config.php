<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Base asset path.
    |--------------------------------------------------------------------------
    |
    | This is the base path from which you will reference assets in the app's
    | public directory.
    |
    */

    'asset_path' => '/build/assets',

    /*
    |--------------------------------------------------------------------------
    | Manifest path.
    |--------------------------------------------------------------------------
    |
    | This is the path to the gulp-rev asset manifest file. The path should be
    | absolute and include the filename.
    |
    */

    'manifest_path' => public_path() . '/build/assets/rev-manifest.json',

    /*
    |--------------------------------------------------------------------------
    | Asset base URL.
    |--------------------------------------------------------------------------
    |
    | If you're going to be storing assets on a CDN, set this to value to the
    | base URL for those assets. For example:
    |
    | https://mycontainer.ssl.cf3.rackcdn.com
    |
    */

    'asset_url' => null
];
