@extends('laravel-shopify::layouts.main_layout')

@section('title', 'Discount Offer')

@section('content')
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="membership-pricing-table">
            <table class="table-responsive">
                <thead><tr>
                    <th class="col-sm-2">Features \ Plan</th>
                    <th class="plan-header plan-header-standard col-sm-2">
                        <div class="header-plan-inner">
                            <span class="recommended-plan-ribbon">Your plan</span>
                            <div class="pricing-plan-name">{{$plan->name}}</div>
                            <div class="pricing-plan-price">
                                @if($hasDiscount)
                                    <sup>$</sup>{{intval($charge->price)}}<span>.{{intval(round($charge->price - intval($charge->price), 2)*100)}}</span>
                                @else
                                    <sup>$</sup>{{intval($plan->price)}}<span>.{{intval(round($plan->price - intval($plan->price), 2)*100)}}</span>
                                @endif
                            </div>
                            @if($hasDiscount)
                                <div class="pricing-plan-name"><del>{{$plan->price}}</del></div>
                            @endif
                            <div class="pricing-plan-period">monthly</div>
                            <div class="pricing-plan-period"><br/>
                                @unless($plan->id == 10)
                                    {{$charge->trial_days}} days free trial
                                @endunless
                            </div>
                            @unless($plan->id == 10)
                                <form role="form" action="{{ route('confirm_discount', [$couponCode]) }}" method="post">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-info">Activate</button>
                                </form>
                            @endunless
                        </div>
                    </th>
                </tr></thead>
                <tbody>
                @foreach($features as $feature=>$value)
                    <tr>
                        <td>{{$feature}}</td>
                        <td>
                            {{$value or ''}}
                        </td>
                    </tr>
                @endforeach
                @if($plan->has_discount and $coupon)
                    <tr>
                        <td></td>
                        <td>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Confirm</button>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@push('style')
    <style>
        .membership-pricing-table table .icon-no,.membership-pricing-table table .icon-yes {
            font-size: 22px;
        }

        .membership-pricing-table table .icon-no {
            color: #a93717;
        }

        .membership-pricing-table table .icon-yes {
            color: #209e61;
        }

        .membership-pricing-table .plan-header {
            text-align: center;
            font-size: 48px;
            border: 1px solid #e2e2e2;
            padding: 25px 0;
        }

        .membership-pricing-table .plan-header-free {
            background-color: #eee;
            color: #555;
        }

        .membership-pricing-table .plan-header-blue {
            color: #fff;
            background-color: #3989c6;
            border-color: #eee;
        }

        .membership-pricing-table .plan-header-standard {
            color: #fff;
            background-color: #f8ac59;
            border-color: #eee;
        }

        .membership-pricing-table table td {
            text-align: center;
            padding: 7px 10px;
            background-color: #fafafa;
            font-size: 14px;
            -webkit-box-shadow: 0 1px 0 #fff inset;
            box-shadow: 0 1px 0 #fff inset;
        }

        .membership-pricing-table table,.membership-pricing-table table td {
            border: 1px solid #ebebeb;
        }

        .membership-pricing-table table tr td:first-child {
            background-color: transparent;
            text-align: right;
        }

        .membership-pricing-table table tr td:nth-child(5) {
            background-color: #FFF;
        }

        .membership-pricing-table table tr:first-child td,.membership-pricing-table table tr:nth-child(2) td {
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        .membership-pricing-table table tr:first-child th:first-child {
            border-top-color: transparent;
            border-left-color: transparent;
            border-right-color: #e2e2e2;
        }

        .membership-pricing-table .plan-header-standard .pricing-plan-name {
            font-size: 22px;
            height: 40px;
        }

        .membership-pricing-table .plan-header-blue .pricing-plan-name {
            font-size: 18px;
            height: 60px;
        }

        .membership-pricing-table .plan-header-standard .pricing-plan-price {
            line-height: 35px;
        }

        .membership-pricing-table .plan-header-blue .pricing-plan-price {
            line-height: 31px;
        }

        .membership-pricing-table .plan-header .pricing-plan-price>sup {
            font-size: 45%;
        }

        .membership-pricing-table .plan-header .pricing-plan-price>span {
            font-size: 30%;
        }

        .membership-pricing-table .plan-header .pricing-plan-period {
            margin-top: -7px;
            font-size: 25%;
        }

        .membership-pricing-table .header-plan-inner {
            position: relative;
        }

        .membership-pricing-table .recommended-plan-ribbon {
            box-sizing: content-box;
            background-color: #ed5565;
            color: #FFF;
            position: absolute;
            padding: 3px 6px;
            font-size: 11px!important;
            font-weight: 500;
            left: -6px;
            top: -22px;
            z-index: 99;
            width: 100%;
            -webkit-box-shadow: 0 -1px #c2284c inset;
            box-shadow: 0 -1px #c2284c inset;
            text-shadow: 0 -1px #c2284c
        }

        .membership-pricing-table .recommended-plan-ribbon:before {
            border: solid;
            border-color: #c2284c transparent;
            border-width: 6px 0 0 6px;
            bottom: -5px;
            content: "";
            left: 0;
            position: absolute;
            z-index: 90
        }

        .membership-pricing-table .recommended-plan-ribbon:after {
            border: solid;
            border-color: #c2284c transparent;
            border-width: 6px 6px 0 0;
            bottom: -5px;
            content: "";
            right: 0;
            position: absolute;
            z-index: 90
        }

        .membership-pricing-table .plan-header {
            box-sizing: content-box;
            border-bottom: none
        }
    </style>
@endpush