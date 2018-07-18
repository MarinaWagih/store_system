@extends('app')
@section('title')
    @lang('variables.new') @lang('variables.item')
@stop
@section('content')

<div class="col-lg-2"></div>
<div class="col-lg-8">
    <h1>@lang('variables.add') @lang('variables.item')</h1>
    <hr>
    {!! Form::open(['url'=>'item','files'=>true])!!}
        @include('item._form')
    {!! Form::close()!!}
</div>
@stop
@section('js')
    <script>
        $(document).ready(function(){
            var changeSizeCount=function(){
                $("#sizes_count_container").html($(this).children(":selected").data("sizes"));
            };
            $('[name="model_type_id"]').change(changeSizeCount);
        });
    </script>
@stop