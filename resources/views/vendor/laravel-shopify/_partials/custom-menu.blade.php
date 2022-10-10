<ul class="nav metismenu" id="side-menu">
    <li class="nav-header">
        <div class="dropdown profile-element">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <span class="clear">
                    <span class="block m-t-xs"> <strong class="font-bold">{{ $user->shop_name }}</strong></span>
                    <span class="text-muted text-xs block">{{ $user->shop_owner }}<b class="caret"></b></span>
                </span>
            </a>
            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                <li><a href="#">Logout</a></li>
            </ul>
        </div>
        <div class="logo-element">
            CA+
        </div>
    </li>
    @include('laravel-shopify::_partials.custom-menu-items', array('items' => $metismenu->roots()))
</ul>

