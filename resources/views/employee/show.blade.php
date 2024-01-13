@extends('app')
@section('title')
    {{$employee->name}}
@stop
@section('content')
    <div class="row">
        <div class="col-lg-2">
            <a href="{{ URL::action('EmployeeController@index')}}/{{$employee->id}}/edit">
                <h2 class="link">
                    @lang('variables.edit')
                    <span class="glyphicon glyphicon-edit"></span>

                </h2>
            </a>
            @if(Auth::user()->type=='admin')
                <a href="{{ URL::action('EmployeeController@index')}}/{{$employee->id}}/delete">
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

                    <a href="{{ URL::action('EmployeeController@index')}}/{{$employee->id}}">
                        {{$employee->name}}
                    </a>
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>

                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6 "></div>
                        <div class="col-lg-6 ">
                            <span class="color_pink pull-right"> @lang('variables.phone')</span>
                            <span class=" pull-right">&nbsp;:&nbsp;</span>
                            <span class=" pull-right">{{$employee->phone}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>
@stop