@extends('app')
@section('title')
    {{$modelType->name}}
@stop
@section('content')
    <div class="row  masafa">
        <div class="col-md-8 col-md-offset-4">
            <h3 style="direction: rtl">
                <i class="glyphicon glyphicon-tag"></i>
                {{$modelType->name}}
            </h3>
            <hr>
            <h4>{{ $modelType->code}} : @lang('variables.code')</h4>
            <hr>
            <h4>@lang('variables.theSizes')</h4>
            <ul style="direction: rtl">
            @foreach($modelType->sizes as $size)
                <li>{{$size}}</li>
            @endforeach
            </ul>
        </div>
    </div>
@stop