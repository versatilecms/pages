<?php

namespace Versatile\Pages\Blocks\Handlers;

use Versatile\Pages\Blocks\AbstractHandler;

class CardsOneColumnHandler extends AbstractHandler
{
    protected $name = 'cards_one_column';

    protected $codename = 'cards_one_column';

    public function form()
    {
        /**
         * (Column'd) Cards Block
         */

        $numCols = 1;

        $form = [
            'name' => trans_choice('versatile-pages::generic.cards_columns', $numCols, ['cols' => $numCols]),
            'template' => 'v-theme::blocks.cards_one_column',
        ];

        for ($col = 1; $col <= $numCols; $col++) {
            $form['fields']["image_{$col}"] = [
                'field' => "image_{$col}",
                'display_name' => __('versatile-pages::generic.column_image', ['col' => $col]),
                'partial' => 'image',
                'required' => 0,
            ];

            if ($numCols === 1) {
                $form['fields']["image_position_{$col}"] = [
                    'field' => "image_position_{$col}",
                    'display_name' => __('versatile-pages::generic.position_of_column_image', ['col' => $col]),
                    'partial' => 'select_dropdown',
                    'required' => 0,
                    'options' => [
                        'Left',
                        'Right',
                    ],
                    'placeholder' => 0,
                ];
            }

            $form['fields']["br_{$col}_1"] = [
                'field' => "br_{$col}_1",
                'display_name' => __('versatile-pages::generic.line_break'),
                'partial' => 'break',
            ];
            $form['fields']["title_{$col}"] = [
                'field' => "title_{$col}",
                'display_name' => __('versatile-pages::generic.column_title', ['col' => $col]),
                'partial' => 'text',
                'required' => 0,
                'placeholder' => 'Changing the World!',
            ];
            $form['fields']["content_{$col}"] = [
                'field' => "content_{$col}",
                'display_name' => __('versatile-pages::generic.column_content', ['col' => $col]),
                'partial' => 'text',
                'required' => 0,
                'placeholder' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris.',
            ];
            $form['fields']["br_{$col}_2"] = [
                'field' => "br_{$col}_2",
                'display_name' => __('versatile-pages::generic.line_break'),
                'partial' => 'break',
            ];
            $form['fields']["button_text_{$col}"] = [
                'field' => "button_text_{$col}",
                'display_name' => __('versatile-pages::generic.button_column_text', ['col' => $col]),
                'partial' => 'text',
                'required' => 0,
                'placeholder' => 'Learn More',
            ];
            $form['fields']["link_{$col}"] = [
                'field' => "link_{$col}",
                'display_name' => __('versatile-pages::generic.column_link', ['col' => $col]),
                'partial' => 'text',
                'required' => 0,
                'placeholder' => '#',
            ];
            $form['fields']["br_{$col}_3"] = [
                'field' => "br_{$col}_3",
                'display_name' => __('versatile-pages::generic.line_break'),
                'partial' => 'break',
            ];
        }
        $form['fields']['spaces'] = $this->spacesField();
        $form['fields']['animate'] = $this->animationsField();

        return $form;
    }
}
