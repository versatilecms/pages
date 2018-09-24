<?php

namespace Versatile\Pages\Helpers;

use Illuminate\Support\Facades\Schema;
use Versatile\Pages\Page;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

class Routes
{
    /**
     * Dynamically register pages.
     */
    public static function registerPageRoutes()
    {
        if (!Schema::hasTable('pages')) {
            return;
        }

        // Get all page slugs (note it's cached for 5 mins)
        $pages = Cache::remember('page/slugs', 5, function () {
            return Page::all('slug');
        });

        $slug = Request::path() === '/' ? 'home' : Request::path();

        // When the current URI is known to be a page slug, let it be a route
        if ($pages->contains('slug', $slug)) {
            Route::get('/{slug?}', '\Versatile\Pages\Http\Controllers\FrontPagesController@getPage')
                ->middleware(['web', 'theme.check'])
                ->where('slug', '.+');
        }
    }
}
