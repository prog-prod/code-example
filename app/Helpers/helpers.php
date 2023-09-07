<?php

if (!function_exists('is_url')) {
    /**
     * Check if a string is a valid URL.
     *
     * @param string $url
     * @return bool
     */
    function is_url(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }
}
if (!function_exists('get_default_image')) {
    /**
     * Check if a string is a valid URL.
     *
     * @return bool|string
     */
    function get_default_image(): bool|string
    {
        return '/images/default-product.png';
    }
}
