@extends('app')
@section('title')
    New item
@stop
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/select2-bootstrap.css')}}">
@stop
@section('content')

<div class="col-lg-2"></div>
<div class="col-lg-8">
    <h1>@lang('variables.edit') @lang('variables.info') {{$modelType->name}}</h1>
    <hr>
    {!! Form::model($modelType,['url'=>'model-type/'.$modelType->id,'method'=>'PUT','files'=>true])!!}
        @include('modelType._form')
    {!! Form::close()!!}
</div>
@stop
@section('js')
    <script src="{{URL::asset('/js/select2.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $("#sizes").select2({
                dir: "rtl",
                tags:true
            });

        });
    </script>
@endsection