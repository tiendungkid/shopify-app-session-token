@extends('laravel-shopify::layouts.empty_layout')

@section('style')
@stop

@section('title', 'Add App')

@section('content')
    <div class="loginColumns animated fadeInDown">
        @if (isset($errors))
            <div class="row">
                <div class="col-md-12">
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-6">
                <h2 class="font-bold text-center">Welcome to CA</h2>
                <ul>
                <li>
                    Customers can create a comprehensive profile with your custom fields on registration page, cart page and account page
                </li>
                <li>
                    Help you gain deeper customer insight with visual reports
                </li>
                <li>
                    Support many field types: Text Field, Select box, dropdown, multiple select…, result in beautiful and smart frontend
                </li>
                </ul>
            </div>
            <div class="col-md-6">
                <div class="ibox-content">
                    <form class="m-t" role="form" action="{{route('add_app_post')}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input name="shop" value="{{$shop or ''}}" type="text" class="form-control" placeholder="your-shop-url.myshopify.com" required autofocus>
                        </div>
                        <div class="form-group">
                            <input name="coupon_code" value="{{$couponCode or ''}}" type="text" class="form-control" placeholder="Coupon">
                        </div>
                        <button type="submit" class="btn btn-primary block full-width m-b">Install</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
