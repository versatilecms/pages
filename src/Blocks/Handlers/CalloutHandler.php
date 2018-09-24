<?php

namespace Versatile\Pages\Blocks\Handlers;

use Versatile\Pages\Blocks\AbstractHandler;

class CalloutHandler extends AbstractHandler
{
    protected $name = 'callout';

    protected $codename = 'callout';

    public function form()
    {
        /**
         * Callout Block
         * - Used for hero banners, CTA sections etc
         */
        return [
            'name' => __('versatile-pages::generic.callout'),
            'template' => 'v-theme::blocks.callout',
            'fields' => [
                'size' => [
                    'field' => 'size',
                    'display_name' => __('versatile-pages::generic.size_of_section'),
                    'partial' => 'select_dropdown',
                    'required' => 1,
                    'options' => [
                        'Small',
                        'Medium',
                        'Large',
                        'Extra Large',
                    ],
                    'placeholder' => 0,
                ],
                'fade_background' => [
                    'field' => 'fade_background',
                    'display_name' => __('versatile-pages::generic.fade_out_background'),
                    'partial' => 'checkbox',
                    'required' => 0,
                ],
                'br_1' => [
                    'field' => 'br_1',
                    'display_name' => __('versatile-pages::generic.line_break'),
                    'partial' => 'break',
                ],
                'background_image' => [
                    'field' => 'background_image',
                    'display_name' => __('versatile-pages::generic.background_image'),
                    'partial' => 'image',
                    'required' => 1,
                ],
                'br_2' => [
                    'field' => 'br_2',
                    'display_name' => __('versatile-pages::generic.line_break'),
                    'partial' => 'break',
                ],
                'title' => [
                    'field' => 'title',
                    'display_name' => __('versatile-pages::generic.title'),
                    'partial' => 'text',
                    'required' => 0,
                    'placeholder' => 'Changing the World!',
                ],
                'content' => [
                    'field' => 'content',
                    'display_name' => __('versatile-pages::generic.content'),
                    'partial' => 'text',
                    'required' => 0,
                    'placeholder' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris.',
                ],
                'br_3' => [
                    'field' => 'br_3',
                    'display_name' => __('versatile-pages::generic.line_break'),
                    'partial' => 'break',
                ],
                'button_text' => [
                    'field' => 'button_text',
                    'display_name' => __('versatile-pages::generic.button_text'),
                    'partial' => 'text',
                    'required' => 0,
                    'placeholder' => 'Learn More',
                ],
                'link' => [
                    'field' => 'link',
                    'display_name' => __('versatile-pages::generic.link'),
                    'partial' => 'text',
                    'required' => 0,
                    'placeholder' => '#',
                ],
                'br_4' => [
                    'field' => 'br_4',
                    'display_name' => __('versatile-pages::generic.line_break'),
                    'partial' => 'break',
                ],
                'spaces' => $this->spacesField(),
                'animate' => $this->animationsField(),
            ],
        ];
    }
}
