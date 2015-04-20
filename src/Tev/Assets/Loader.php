<?php
namespace Tev\Assets;

use Tev\Assets\Exception\ManifestException;

/**
 * Asset path loader.
 *
 * Allows loading of compiled assets from local and remote sources.
 */
class Loader implements LoaderInterface
{
    /**
     * Base path to assets, within public directory.
     *
     * e.g '/build/assets'
     *
     * @var string
     */
    private $assetsPath;

    /**
     * Full path to asset version manifest.
     *
     * e.g '/var/www/app/public/rev-manifest.json'
     *
     * @var string
     */
    private $manifestPath;

    /**
     * Optional URL prefix for assets.
     *
     * Useful for assets stored on CDNs.
     *
     * @var string
     */
    private $url;

    /**
     * Cached manifest config.
     *
     * @var array
     */
    private $manifest;

    /**
     * Constructor.
     *
     * Configure path config.
     *
     * @param  string $assetsPath   Base path to assets, within public directory
     * @param  string $manifestPath Full path to asset version manifest
     * @param  string $url          Optional URL prefix for assets
     * @return void
     */
    public function __construct($assetsPath, $manifestPath, $url = null)
    {
        $this->assetsPath = $assetsPath;
        $this->manifestPath = $manifestPath;
        $this->url = $url;
        $this->manifest = null;
    }

    /**
     * {@inheritdoc}
     */
    public function load($file, $checkVersioned = true)
    {
        if ($checkVersioned) {
            try {
                return $this->loadVersioned($file);
            } catch (ManifestException $e) {}
        }

        return $this->loadRaw($file);
    }

    /**
     * Load a path to a non-versioned asset.
     *
     * @param  string $file Asset path, e.g 'img/myimage.jpg'
     * @return string       Public asset path
     */
    protected function loadRaw($file)
    {
        return $this->wrap($file);
    }

    /**
     * Load a path to a versioned asset.
     *
     * @param  string $file Asset path, e.g 'css/style.css'
     * @return string       Public asset path
     *
     * @throws \Tev\Assets\Exception\ManifestException If asset not found
     */
    protected function loadVersioned($file)
    {
        $m = $this->getManifest();

        if (isset($m[$file])) {
            return $this->wrap($m[$file]);
        } else {
            throw new ManifestException("Versioned asset at $file does not exist in manifest");
        }
    }

    /**
     * Get manifest config.
     *
     * @return array
     *
     * @throws \Tev\Assets\Exception\ManifestException If manifest not found or invalid
     */
    protected function getManifest()
    {
        if ($this->manifest === null) {
            if (file_exists($this->manifestPath)) {
                $this->manifest = json_decode(file_get_contents($this->manifestPath), true);
            } else {
                throw new ManifestException("Manifest file at {$this->manifestPath} is not readable");
            }

            if (!is_array($this->manifest)) {
                throw new ManifestException("Manifest file at {$this->manifestPath} is invalid JSON");
            }
        }

        return $this->manifest;
    }

    /**
     * Wrap an asset path with the base dir and optional URL.
     *
     * @param  string $path Asset path, e.g 'img/myimage.jpg'
     * @return string       Wrapped asset path, e.g '/build/assets/img/myimage.jpg'
     */
    protected function wrap($path)
    {
        if ($this->url !== null) {
            return $this->url . $this->assetsPath . '/' . $path;
        }

        return $this->assetsPath . '/' . $path;
    }
}
