@extends('app')
@section('title')
    @lang('variables.invoice')  @lang('variables.number1')  {{$invoice->id}}
@stop
@section('content')
    <button class="btn btn-warning masafa" id="print">@lang('variables.print')</button>
    <div class="wrapper"></div>
    <div class="masafa bg-logo" id="content">

        {{--===================id&& 2images=========================--}}
        {{--========================================================--}}
        <div class="row">
            <div class="left first">
                <div class="title4 col-md-12">
                    {{$invoice->id}} : @lang('variables.number')
                    <hr>
                </div>
                <div class="title4  col-md-6">
                    {{$invoice->employee?$invoice->employee->name:"-"}} : @lang('variables.the_employee')
                    <hr>
                </div>
                <div class="title4 col-md-6">
                    {{$invoice->date}} : @lang('variables.date')
                    <hr>
                </div>

                <div class="title4 col-md-6">
                    {{$invoice->client_phone?:"-"}} : @lang('variables.client_phone')
                    <hr>
                </div>
                <div class="title4 col-md-6">
                    {{$invoice->client_name?:"-"}} : @lang('variables.client_name')
                    <hr>
                </div>
                <div class="title4 col-md-6"></div>
                <div class="title4 col-md-6">
                    @if(!$invoice->client_way_of_payment)
                     - :@lang('variables.client_way_of_payment')
                    @else
                        @lang('variables.client_way_of_payment') : {{trans('variables.'.$invoice->client_way_of_payment)}}
                    @endif
                    <hr>
                </div>

            </div>
       </div>
        {{--========================================================--}}
        {{--========================================================--}}
        {{--=====================Items==============================--}}
        {{--========================================================--}}
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>@lang('variables.the_total') @lang('variables.after') @lang('variables.discount')</th>
                            <th>@lang('variables.price') @lang('variables.after') @lang('variables.discount')</th>
                            <th>@lang('variables.percentage')  @lang('variables.discount')</th>
                            <th>@lang('variables.price') @lang('variables.before') @lang('variables.discount')</th>
                            <th>@lang('variables.quantity')</th>
                            <th>@lang('variables.theSize')</th>
                            <th>@lang('variables.name')</th>
                            <th>@lang('variables.number')</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @if(isset($invoice))
                            @foreach($invoice->items as $item)
                                <tr id="{{$item->id}}" class="items_row">
                                   <td>
                                        {{($item->pivot->price-($item->pivot->price *$item->pivot->discount_percent)/100)*$item->pivot->quantity }}
                                    </td>
                                    <td>
                                        {{$item->pivot->price-($item->pivot->price *$item->pivot->discount_percent)/100  }}
                                    </td>
                                    <td>
                                        {{$item->pivot->discount_percent}}
                                    </td>
                                    <td>
                                        {{ $item->pivot->price  }}
                                    </td>
                                    <td>
                                        {{ $item->pivot->quantity  }}
                                    </td>
                                    <td>
                                        {{ $item->pivot->size  }}
                                    </td>
                                    <td>
                                        {{ $item->name  }}
                                    </td>
                                    <td>
                                        {{ $item->id }}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

            </div>
            <div class="col-lg-2"></div>
        </div>
        {{--========================================================--}}
        {{--========================================================--}}
        <br>
        {{--===================calculations=========================--}}
        {{--========================================================--}}
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-9">
            <div class="row final_calc">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <div class="checkbox">
                    <label for="taxes" style="margin-right:20px;"> Taxes</label>
                    @if($invoice->total_after_sales_tax !=0)
                        <span class="glyphicon glyphicon-check"></span>
                    @else
                        <span class="glyphicon glyphicon-unchecked"></span>
                    @endif

                </div>
                <span id="Total_after_taxes">{{$invoice->total_after_sales_tax}}</span>
            </div>
            {{--========================================================--}}
            {{--========================================================--}}
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                        <span id="additional_discount_value">
                            {{$invoice-> additional_discount_percentage}}%
                        </span>

                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                        <span class="color_dark title5">
                            @lang('variables.percentage')  @lang('variables.discount') @lang('variables.additional')
                        </span>
                    </div>

                </div>
                <div class="row">

                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                        <span id="additional_discount_value">
                          {{$invoice->totalAfterDiscount()*($invoice-> additional_discount_percentage/100)}}
                        </span>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                        <span class="color_dark title5">
                            @lang('variables.value')  @lang('variables.discount') @lang('variables.additional')
                         </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                        <span id="Total_additional_discount">
                            {{$invoice->totalAfterDiscount()-($invoice->totalAfterDiscount()*($invoice-> additional_discount_percentage/100))}}
                        </span>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                <span class="color_dark title5">
                    @lang('variables.total') @lang('variables.price')
                    @lang('variables.after')  @lang('variables.discount')
                    @lang('variables.additional')
                </span>
                    </div>
                </div>
            </div>
            {{--========================================================--}}
            {{--========================================================--}}
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                        <span id="Total_invoice_before_discount">{{$invoice->totalBeforeDiscount()}}</span>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                        <span class="color_dark title5">
                            @lang('variables.total') @lang('variables.price') @lang('variables.before') @lang('variables.discount')
                        </span>
                    </div>

                </div>
                <div class="row">

                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                        <span id="Total_invoice_discount">
                           {{$invoice->totalDiscount()}}
                        </span>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                        <span class="color_dark title5">
                            @lang('variables.total') @lang('variables.discount')
                        </span>
                    </div>
                </div>
                <div class="row">

                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                        <span id="Total_invoice_after_discount">
                            {{$invoice->totalAfterDiscount()}}
                        </span>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                <span class="color_dark title5">
                    @lang('variables.total') @lang('variables.price') @lang('variables.after') @lang('variables.discount')
                </span>
                    </div>
                </div>
            </div>
            </div>
        </div>
            <div class="col-lg-1"></div>
        </div>
        {{--========================================================--}}
        {{--========================================================--}}
    </div>
    <div id="printableArea" class="hidden">
        <div id="printableContent" class="dir-ltr">
            <h1 class="brandName">@lang("variables.brand")</h1>
            <p class="title-print">
               Number: {{$invoice->id}}
            </p>
            <hr>
            <p class="title-print">
               Date: {{$invoice->date}}
            </p>
            <table width="100%" class="title-print">
                <thead>
                     <tr>
                         <td width="40%">item </td>
                         <td width="20%">quantity</td>
                         <td width="20%">size</td>
                         <td width="20%">price</td>
                     </tr>
                </thead>
                    <tbody>
                    @foreach($invoice->items as $item)
                        <tr>
                            <td > {{ $item->name  }} </td>
                            <td > {{ $item->pivot->quantity  }}</td>
                            <td > {{ $item->pivot->size  }}</td>
                            <td > {{ $item->pivot->price  }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="2"> total: </td>
                        <td colspan="2"> {{$invoice->totalAfterDiscount()}}</td>
                    </tr>
                    </tbody>
            </table>
            <p style="font-size: xx-small;"> @lang('variables.printing_txt') </p>
        </div>
    </div>
@stop
@section('js')
    <script >
        var autoPrint="{{isset($autoPrint)?$autoPrint:false}}";
    </script>
    <script src="{{URL::asset('js/printThis.js')}}"></script>

    <script src="{{URL::asset('js/core.js')}}"></script>
@stop