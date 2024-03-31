@extends('app')
@section('title')
    @lang('variables.invoices')
@stop
@section('content')
    <div class="row masafa">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
          <input id="_token" type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="col-lg-2">
                <button id="submit" type="submit" class="btn color">@lang('variables.search')</button>

            </div>
            <div class="col-lg-10">
                <div class="form-group">
                    <input id="query" name="query" type="text" class="form-control"
                           placeholder="@lang('variables.search')">
                </div>
            </div>

        </div>
        <div class="col-lg-2"></div>
    </div>
    <div class="row">

            <div class="center">
                <table class="table table-hover">
                    <caption class="color_pink title3">@lang('variables.invoices')</caption>
                    <thead>
                    <tr class="dir-rtl">
                        <th class="dir-rtl">@lang('variables.operations')</th>
                        <th class="dir-rtl">@lang('variables.date')</th>
                        <th>@lang('variables.client_phone')</th>
                        <th>@lang('variables.client_name')</th>
                        <th class="dir-rtl">@lang('variables.invoice')</th>
                        {{--<th>@lang('variables.number')</th>--}}

                    </tr>
                    </thead>
                    <tbody id="result">
                    @if(isset($invoices))
                        @foreach($invoices as $invoice)
                            <tr>
                                <td class="dir-rtl">
                                    <a href="{{ URL::action('InvoiceController@index')}}/{{$invoice->id}}"> @lang('variables.show')</a>
                                    <a href="{{ URL::action('InvoiceController@index')}}/{{$invoice->id}}/edit">@lang('variables.edit')</a>
                                    @if(Auth::user()->type=='admin')
                                        <a href="{{ URL::action('InvoiceController@index')}}/{{$invoice->id}}/delete">@lang('variables.delete')</a>
                                    @endif
                                </td>
                                <td class="dir-rtl">{{$invoice->date}}</td>
                                <td>{{$invoice->client_phone}}</td>
                                <td>{{$invoice->client_name}}</td>

                                <th scope="row" class="dir-rtl">{{$invoice->id}}</th>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                @if(isset($invoices))
                <div class="center" id="render">
                    {!!$invoices->render()!!}

                </div>
                @endif
            <input id="U_type" type="hidden" value="{{Auth::user()->type}}">

            </div>
        </div>

@stop
@section('js')
    {{--<script src="{{ URL::asset('/js/searchInvoice.js')}}"></script>--}}
    <script>
        $(document).ready(function () {


            function sendData()
            {
                $.post('{{ URL::action('InvoiceController@search')}}',
                        {
                            'query':$('#query').val(),
                            '_token':$('#_token').val(),
                            'type':'json'
                        },
                        function(result){
                            var count=result.data.length;
                            var toShow="";
                            for(var i=0;i<count;i++)
                            {
                                toShow+='<tr>' ;
                                toShow+='<td>';
                                toShow+='<a href="{{ URL::action('InvoiceController@index')}}'+result.data[i].id+'">'+'@lang('variables.show')'+'</a>';
                                toShow+=' <a href="{{ URL::action('InvoiceController@index')}}'+result.data[i].id+'/edit">'+'@lang('variables.edit')'+'</a>';
                                if($('#U_type').val()=='admin')
                                {
                                    toShow+=' <a href="{{ URL::action('InvoiceController@index')}}'+result.data[i].id+'/delete">'+'@lang('variables.delete')'+'</a>';
                                }
                                //console.log(result.data[i]);
                                toShow+='</td>';
                                toShow+='<td>'+result.data[i].date+'</td>';
                                toShow+='<td>'+(result.data[i].client_phone?result.data[i].client_phone:"-")+'</td>';
                                toShow+='<td>'+(result.data[i].client_name?result.data[i].client_name:"-")+'</td>';
                                toShow+='<td>'+result.data[i].id+'</td>';
                                toShow+='</tr>';
                            }
                            $('#result').html(toShow);
                            $('#render').html(result.render);
                            //console.log();

                        });
            }
            $('#submit').click(function () {
                sendData()
            });
            $('#query').keyup(function () {
                sendData()
            });
        });
    </script>
@stop