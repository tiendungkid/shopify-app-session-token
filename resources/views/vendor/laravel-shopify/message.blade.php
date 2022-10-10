@extends('laravel-shopify::layouts.empty_layout')

@section('title', 'Message')

@section('style')
    <link href="{{asset('css/app/add-app.css')}}" rel="stylesheet"/>
@stop

@section('content')
    <div class="middle-box text-center animated fadeInDown">
        @if (session('status')=='error')
            <div class="alert alert-danger" role="alert">{{ session('message') }}</div>
        @elseif  (session('status')=='warning')
            <div class="alert alert-warning" role="alert">{{ session('message') }}</div>
        @else
            <div class="alert alert-info" role="alert">{{ session('message') }}</div>
        @endif
    </div>
@stop

