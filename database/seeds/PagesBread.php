<?php

use Versatile\Core\Seeders\AbstractBreadSeeder;

class PagesBread extends AbstractBreadSeeder
{
    public function bread()
    {
        return [
            'name'                  => 'pages',
            'slug'                  => 'pages',
            'display_name_singular' => __('versatile::seeders.data_types.page.singular'),
            'display_name_plural'   => __('versatile::seeders.data_types.page.plural'),
            'icon'                  => 'versatile-file-text',
            'model_name'            => 'Versatile\\Pages\\Page',
            'controller'            => '\\Versatile\\Pages\\Http\\Controllers\\PagesController',
            'generate_permissions'  => 1
        ];
    }

    public function inputFields()
    {
        return [
            'id' => [
                'type'         => 'number',
                'display_name' => __('versatile::seeders.data_rows.id'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ],

            'author_id' => [
                'type'         => 'text',
                'display_name' => __('versatile::seeders.data_rows.author'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 2,
            ],

            'title' => [
                'type'         => 'text',
                'display_name' => __('versatile::seeders.data_rows.title'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 3,
            ],

            'excerpt' => [
                'type'         => 'text_area',
                'display_name' => __('versatile::seeders.data_rows.excerpt'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 4,
            ],

            'body' => [
                'type'         => 'rich_text_box',
                'display_name' => __('versatile::seeders.data_rows.body'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 5,
            ],

            'slug' => [
                'type'         => 'text',
                'display_name' => __('versatile::seeders.data_rows.slug'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    'slugify' => [
                        'origin' => 'title',
                    ],
                ],
                'order' => 6,
            ],

            'meta_description' => [
                'type'         => 'text',
                'display_name' => __('versatile::seeders.data_rows.meta_description'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 7,
            ],

            'meta_keywords' => [
                'type'         => 'text',
                'display_name' => __('versatile::seeders.data_rows.meta_keywords'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 8,
            ],

            'status' => [
                'type'         => 'select_dropdown',
                'display_name' => __('versatile::seeders.data_rows.status'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    'default' => 'INACTIVE',
                    'options' => [
                        'INACTIVE' => 'INACTIVE',
                        'ACTIVE'   => 'ACTIVE',
                    ],
                ],
                'order' => 9,
            ],

            'created_at' => [
                'type'         => 'timestamp',
                'display_name' => __('versatile::seeders.data_rows.created_at'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 10,
            ],

            'updated_at' => [
                'type'         => 'timestamp',
                'display_name' => __('versatile::seeders.data_rows.updated_at'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 11,
            ],

            'image' => [
                'type'         => 'image',
                'display_name' => __('versatile::seeders.data_rows.page_image'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 12,
            ]
        ];
    }

    public function menu()
    {
        return [
            [
                'role' => 'admin',
                'title' =>  __('versatile::seeders.menu_items.pages'),
                'icon_class' => 'versatile-file-text',
                'order' => 7,
                'route' => 'versatile.pages.index',
            ]
        ];
    }

    public function permissions()
    {
        return [
            [
                'name' => 'browse_pages',
                'description' => null,
                'table_name' => 'pages',
                'roles' => ['admin']
            ],
            [
                'name' => 'edit_pages',
                'description' => null,
                'table_name' => 'pages',
                'roles' => ['admin']
            ],
            [
                'name' => 'add_pages',
                'description' => null,
                'table_name' => 'pages',
                'roles' => ['admin']
            ],
            [
                'name' => 'delete_pages',
                'description' => null,
                'table_name' => 'pages',
                'roles' => ['admin']
            ]
        ];
    }
}
