<div class="btn-group btn-group-lg" role="group">
    <a href="{{ route('versatile.pages.edit', $pageId) }}" class="btn @if($tab == 'page') btn-primary @else btn-default @endif">
        <i class="icon versatile-file-text"></i> {{ __('versatile::generic.content') }}
    </a>

    <a href="{{ route('versatile.page-blocks.edit', $pageId) }}" class="btn @if($tab == 'blocks') btn-primary @else btn-default @endif">
        <i class="icon versatile-puzzle"></i> {{ __('versatile::generic.blocks') }}
    </a>
</div>
