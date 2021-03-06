@extends('app')
@section('title')
    {{$item->name}}
@stop
@section('content')
    <div class="row ">
        <div class="col-lg-4 masafa  h1">
        </div>
        <div class="col-lg-8">
            <h1 class="dir-rtl">
                <kbd>{{$item->code}}</kbd> {{$item->name}}
            </h1>
            <hr>
            <h1 class="dir-rtl">
              @lang('variables.full_code')  <kbd>{{$item->full_code}}</kbd>
            </h1>
            <hr>
            <div class="center">
                <table class="table table-hover right">
                    <caption class="color_pink title3">@lang('variables.prices')</caption>
                    <thead>
                    <tr>
                        <th class="right">@lang('variables.price')</th>
                        <th class="right">@lang('variables.type')</th>

                    </tr>
                    </thead>
                    <tbody>

                    @if(Auth::user()->type=='admin')
                        <tr>
                            <td> {{ $item->price}} </td>
                            <td>@lang('variables.price')</td>
                            {{--<td><span class="glyphicon glyphicon-tag"></span></td>--}}
                        </tr>
                    @endif
                        <tr>
                            <td> {{ $item->client_price}} </td>
                            <td> @lang('variables.client_price')</td>
                            {{--<td><span class="glyphicon glyphicon-tag"></span></td>--}}
                        </tr>
                         @if(Auth::user()->type=='admin')
                        <tr>
                            <td> {{ $item->count}} {{$item->unit}}</td>
                            <td> @lang('variables.count')</td>
                            {{--<td><span class="glyphicon glyphicon-tag"></span></td>--}}
                        </tr>
                        
                        <tr>
                            <td> {{$item->sold['all']}}</td>
                            <td> @lang('variables.sold')</td>
                        </tr>
                         @endif
                    </tbody>
                </table>


            </div>
            @if($item->sizes)
            <div class="center">
                <span class="color_pink title3">
                    @lang('variables.theSizes')
                </span>
                    <div class="row dir-rtl masafa margin-check">
                        <b class="col-xs-3 pull-right">
                            @lang('variables.theSize')
                        </b>
                        <b class="col-xs-3 pull-right">
                            @lang('variables.count')
                        </b>
                        @if(Auth::user()->type=='admin')
                        <b class="col-xs-3 pull-right">
                            @lang('variables.sold')
                        </b>
                        <b class="col-xs-3 pull-right">
                            @lang('variables.remains')
                        </b>
                        @endif
                    </div>

                    @foreach($item->sizes as $size=>$val)
                        <div class="row dir-rtl masafa margin-check">
                            <div class="col-xs-3 pull-right">
                                {{$size}}
                            </div>
                            <div class="col-xs-3 pull-right">
                                {{$val}}
                            </div>
                            @if(Auth::user()->type=='admin')
                            <div class="col-xs-3 pull-right">
                                {{$item->sold[strtolower($size)] or 0}}
                            </div>
                            <div class="col-xs-3 pull-right">
                                {{intval($val)-intval(isset($item->sold[strtolower($size)])?$item->sold[strtolower($size)]:0)}}
                            </div>
                            @endif
                        </div>
                        <hr>
                    @endforeach

            </div>
            @else
                <h2 class="center">@lang('variables.no_sizes_found')</h2>
            @endif
        </div>
    </div>
@stop