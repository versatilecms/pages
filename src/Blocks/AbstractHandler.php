<?php

namespace Versatile\Pages\Blocks;

use Versatile\Core\Traits\Renderable;
use Versatile\Pages\PageBlock;

abstract class AbstractHandler //implements HandlerInterface
{
    use Renderable;

    protected $name;
    protected $codename;
    protected $viewPath = 'v-theme::blocks';

    public function handle()
    {
    }

    /**
     * @param PageBlock $block
     * @return string
     * @throws \Throwable
     */
    public function handleForm(PageBlock $block)
    {
        if ($block->type === 'template') {

            $template = json_decode(json_encode($this->form()));

            return view('versatile::page-blocks.partials.template', [
                'block' => $block,
                'template' => $template
            ])->render();

        }

        // return view('versatile::page-blocks.partials.include', [
        //    'block' => $block
        // ])->render();
    }

    public function getCodename()
    {
        if (empty($this->codename)) {
            $name = class_basename($this);

            if (ends_with($name, 'Handler')) {
                $name = substr($name, 0, -strlen('Handler'));
            }

            $this->codename = snake_case($name);
        }

        return $this->codename;
    }

    public function getName()
    {
        if (empty($this->name)) {
            $this->name = ucwords(str_replace('_', ' ', $this->getCodename()));
        }

        return $this->name;
    }

    public function spacesField()
    {
        return [
            'field' => 'spaces',
            'display_name' => __('versatile-pages::generic.add_vertical_space'),
            'partial' => 'versatile::_components.fields.form.select_dropdown',
            'required' => false,
            'options' => [
                'Bottom',
                'Top',
                'Top & Bottom',
                'None',
            ],
            'placeholder' => 0,
        ];
    }

    public function animationsField()
    {
        return [
            'field' => 'animate',
            'display_name' => __('versatile-pages::generic.animate_this_block'),
            'partial' => 'versatile::_components.fields.form.checkbox',
            'placeholder' => 'on',
            'required' => false,
        ];
    }
}
