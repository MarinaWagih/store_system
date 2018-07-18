@extends('app')
@section('title')
    {{$modelType->name}}
@stop
@section('content')
    <div class="row  masafa">
        <div class="col-md-8 col-md-offset-4">
            <h3 class="dir-rtl">
                <i class="glyphicon glyphicon-tag"></i>
                {{$modelType->name}}
                <kbd>{{$modelType->code}}</kbd>
            </h3>
            <hr>
            {{--<h4>{{ $modelType->code}} : @lang('variables.code')</h4>--}}
            {{--<hr>--}}
            <h4>@lang('variables.theSizes')</h4>
            <ul  class="dir-rtl">
            @foreach($modelType->sizes as $size)
                <li class="h4">{{$size}}</li>
            @endforeach
            </ul>
        </div>
    </div>
@stop