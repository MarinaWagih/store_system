@extends('app')
@section('title')
    {{$item->name}}
@stop
@section('content')
    <div class="row ">
        <div class="col-lg-4 masafa  h1">
            @if($item->picture!="")
            <img src="{{URL::asset('images/'.$item->picture)}}" class="item_image"/>
            @else
                <i class="glyphicon glyphicon-picture"></i>
            @endif
        </div>
        <div class="col-lg-8">
            <h1>
                <kbd>{{$item->name}}</kbd>
            </h1>
            <hr>
            <h3>
                {{ $item->code}} :  @lang('variables.code')
            </h3>

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
                        <tr>
                            <td> {{ $item->client_price}} </td>
                            <td> @lang('variables.client_price')</td>
                            {{--<td><span class="glyphicon glyphicon-tag"></span></td>--}}
                        </tr>
                        <tr>
                            <td> {{ $item->count}} {{$item->unit}}</td>
                            <td> @lang('variables.count')</td>
                            {{--<td><span class="glyphicon glyphicon-tag"></span></td>--}}
                        </tr>

                    @endif
                    </tbody>
                </table>


            </div>
        </div>
    </div>
@stop