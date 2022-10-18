@extends('app')
@section('head')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection
@section('content')
    <div class="container">
        <div class="slider-container">
            <div class="slider-content">
                <i class="fa fa-quote-left" aria-hidden="true"></i>
                <div>
                    <p class="slider-text">
                        The app is incredibly easy to install and makes the learning curve less intense. In would
                        recommend for anyone looking to learn and do Affiliate Marketing.
                    </p>
                    <p class="slider-author">
                        <b>Airbnbae on Shopify</b>
                    </p>
                </div>
            </div>
        </div>
        <div class="register-container">
            <img class="logo" src="{{ asset('img/brand/logo.png') }}" alt="logo">
            <div class="welcome-container">
                <h2>Welcome to UpPromote</h2>
                <div class="welcome-text">
                    <p>
                        Thank you for choosing
                        <b>UpPromote: Affiliate Marketing.</b>
                        We hope that we will be a trusting partner on your success journey.
                    </p>
                    <p>
                        Dashboard an account now and start building your campaign with UpPromote.
                    </p>
                </div>
                <button class="btn btn-register">
                    <span>Register now</span>
                    <i class="fa fa-circle-o-notch fa-spin" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script src="{{ asset('js/register.js') }}"></script>
@endsection
