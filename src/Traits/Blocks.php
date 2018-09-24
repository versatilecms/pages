<?php

namespace Versatile\Pages\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Versatile\Front\Helpers\ClassEvents;
use Versatile\Front\Helpers\BladeCompiler;
use Versatile\Pages\Facades\Blocks as BlocksFacade;

trait Blocks
{
    /**
     * Ensure each page block has the correct data, in the correct format
     *
     * @param Collection $blocks
     * @return array
     */
    protected function prepareEachBlock(Collection $blocks)
    {
        return array_map(function ($block) {
            // 'Include' block types
            if ($block->type === 'include' && !empty($block->path)) {
                $block->html = ClassEvents::executeClass($block->path)->render();
            }

            // 'Template' block types
            if ($block->type === 'template' && !empty($block->template)) {
                $block = $this->prepareTemplateBlockTypes($block);
            }

            // Add HTML to cache by key: $block->id - $block->page_id - $block->updated_at
            $cacheKey = "blocks/{$block->id}-{$block->page_id}-{$block->updated_at}";

            $ttl = $block->cache_ttl;
            // When not in local dev (eg. prod), let's always cache for at least 1min
            if (empty($ttl) && app('env') != 'local') {
                $ttl = 1;
            }
            return Cache::remember($cacheKey, $ttl, function () use ($block) {
                return $block;
            });
        }, $blocks->toArray());
    }

    /**
     * Ensure each page block has all of the keys from
     * config, in the DB output (to prevent errors in views)
     * + compile each piece of HTML (eg. for short codes)
     *
     * @param $block
     * @return mixed
     * @throws \Exception
     */
    protected function prepareTemplateBlockTypes($block)
    {
        $templateKey = $block->path;
        $templateConfig = BlocksFacade::form($templateKey);

        // Ensure every key from config exists in collection
        foreach ((array)$templateConfig['fields'] as $fieldName => $fieldConfig) {
            if (!array_key_exists($fieldName, $block->data)) {
                $block->data->{$fieldName} = null;
            }
        }

        // Compile each piece of content from the DB, into HTML
        foreach ($block->data as $key => $data) {
            $block->data->{$key} = BladeCompiler::getHtmlFromString($data);
        }

        // Compile the Blade View to give us HTML output
        if (View::exists($block->template)) {
            $block->html = View::make($block->template, [
                'blockData' => $block->data,
            ])->render();
        }

        return $block;
    }

    /**
     * @param Request $request
     * @param array $data
     * @return array
     */
    public function uploadImages(Request $request, array $data): array
    {
        foreach ($request->files as $key => $file) {
            $filePath = $request->file($key)->store('public/blocks');
            $data[$key] = str_replace('public/', '', $filePath);
        }

        return $data;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function generatePlaceholders(Request $request): array
    {
        $configKey = explode('|', $request->type)[1];

        return array_map(function ($field) {
            return array_key_exists('placeholder', $field) ? $field['placeholder'] : '';
        }, BlocksFacade::form($configKey)['fields']);
    }
}
