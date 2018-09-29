<?php

use Versatile\Core\Traits\Seedable;
use Illuminate\Database\Seeder;

class PagesDatabaseSeeder extends Seeder
{
    use Seedable;

    protected $seedersPath = __DIR__ . '/';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seed('PagesTableSeeder');
        $this->seed('DataTableSeeder');

        $this->seed('PageBlocksTableSeeder');
        $this->seed('PageBlocksSeeder');
    }
}
