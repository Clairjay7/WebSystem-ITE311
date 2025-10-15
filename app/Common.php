<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the framework's
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter.com/user_guide/extending/common.html
 */

if (! function_exists('asset_url')) {
    /**
     * Generate URL for assets (CSS, JS, images) in the root directory
     * 
     * @param string $path Path to the asset file
     * @return string Full URL to the asset
     */
    function asset_url(string $path = ''): string
    {
        return rtrim(config('App')->baseURL, '/') . '/' . ltrim($path, '/');
    }
}

if (! function_exists('css_url')) {
    /**
     * Generate URL for CSS files
     * 
     * @param string $filename CSS filename (with or without .css extension)
     * @return string Full URL to the CSS file
     */
    function css_url(string $filename): string
    {
        $filename = str_ends_with($filename, '.css') ? $filename : $filename . '.css';
        return asset_url('css/' . $filename);
    }
}

if (! function_exists('img_url')) {
    /**
     * Generate URL for image files
     * 
     * @param string $filename Image filename
     * @return string Full URL to the image file
     */
    function img_url(string $filename): string
    {
        return asset_url('images/' . $filename);
    }
}
