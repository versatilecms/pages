<?php

namespace Versatile\Pages;

use Versatile\Core\Models\BaseModel;
use Illuminate\Support\Facades\Auth;
use Versatile\Core\Traits\HasRelationships;
use Versatile\Core\Traits\Translatable;
use Versatile\Front\Helpers\ClassEvents;
use Laravel\Scout\Searchable;
use Versatile\Front\Helpers\BladeCompiler;

class Page extends BaseModel
{
    use Translatable,
        HasRelationships,
        Searchable;

    public $asYouType = false;

    protected $translatable = [
        'title',
        'slug',
        'body'
    ];

    /**
     * Statuses.
     */
    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_INACTIVE = 'INACTIVE';

    /**
     * List of statuses.
     *
     * @var array
     */
    public static $statuses = [self::STATUS_ACTIVE, self::STATUS_INACTIVE];

    protected $guarded = [];

    public function save(array $options = [])
    {
        // If no author has been assigned, assign the current user's id as the author of the post
        if (!$this->author_id && Auth::user()) {
            $this->author_id = Auth::user()->id;
        }

        parent::save();
    }

    /**
     * Scope a query to only include active pages.
     *
     * @param  $query  \Illuminate\Database\Eloquent\Builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', static::STATUS_ACTIVE);
    }

    // Add relation to page blocks
    public function blocks()
    {
        return $this->hasMany('Versatile\Pages\PageBlock');
    }

    /**
     * Get the indexed data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Include page block data to be "Searchable"
        $pageBlocks = $this->blocks()->get()->map(function ($block) {
            // If it's an included file, return the HTML of this block to be searched
            if ($block->type === 'include') {
                return trim(preg_replace(
                    '/\s+/',
                    ' ',
                    strip_tags(ClassEvents::executeClass($block->path)->render())
                ));
            }

            $blockContent = [];

            foreach ($block->data as $datum) {
                $blockContent[] = strip_tags($datum);
            }

            return $blockContent;
        });

        $array['page_blocks'] = implode(' ', array_flatten($pageBlocks));

        return $array;
    }

    /**
     * Get the indexed data array for the model.
     *
     * @return array
     */
    // public function toSearchableArray()
    // {
    //     return $this->toArray();
    // }
}
