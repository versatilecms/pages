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
    'prefix' => 'admin',
    'middleware' => ['web', 'admin.user'],
    'namespace' => '\Versatile\Pages\Http\Controllers',
    'as' => 'versatile.'
], function () {
    Route::post('pages/layout/{id?}', [
        'uses' => 'PagesController@changeLayout',
        'as' => 'pages.layout'
    ]);

    Route::resource('pages', 'PagesController');
    Route::resource('page-blocks', 'PageBlocksController');
});
