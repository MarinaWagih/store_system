@extends('app')
@section('title')
    @lang('variables.add') @lang('variables.employee')
@stop
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('/jquery-ui/jquery-ui.min.css')}}" >
@stop
@section('content')

<div class="col-lg-2"></div>
<div class="col-lg-8">
    <h1>@lang('variables.add') @lang('variables.employee')</h1>
    <hr>
    {!! Form::open(['url'=>'employee'])!!}
        @include('employee._form',[
                                 'submitText'=> Lang::get('variables.add'),
                                 'write'  =>Lang::get('variables.write'),
                                 'name'   =>Lang::get('variables.name'),
                                 'phone'  =>Lang::get('variables.phone'),
                           ])
    {!! Form::close()!!}
</div>
@stop
