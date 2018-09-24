<?php

namespace Versatile\Pages\Blocks;

interface HandlerInterface
{
    public function handle();

    public function render($content);

    public function form();

    public function createContent();

    public function getCodename();

    public function getName();
}
