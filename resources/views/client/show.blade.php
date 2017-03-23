@extends('app')
@section('title')
    {{$client->name}}
@stop
@section('content')
    <div class="row">
        <div class="col-lg-2">
            <a href="{{ URL::action('ClientsController@index')}}/{{$client->id}}/edit">
                <h2 class="link">
                    @lang('variables.edit')
                    <span class="glyphicon glyphicon-edit"></span>

                </h2>
            </a>
            @if(Auth::user()->type=='admin')
                <a href="{{ URL::action('ClientsController@index')}}/{{$client->id}}/delete">
                    <h2 class="link">
                        @lang('variables.delete')
                        <span class="glyphicon glyphicon-remove"></span>

                    </h2>
                </a>
            @endif
        </div>
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="color title2 panel_title">

                    <a href="{{ URL::action('ClientsController@index')}}/{{$client->id}}">
                        {{$client->name}}
                    </a>
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>

                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <span class="color_pink pull-right">   @lang('variables.address') </span>
                            <span class=" pull-right">&nbsp;:&nbsp;</span>
                            <span class=" pull-right">{{$client->address}}</span>
                        </div>
                        <div class="col-lg-6 ">
                            <span class="color_pink pull-right"> @lang('variables.phone')</span>
                            <span class=" pull-right">&nbsp;:&nbsp;</span>
                            <span class=" pull-right">{{$client->phone}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 ">
                            <span class="color_pink  pull-right">   @lang('variables.trading_address')</span>
                            <span class=" pull-right">&nbsp;:&nbsp;</span>
                            <span class=" pull-right">{{$client->trading_address}}</span>
                        </div>
                        <div class="col-lg-6">
                            <span class="color_pink  pull-right">   @lang('variables.trading_name')</span>
                            <span class=" pull-right">&nbsp;:&nbsp;</span>
                            <span class=" pull-right">{{$client->trading_name}}</span>
                        </div>

                    </div>
                    <div class="row">

                        <div class=" col-lg-offset-6 col-lg-6 ">
                            <span class="color_pink pull-right">   @lang('variables.date')</span>
                            <span class=" pull-right">&nbsp;:&nbsp;</span>
                            <span class=" pull-right">{{$client->created_at->format('d-m-Y')}}</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>
@stop