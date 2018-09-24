<?php

use Versatile\Pages\Page;
use Versatile\Pages\PageBlock;
use Illuminate\Database\Seeder;

class PageBlocksSeeder extends Seeder
{
    public function run()
    {
        exit($this->insertBlocks());
    }

    public function blocks()
    {
        return [
            [
                'page' => 'home',
                'type' => 'template',
                'path' => 'testimonial',
                'data' => [
                    'content' => 'Company X is both attractive and highly adaptable. Company X has really helped our business thrive - I can\'t wait to see what comes next for us',
                    'title' => 'John Smith',
                    'sub_title' => 'Founder & CEO',
                    'br_1' => 'null',
                    'image' => '',
                    'br_2' => 'null',
                    'spaces' => '3',
                    'animate' => 'on',
                ],
                'is_hidden' => 0,
                'is_minimized' => 1,
                'is_delete_denied' => 0,
                'cache_ttl' => 0,
                'order' => '10000',
            ],
            [
                'page' => 'home',
                'type' => 'template',
                'path' => 'content_one_column',
                'data' => [
                    'html_content_1' => '<h2 style=\"text-align: center;\">Welcome to Versatile Frontend</h2><p style=\"text-align: center;\">Matey yardarm topmast broadside nipper weigh anchor jack quarterdeck crow\'s nest rigging. Topgallant lateen sail line avast me gun Pirate Round strike colors bilge rat take a caulk. Jack six pounders spanker doubloon clipper spirits case shot hang the jib boatswain red ensign.</p><p style=\"text-align: center;\">Hornswaggle spanker spyglass Yellow Jack mutiny Arr lugger poop deck keel take a caulk. Quarter fire ship run a shot across the bow sheet log draft scallywag gally port skysail. Lugsail gangway draft pink piracy bilge Buccaneer heave to landlubber or just lubber Pieces of Eight.</p>',
                    'spaces' => '2',
                    'animate' => 'on',
                ],
                'is_hidden' => 0,
                'is_minimized' => 1,
                'is_delete_denied' => 0,
                'cache_ttl' => 0,
                'order' => '10000',
            ],
            [
                'page' => 'home',
                'type' => 'template',
                'path' => 'content_two_columns',
                'data' => [
                    'html_content_1' => '<p style=\"text-align: left;\">Matey yardarm topmast broadside nipper weigh anchor jack quarterdeck crow\'s nest rigging. Topgallant lateen sail line avast me gun Pirate Round strike colors bilge rat take a caulk. Jack six pounders spanker doubloon clipper spirits case shot hang the jib boatswain red ensign.</p><p style=\"text-align: left;\"></p>',
                    'html_content_2' => '<p><span style=\"text-align: center;\">Hornswaggle spanker spyglass Yellow Jack mutiny Arr lugger poop deck keel take a caulk. Quarter fire ship run a shot across the bow sheet log draft scallywag gally port skysail. Lugsail gangway draft pink piracy bilge Buccaneer heave to landlubber or just lubber Pieces of Eight.</span></p>',
                    'spaces' => '0',
                    'animate' => 'on',
                ],
                'is_hidden' => 0,
                'is_minimized' => 1,
                'is_delete_denied' => 0,
                'cache_ttl' => 0,
                'order' => '10000',
            ],
            [
                'page' => 'about',
                'type' => 'template',
                'path' => 'content_one_column',
                'data' => [
                    'html_content_1' => '<p style=\"text-align: center;\">Matey yardarm topmast broadside nipper weigh anchor jack quarterdeck crow\'s nest rigging. Topgallant lateen sail line avast me gun Pirate Round strike colors bilge rat take a caulk. Jack six pounders spanker doubloon clipper spirits case shot hang the jib boatswain red ensign.</p><p style=\"text-align: center;\">Hornswaggle spanker spyglass Yellow Jack mutiny Arr lugger poop deck keel take a caulk. Quarter fire ship run a shot across the bow sheet log draft scallywag gally port skysail. Lugsail gangway draft pink piracy bilge Buccaneer heave to landlubber or just lubber Pieces of Eight.</p>',
                    'spaces' => '2',
                    'animate' => 'on',
                ],
                'is_hidden' => 0,
                'is_minimized' => 1,
                'is_delete_denied' => 0,
                'cache_ttl' => 0,
                'order' => '10000',
            ],
            [
                'page' => 'contact',
                'type' => 'template',
                'path' => 'content_one_column',
                'data' => [
                    'html_content_1' => '<p>{!! forms(1) !!}</p>',
                    'spaces' => '1',
                    'animate' => 'on',
                ],
                'is_hidden' => 0,
                'is_minimized' => 1,
                'is_delete_denied' => 0,
                'cache_ttl' => 0,
                'order' => '10000',
            ]
        ];
    }

    public function insertBlocks()
    {

        foreach ($this->blocks() as $block) {

            $block = (object) $block;

            $page = Page::where('slug', $block->page)->first(['id']);

            if (is_null($page)) {
                continue;
            }

            $model = PageBlock::firstOrNew([
                'page_id' => $page->id,
                'path' => $block->path
            ]);

            $model->page_id = $page->id;

            $model->fill([
                'type' => $block->type,
                'path' => $block->path,
                'data' => $block->data,
                'is_hidden' => $block->is_hidden,
                'is_minimized' => $block->is_minimized,
                'is_delete_denied' => $block->is_delete_denied,
                'cache_ttl' => $block->cache_ttl,
                'order' => $block->order
            ])->save();
        }
    }
}
