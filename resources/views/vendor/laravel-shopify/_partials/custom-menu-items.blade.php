@foreach($items as $item)
    <li @lm-attrs($item) @if($item->hasChildren()) class="dropdown" @endif data-test="test" @lm-endattrs>
        <a href="{!! $item->url() !!}">{!! $item->title !!} </a>
        @if($item->hasChildren())
            <ul class="nav nav-second-level collapse in">
                @include('laravel-shopify::_partials.custom-menu-items', array('items' => $item->children()))
            </ul>
        @endif
    </li>
@endforeach