<?php

namespace Versatile\Pages\Actions;

use Versatile\Core\Components\Actions\AbstractAction;

class BlocksAction extends AbstractAction
{
    public function getTitle()
    {
        return __('versatile::generic.blocks');
    }

    public function getCodename()
    {
        return 'blocks';
    }

    public function getIcon()
    {
        return 'versatile-puzzle';
    }

    public function getPolicy()
    {
        return 'edit';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-primary pull-right edit',
        ];
    }

    public function getDefaultRoute()
    {
        return route('versatile.page-blocks.edit', $this->data->{$this->data->getKeyName()});
    }
}
