<?php

if (!function_exists('page_layouts')) {
    /**
     * Gets page layouts loaded by the current theme
     *
     * @return array
     */
    function page_layouts()
    {
        return app(\Versatile\Core\Support\Registry::class)->get('page_layouts', []);
    }
}
