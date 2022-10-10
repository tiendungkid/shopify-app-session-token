<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') | Customer Attribute </title>

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

    <style>
        .skin-3 .wrapper-content {
            padding: 15px 15px;
        }
        .skin-3 .command {
            margin-top: 40px;
        }
    </style>
    @yield('style')
</head>

<body class="skin-3">

<div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            @include('laravel-shopify::_partials.custom-menu')
        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    <form role="search" class="navbar-form-custom" method="post" action="#">
                        <div class="form-group">
                            <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                        </div>
                    </form>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a class="command-logout" href="#">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>

            </nav>
        </div>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-xs-6 col-lg-9">
                <h2>@yield('title')</h2>
                {!! Breadcrumbs::render() !!}
            </div>
            <div class="col-xs-6 col-lg-3">
                <div class="text-right command">
                    <div class="btn-group" role="group">
                        @yield('command')
                    </div>
                </div>
            </div>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                @yield('content')
            </div>
        </div>

        <div class="footer">
            <div class="pull-right">
                .
            </div>
            <div>
                <strong>Copyright</strong> Secomapp &copy; 2013-2017
            </div>
        </div>

    </div>
</div>

<!-- Mainly scripts -->
<script src="{{asset('js/jquery-2.1.1.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
<script src="{{asset('js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

<!-- Custom and plugin javascript -->
<script src="{{asset('js/inspinia.js')}}"></script>
<script src="{{asset('js/plugins/pace/pace.min.js')}}"></script>

<script>
    $(function(){
        $('a.command-logout').on('click', function () {
            $.ajax({
                dataType: "json",
                url: "{{route('logout')}}",
                type: "GET",
            }).done(function(json){
                window.close();
            });
        });
    });
</script>

@yield('script')

</body>

</html>