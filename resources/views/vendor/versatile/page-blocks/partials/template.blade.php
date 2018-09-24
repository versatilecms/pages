<li class="dd-item" data-id="{{ $block->id }}" id="block-id-{{ $block->id }}">
    <i class="glyphicon glyphicon-sort order-handle"></i>

    <div class="panel panel-bordered panel-info @if ($block->is_minimized == 1) panel-collapsed @endif">
        <div class="panel-heading">

            <h3 class="panel-title">
                <a class="panel-action panel-collapse-icon versatile-angle-up" data-toggle="block-collapse" style="cursor:pointer">
                    {{ $template->name }}
                    @if (!empty($template->description)) <span class="panel-desc"> {{ $template->description }}</span>@endif
                </a>
            </h3>
            <div class="panel-actions">
                <a class="panel-action versatile-resize-full" data-toggle="panel-fullscreen" aria-hidden="true"></a>
            </div>
        </div>

        <div class="panel-body" @if ($block->is_minimized == 1) style="display:none" @endif>
            <form role="form" action="{{ route('versatile.page-blocks.update', $block->id) }}" method="POST"
                  enctype="multipart/form-data">
                {{ method_field("PUT") }}
                {{ csrf_field() }}

                <div class="row">
                    @foreach($template->fields as $row)
                        @if ($row->partial === 'break')
                            </div> <!-- /.row --><div class="row"> @continue
                        @endif

                    @php $options = $row; @endphp

                    <div class="@if (strpos($row->partial, 'rich_text_box') !== false)col-md-12 @else col-md-6 @endif">
                        <div class="form-group">
                            <label>{{ $row->display_name }}</label>

                            @php
                                $field = "versatile::_components.fields.form.{$row->partial}";
                                $dataTypeContent = $block->data;
                            @endphp

                            @if(view()->exists($field))
                                @include($field)
                            @endif
                        </div> <!-- /.form-group -->
                    </div> <!-- /.col -->
                    @endforeach
                </div> <!-- /.row -->

                <div class="well" style="padding-bottom:0; margin-bottom:10px">
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="cache_ttl">{{ __('versatile-pages::generic.cache_time') }}</label>
                                <select name="cache_ttl" id="cache_ttl" class="form-control">
                                    <option value="0" {{ $block->cache_ttl === 0 ? 'selected="selected"' : '' }}>
                                        {{ __('versatile::generic.disabled') }}
                                    </option>
                                    <option value="5" {{ $block->cache_ttl === 5 ? 'selected="selected"' : '' }}>
                                        5 {{ __('versatile::generic.minutes') }}
                                    </option>
                                    <option value="30" {{ $block->cache_ttl === 30 ? 'selected="selected"' : '' }}>
                                        30 {{ __('versatile::generic.minutes') }}
                                    </option>
                                    <option value="60" {{ $block->cache_ttl === 60 ? 'selected="selected"' : '' }}>
                                        1 {{ __('versatile::generic.hour') }}
                                    </option>
                                    <option value="240" {{ $block->cache_ttl === 240 ? 'selected="selected"' : '' }}>
                                        4 {{ __('versatile::generic.hours') }}
                                    </option>
                                    <option value="1440" {{ $block->cache_ttl === 1440 ? 'selected="selected"' : '' }}>
                                        1 {{ __('versatile::generic.day') }}
                                    </option>
                                    <option value="10080" {{ $block->cache_ttl === 10080 ? 'selected="selected"' : '' }}>
                                        7 {{ __('versatile::generic.days') }}
                                    </option>
                                </select>
                            </div> <!-- /.form-group -->
                        </div> <!-- /.col -->

                        <div class="col-md-6 col-lg-8">
                            <label>{{ __('versatile::generic.options') }}</label>

                            <div class="row">
                                <div class="col-md-6 col-lg-5">
                                    <div class="form-group">
                                        <input
                                                type="checkbox"
                                                name="is_hidden"
                                                id="is_hidden"
                                                data-name="is_hidden"
                                                class="toggleswitch"
                                                value="1"
                                                data-on="{{ __('versatile::generic.yes') }}" {{ $block->is_hidden ? 'checked="checked"' : '' }}
                                                data-off="{{ __('versatile::generic.no') }}"
                                        />
                                        <label for="is_hidden"> {{ __('versatile-pages::generic.hide_block') }}</label>
                                    </div> <!-- /.form-group -->
                                </div> <!-- /.col -->

                                <div class="col-md-6 col-lg-5">
                                    <div class="form-group">
                                        <input
                                                type="checkbox"
                                                name="is_delete_denied"
                                                id="is_delete_denied"
                                                data-name="is_delete_denied"
                                                class="toggleswitch"
                                                value="1"
                                                data-on="{{ __('versatile::generic.yes') }}" {{ $block->is_delete_denied ? 'checked="checked"' : '' }}
                                                data-off="{{ __('versatile::generic.no') }}"
                                        />
                                        <label for="is_delete_denied"> {{ __('versatile-pages::generic.prevent_deletion') }}</label>
                                    </div> <!-- /.form-group -->
                                </div> <!-- /.col -->
                            </div> <!-- /.row -->
                        </div> <!-- /.col -->
                    </div> <!-- /.row -->
                </div> <!-- /.well -->

                <span class="btn-group-lg">
                    <button
                            style="float:left"
                            type="submit"
                            class="btn btn-success btn-lg save"
                    >{{ __('versatile-pages::generic.save_this_block') }}</button>
                </span>
            </form>

            @if (!$block->is_delete_denied)
                <form method="POST" action="{{ route('versatile.page-blocks.destroy', $block->id) }}">
                    {{ method_field("DELETE") }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <span class="btn-group-xs">
                        <button
                                data-delete-block-btn
                                type="submit"
                                style="float:right; margin-top:22px"
                                class="btn btn-danger btn-xs delete"
                        >{{ __('versatile-pages::generic.delete_this_block') }}</button>
                    </span>
                </form>
            @endif
        </div> <!-- /.panel-body -->
    </div> <!-- /.panel -->
</li> <!-- /.dd-item -->
