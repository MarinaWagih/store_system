@extends('app')
@section('title')
    @lang('variables.edit') @lang('variables.info')
@stop
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('/jquery-ui/jquery-ui.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/select2-bootstrap.css')}}">

@stop
@section('content')
<div class="col-lg-12">
    <h1>@lang('variables.edit') @lang('variables.info') </h1>
    <hr>
    {!! Form::model($invoice,['url'=>'invoice/'.$invoice->id,'method'=>'PUT'])!!}
        @include('invoice._form',['submitText'=> Lang::get('variables.edit'),
                                 'write'  =>Lang::get('variables.write'),
                                 'date'   =>Lang::get('variables.date'),
                                 'with_installation'=>Lang::get('variables.with_installation'),
                                 'without_installation'=>Lang::get('variables.without_installation'),
                                 'client'=>Lang::get('variables.client'),
                                 'item'=>Lang::get('variables.item'),
                                 'price'=>Lang::get('variables.price'),
                                 'quantity'=>Lang::get('variables.quantity'),
                                 'sell'=>Lang::get('variables.sell'),
                                 'buy'=>Lang::get('variables.buy'),
                                 ])
    {{--{{$invoice->date->format('d-M-Y')}}--}}
    {!! Form::close()!!}
</div>
@stop
@section('js')

    <script src="{{URL::asset('/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{URL::asset('/js/select2.min.js')}}"></script>
    <script src="{{URL::asset('/js/JSON-js/json2.js')}}"></script>
    <script src="{{URL::asset('/js/jquery.repeater.min.js')}}"></script>
    <script>
        var  search_by_id='{{ URL::action('ItemController@search_by_id')}}';
        var  client_ajax_search="{{ URL::action('ClientsController@ajaxSearch')}}";
        var  item_search="{{ URL::action('ItemController@ajaxSearch')}}";

    </script>
    <script src="{{URL::asset('/js/invoicePreparation.js')}}"></script>

@stop
