<?php

namespace Versatile\Pages\Http\Controllers;

use Illuminate\Http\Request;

use Versatile\Pages\Page;
// use Versatile\Pages\Traits\Blocks;
// use Versatile\Front\Traits\Breadcrumbs;
use Versatile\Core\Http\Controllers\BaseController;
use Versatile\Pages\Actions\BlocksAction;

class PagesController extends BaseController
{
    // use Blocks;
    // use Breadcrumbs;

    /**
     * @var string
     */
    protected $actionsFormat = 'dropdown';

    /**
     * Get the actions available for the resource.
     *
     * @return array
     */
    public function actions()
    {
        return [
            BlocksAction::class
        ];
    }

    /**
     * POST B(R)EAD - Create data.
     *
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Request $request)
    {
        $view = parent::create($request);
        $view['layouts'] = page_layouts();

        return $view;
    }

    /**
     * POST B(R)EAD - Read data.
     *
     * @param Request $request
     * @param $id
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Request $request, $id)
    {
        $view = parent::edit($request, $id);
        $view['layouts'] = page_layouts();

        return $view;
    }


    /**
     * POST - Change Page Layout
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id - the page id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeLayout(Request $request, $id)
    {
        $page = Page::findOrFail((int)$id);
        $page->layout = $request->layout;
        $page->save();

        return redirect()
            ->back()
            ->with([
                'message' => __('versatile::generic.successfully_updated') . " Page Layout",
                'alert-type' => 'success',
            ]);
    }
}
