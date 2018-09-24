<?php

use Versatile\Core\Seeders\AbstractBreadSeeder;

class PageBlocksBread extends AbstractBreadSeeder
{
    public function bread()
    {
        return [
            'name' => 'page_blocks',
            'slug' => 'page-blocks',
            'display_name_singular' => __('versatile::seeders.data_types.page_block.singular'),
            'display_name_plural'   => __('versatile::seeders.data_types.page_block.plural'),
            'icon' => 'versatile-puzzle',
            'model_name' => 'Versatile\Pages\PageBlock',
            'controller' => '\Versatile\Pages\Http\Controllers\PageBlocksController',
            'generate_permissions' => '1',
        ];
    }

    public function permissions()
    {
        return [
            [
                'name' => 'browse_page_blocks',
                'description' => null,
                'table_name' => 'page_blocks',
                'roles' => ['admin']
            ],
            [
                'name' => 'read_page_blocks',
                'description' => null,
                'table_name' => 'page_blocks',
                'roles' => ['admin']
            ],
            [
                'name' => 'edit_page_blocks',
                'description' => null,
                'table_name' => 'page_blocks',
                'roles' => ['admin']
            ],
            [
                'name' => 'add_page_blocks',
                'description' => null,
                'table_name' => 'page_blocks',
                'roles' => ['admin']
            ],
            [
                'name' => 'delete_page_blocks',
                'description' => null,
                'table_name' => 'page_blocks',
                'roles' => ['admin']
            ],
            [
                'name' => 'filter_page_blocks',
                'description' => null,
                'table_name' => 'page_blocks',
                'roles' => ['admin']
            ],
        ];
    }
}
