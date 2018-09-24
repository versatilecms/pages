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
        $this->seed('PagesBread');
        $this->seed('DataSeeder');

        $this->seed('PageBlocksBread');
        $this->seed('PageBlocksSeeder');
    }
}
