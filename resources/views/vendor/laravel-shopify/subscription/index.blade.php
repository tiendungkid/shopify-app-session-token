@extends('laravel-shopify::layouts.main_layout')

@section('title', 'Subscription')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content">
                @include('vendor.laravel-shopify._partials.errors')
                @include('vendor.laravel-shopify._partials.success')
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="2">Current Subscription</th>
                            <th>Current Price</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">
                                <i class="fa fa-envelope-o fa-5x text-success" aria-hidden="true"></i>
                            </td>
                            <td>
                                <p><strong>{{$plan->name}}</strong></p>
                                <p class="text-muted small">@if($charge && $charge->coupon_code) with Coupon: {{$charge->coupon_code}}@endif</p>
                            </td>
                            <td>@if($charge) ${{$charge->price}}/month @else FREE @endif</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <span class="fa-stack fa-3x text-success">
                                  <i class="fa fa-certificate fa-stack-2x"></i>
                                  <i class="fa fa-tag fa-stack-1x fa-inverse"></i>
                                </span>
                            </td>
                            <td>
                                <p><strong>Discount Code</strong></p>
                                <p class="text-muted small">{{ $couponCode or 'Enter your discount code' }}</p>
                            </td>
                            <td></td>
                            <td>
                                <button id="discount-code-command" type="button" class="btn btn-primary">Enable</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@push('style')
    <link href="{{asset('css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
    <style>
        .table-bordered > thead > tr > th,
        .table-bordered > tbody > tr > th,
        .table-bordered > tfoot > tr > th,
        .table-bordered > thead > tr > td,
        .table-bordered > tbody > tr > td,
        .table-bordered > tfoot > tr > td {
            border: 1px solid #dddddd;
            border-right-width:0;
            border-left-width:0;
        }
        .table-bordered > tbody > tr > td {
            vertical-align: middle;
        }
        .table-bordered > thead > tr > th {
            background-color: #f5f5f5;
        }
    </style>
@endpush

@push('script')
<script src="{{asset('js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script type="text/javascript">
    $(function () {
        $('#discount-code-command').on('click', function () {
            swal({
                title: '<p class="text-center"><span class="fa-stack fa-3x text-success"><i class="fa fa-certificate fa-stack-2x"></i><i class="fa fa-tag fa-stack-1x fa-inverse"></i></span></p>',
                text: '<p>Enter your discount code:</p>',
                type: "input",
            @if($couponCode)
                inputValue: "{{ $couponCode }}",
            @endif
                showCancelButton: true,
                closeOnConfirm: false,
                animation: "slide-from-top",
                confirmButtonText: "Confirm!",
                inputPlaceholder: "coupon code",
                html: true
            },
            function(couponCode){
                if (couponCode === false || couponCode === "") return false;

                window.location = 'discount/' + couponCode;
            });
        })
    });
</script>
@endpush