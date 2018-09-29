<?php

namespace Versatile\Pages\Http\Controllers;

use Illuminate\Http\Request;

use Versatile\Pages\Page;
use Versatile\Core\Http\Controllers\BaseController;
use Versatile\Pages\Actions\BlocksAction;

class PagesController extends BaseController
{
    /**
     * Informs if DataType will be loaded from the database or setup
     *
     * @var bool
     */
    protected $dataTypeFromDatabase = false;

    public function setup()
    {
        $this->bread->setName('pages');
        $this->bread->setSlug('pages');

        $this->bread->setDisplayNameSingular(__('versatile::seeders.data_types.page.singular'));
        $this->bread->setDisplayNamePlural(__('versatile::seeders.data_types.page.plural'));

        $this->bread->setIcon('versatile-file-text');
        $this->bread->setModel(Page::class);

        $this->bread->setActionsFormat('dropdown');

        $this->bread->addAction(
            BlocksAction::class
        );

        $this->bread->addDataRows([
            [
                'field' => 'id',
                'type' => 'number',
                'display_name' => __('versatile::seeders.data_rows.id'),
                'required' => true,
                'browse' => false,
                'read' => false,
                'edit' => false,
                'add' => false,
                'delete' => false,
                'details' => [],
            ],

            [
                'field' => 'author_id',
                'type' => 'text',
                'display_name' => __('versatile::seeders.data_rows.author'),
                'required' => true,
                'browse' => false,
                'read' => false,
                'edit' => false,
                'add' => false,
                'delete' => false,
                'details' => [],
            ],

            [
                'field' => 'title',
                'type' => 'text',
                'display_name' => __('versatile::seeders.data_rows.title'),
                'required' => true,
                'browse' => true,
                'read' => true,
                'edit' => true,
                'add' => true,
                'delete' => true,
                'details' => [],
            ],

            [
                'field' => 'excerpt',
                'type' => 'text_area',
                'display_name' => __('versatile::seeders.data_rows.excerpt'),
                'required' => true,
                'browse' => false,
                'read' => true,
                'edit' => true,
                'add' => true,
                'delete' => true,
                'details' => [],
            ],

            [
                'field' => 'body',
                'type' => 'rich_text_box',
                'display_name' => __('versatile::seeders.data_rows.body'),
                'required' => true,
                'browse' => false,
                'read' => true,
                'edit' => true,
                'add' => true,
                'delete' => true,
                'details' => [],
            ],

            [
                'field' => 'slug',
                'type' => 'text',
                'display_name' => __('versatile::seeders.data_rows.slug'),
                'required' => true,
                'browse' => false,
                'read' => true,
                'edit' => true,
                'add' => true,
                'delete' => true,
                'details' => [
                    'slugify' => [
                        'origin' => 'title',
                    ],
                ],
            ],

            [
                'field' => 'meta_description',
                'type' => 'text',
                'display_name' => __('versatile::seeders.data_rows.meta_description'),
                'required' => true,
                'browse' => false,
                'read' => true,
                'edit' => true,
                'add' => true,
                'delete' => true,
                'details' => [],
            ],

            [
                'field' => 'meta_keywords',
                'type' => 'text',
                'display_name' => __('versatile::seeders.data_rows.meta_keywords'),
                'required' => true,
                'browse' => false,
                'read' => true,
                'edit' => true,
                'add' => true,
                'delete' => true,
                'details' => [],
            ],

            [
                'field' => 'status',
                'type' => 'select_dropdown',
                'display_name' => __('versatile::seeders.data_rows.status'),
                'required' => true,
                'browse' => true,
                'read' => true,
                'edit' => true,
                'add' => true,
                'delete' => true,
                'details' => [
                    'default' => 'INACTIVE',
                    'options' => [
                        'INACTIVE' => 'INACTIVE',
                        'ACTIVE' => 'ACTIVE',
                    ],
                ],
            ],

            [
                'field' => 'created_at',
                'type' => 'timestamp',
                'display_name' => __('versatile::seeders.data_rows.created_at'),
                'required' => true,
                'browse' => true,
                'read' => true,
                'edit' => false,
                'add' => false,
                'delete' => false,
                'details' => [],
            ],

            [
                'field' => 'updated_at',
                'type' => 'timestamp',
                'display_name' => __('versatile::seeders.data_rows.updated_at'),
                'required' => true,
                'browse' => false,
                'read' => false,
                'edit' => false,
                'add' => false,
                'delete' => false,
                'details' => [],
            ],

            [
                'field' => 'image',
                'type' => 'image',
                'display_name' => __('versatile::seeders.data_rows.page_image'),
                'required' => false,
                'browse' => true,
                'read' => true,
                'edit' => true,
                'add' => true,
                'delete' => true,
                'details' => [],
            ]
        ]);
    }

    /**
     * POST B(R)EAD - Create data.
     *
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $view = parent::create();
        $view['layouts'] = page_layouts();

        return $view;
    }

    /**
     * POST B(R)EAD - Read data.
     *
     * @param $id
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($id)
    {
        $view = parent::edit($id);
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
