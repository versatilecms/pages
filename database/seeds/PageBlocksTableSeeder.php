<?php

use Versatile\Core\Seeders\AbstractBreadSeeder;

class PageBlocksTableSeeder extends AbstractBreadSeeder
{
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
