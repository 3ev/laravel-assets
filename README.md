# 3ev's Laravel asset helpers

This library is used internally at 3ev as part of a custom Laravel asset
pipeline. It's not yet ready for public use, but feel free to play around with
it.

## Installation

```sh
$ composer require "3ev/laravel-assets:~1.0"
```

Then, you'll need to add the following service provider to your `app.php`:

```php
// config/app.php

return [
    'providers' => [
        'Tev\Assets\Providers\AssetsServiceProvider'
    ]
];
```

and publish the package config:

```sh
$ php artisan vendor:publish --provider="Tev\Assets\Providers\AssetsServiceProvider"
```

## Usage

The default configuration sets up assets to be loaded from `public/build/assets/`,
with the revision manifest file (from [gulp-rev](https://github.com/sindresorhus/gulp-rev))
configured at `public/build/assets/rev-manifest.json`.

The library provides a simple helper method which will load a versioned or
unversioned asset seemlessly from `public/build/assets/`. For example, to load
a compiled CSS file you might add the following to your template:

```php
<link rel="stylesheet" type="text/css" href="{{ tev_asset('css/style.css') }}" />
```

or to load a static image you might do:

```php
<img src="{{ tev_asset('img/logo.png') }}" title="My Logo" alt="My Logo" />
```
