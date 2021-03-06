@extends('app')
@section('title')
    @lang('variables.add') @lang('variables.invoice')
@stop
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/jquery-ui/jquery-ui.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/select2-bootstrap.css')}}">
@stop
@section('content')
    <div class="col-lg-12">
    <h1>@lang('variables.add') @lang('variables.invoice')</h1>
    <hr>
    {!! Form::open(['url'=>'invoice' ,'id'=>'add_form'])!!}
        @include('invoice._form',['submitText'=> Lang::get('variables.add'),
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