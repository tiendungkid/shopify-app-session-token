@extends('laravel-shopify::layouts.empty_layout')

@section('title', 'Login As')

@section('style')
    <link href="{{asset('css/app/add-app.css')}}" rel="stylesheet"/>
@stop

@section('content')
    <div class="middle-box text-center animated fadeInDown">
        @if (isset($errors))
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">{{ $error }}</div>
            @endforeach
        @endif
        <form class="form form-add-app" role="form" action="{{route('login_as_post')}}" method="post">
            {{ csrf_field() }}
            <h4 class="form-add-app-heading">Enter client store's URL</h4>
            <input type="text" class="form-control" name="shop" placeholder="your-shop-url.myshopify.com" required autofocus>
            <button type="submit" class="btn btn-lg btn-primary btn-block">Login As</button>
        </form>
    </div>
@stop
