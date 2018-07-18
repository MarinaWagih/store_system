@extends('app')
@section('title')
    @lang('variables.new') @lang('variables.modelType')
@stop
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/select2-bootstrap.css')}}">
@stop
@section('content')

<div class="col-lg-2"></div>
<div class="col-lg-8">
    <h1>@lang('variables.add') @lang('variables.item')</h1>
    <hr>
    {!! Form::open(['url'=>'model-type','files'=>true])!!}
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