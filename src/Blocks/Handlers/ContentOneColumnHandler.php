<?php

namespace Versatile\Pages\Blocks\Handlers;

use Versatile\Pages\Blocks\AbstractHandler;

class ContentOneColumnHandler extends AbstractHandler
{
    protected $name = 'content_one_column';

    protected $codename = 'content_one_column';

    public function form()
    {
        /**
         * (Column'd) Content Block
         * - Can be used for standard WYSIWYG content
         */

        $numCols = 1;

        $form = [
            'name' => trans_choice('versatile-pages::generic.content_columns', $numCols, ['cols' => $numCols]),
            'template' => 'v-theme::blocks.content_one_column',
        ];

        for ($col = 1; $col <= $numCols; $col++) {
            $form['fields']["html_content_{$col}"] = [
                'field' => "html_content_{$col}",
                'display_name' => __('versatile-pages::generic.column_content', ['col' => $col]),
                'partial' => 'rich_text_box',
                'required' => 0,
                'placeholder' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris.</p>',
            ];
        }

        $form['fields']['spaces'] = $this->spacesField();
        $form['fields']['animate'] = $this->animationsField();

        return $form;

    }
}
