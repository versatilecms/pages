<?php

use Versatile\Core\Seeders\AbstractBreadSeeder;

class PagesTableSeeder extends AbstractBreadSeeder
{
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
