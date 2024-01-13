@extends('app')
@section('title')
    @lang('variables.edit') @lang('variables.info')  {{$employee->name}}
@stop
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('/jquery-ui/jquery-ui.min.css')}}">
@stop
@section('content')

<div class="col-lg-2"></div>
<div class="col-lg-8">
    <h1>@lang('variables.edit') @lang('variables.info')  {{$employee->name}} </h1>
    <hr>
    {!! Form::model($employee,['url'=>'employee/'.$employee->id,'method'=>'PUT'])!!}
        @include('employee._form',[
                                 'submitText'=> Lang::get('variables.edit'),
                                 'name'   =>Lang::get('variables.name'),
                                 'write'  =>Lang::get('variables.write'),
                                 'phone'  =>Lang::get('variables.phone'),
                                 ])
    {!! Form::close()!!}
</div>
@stop