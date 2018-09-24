<?php

/**
 * Pages catch-all route
 */
\Versatile\Pages\Helpers\Routes::registerPageRoutes();

/**
 * Admin Route/s
 */
Route::group([
    'as' => 'versatile.page-blocks.',
    'prefix' => 'admin/page-blocks/',
    'middleware' => ['web', 'admin.user'],
    'namespace' => '\Versatile\Pages\Http\Controllers'
], function () {
    Route::post('sort', ['uses' => "PageBlocksController@sort", 'as' => 'sort']);
    Route::post('minimize', ['uses' => "PageBlocksController@minimize", 'as' => 'minimize']);
});

Route::group([
    'prefix' => 'admin/pages/',
    'middleware' => ['web', 'admin.user'],
    'namespace' => '\Versatile\Pages\Http\Controllers'
], function () {
    Route::post('layout/{id?}', [
        'uses' => 'PagesController@changeLayout',
        'as' => 'versatile.pages.layout'
    ]);
});