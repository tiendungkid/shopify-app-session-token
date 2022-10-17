@extends('app')
@section('head')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection
@section('content')
    <div class="container">
        <div class="page-header">
            <div class="page-name">Homepage</div>
            <div class="page-divider"></div>
        </div>
        <div class="page-content">
            @foreach(config('pages-navigation') as $category)
                <div class="category-feature-container">
                    <div class="category-name">{{ $category['name'] }}</div>
                    <div class="category-description">{{ $category['description'] }}</div>
                    <div class="features">
                        @foreach($category['items'] as $feature)
                            <div class="feature">
                                <div class="feature-content">
                                    <div class="feature-name">{{ $feature['name'] }}</div>
                                    <div class="feature-description">{{ $feature['text'] }}</div>
                                </div>
                                <button class="btn btn-redirect" data-redirect-url="{{ $feature['button_link'] }}">
                                    {{ $feature['button_text'] }}
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
