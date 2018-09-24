<?php

namespace Versatile\Pages\Blocks;

class Blocks
{
    protected $blocks = [];

    public function handleForm($model)
    {
        $block = $this->get($model->path);
        return $block->handleForm($model);
    }

    public function get($path)
    {
        return $this->blocks[$path];
    }

    public function form($block)
    {
        $block = $this->blocks[$block];
        return $block->form();
    }

    /**
     * @param $handler
     * @return $this
     */
    public function add($handler)
    {
        if (!$handler instanceof HandlerInterface) {
            $handler = app($handler);
        }

        $this->blocks[$handler->getCodename()] = $handler;

        return $this;
    }

    /**
     * @return static
     */
    public function all()
    {
        return collect($this->blocks);
    }
}
