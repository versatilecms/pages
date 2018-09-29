<?php

namespace Versatile\Pages\Blocks\Handlers;

use Versatile\Pages\Blocks\AbstractHandler;

class ImageRowHandler extends AbstractHandler
{
    protected $name = 'image_row';

    protected $codename = 'image_row';

    public function form()
    {
        /**
         * Row of Images Block
         */
        $form = [
            'name' => __('versatile-pages::generic.row_of_images'),
            'template' => 'v-theme::blocks.image_row',
        ];

        $form['fields']['title'] = [
            'field' => 'title',
            'display_name' => __('versatile-pages::generic.person'),
            'partial' => 'text',
            'required' => false,
            'placeholder' => 'Our Partners',
        ];
        $form['fields']['sub_title'] = [
            'field' => 'sub_title',
            'display_name' => __('versatile-pages::generic.sub_text'),
            'partial' => 'text',
            'required' => false,
            'placeholder' => 'The glue that keeps our company thriving.',
        ];

        for ($col = 1; $col <= 6; $col++) {
            $form['fields']["image_{$col}"] = [
                'field' => "image_{$col}",
                'display_name' => __('versatile-pages::generic.image_col', ['col' => $col]),
                'partial' => 'image',
                'required' => false,
            ];
            $form['fields']["link_{$col}"] = [
                'field' => "link_{$col}",
                'display_name' => __('versatile-pages::generic.link_for_image_col', ['col' => $col]),
                'partial' => 'text',
                'required' => false,
                'placeholder' => '#',
            ];
            $form['fields']["br_{$col}"] = [
                'field' => "br_{$col}",
                'display_name' => __('versatile-pages::generic.line_break'),
                'partial' => 'break',
            ];
        }

        $form['fields']['spaces'] = $this->spacesField();
        $form['fields']['animate'] = $this->animationsField();

        return $form;
    }
}
