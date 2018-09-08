@extends('app')
@section('title')
    @lang('variables.invoices')
@stop
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/jquery-ui/jquery-ui.min.css')}}">
@stop
@section('content')
    <div class="row masafa">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <form method="post" action="{{URL::action('InvoiceController@getTotalFromDateToDate')}}">
                <input id="_token" type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="col-sm-2">
                    <button id="submit" type="submit" class="btn color">@lang('variables.search')</button>

                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <input id="end_date" name="end_date" type="text"
                               class="form-control"
                               value="{{isset($result)&&isset(
                               $result['end_date'])?$result['end_date']:''}}"
                               placeholder="@lang('variables.end_date')">
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <input id="start_date" name="start_date" type="text"
                               class="form-control"
                               value="{{isset($result)&&
                               isset($result['start_date'])?
                               $result['start_date']:''}}"
                               placeholder="@lang('variables.start_date')">
                    </div>
                </div>

            </form>

        </div>
        <div class="col-sm-2"></div>
    </div>
    @if(isset($result))
        <div class="row">
            <div class="col-sm-6">
                <div class="col-sm-6">{{number_format($result['total_price'],1)}}</div>
                <div class="col-sm-6">أجمالي البيع بسعر ألجملة</div>
            </div>
            <div class="col-sm-6">
                <div class="col-sm-6">{{number_format($result['total_client_price'],1)}}</div>
                <div class="col-sm-6">أجمالي البيع بسعر البيع</div>
            </div>
            <div class="col-sm-12" style="background-color: #eee">
                <div class="col-sm-6">{{number_format($result['total_client_price']-$result['total_price'],1)}}</div>
                <div class="col-sm-6">ألمكسب</div>
            </div>
        </div>
        <div class="row masafa">
            <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                ألتفاصيل
            </a>
            <div class="collapse" id="collapseExample">
                <div class="well center">
                    <table class="table table-hover">
                        <caption class="color_pink title3">@lang('variables.invoices')</caption>
                        <thead>
                        <tr>
                            <th style="    text-align: center;">@lang('variables.profits')</th>
                            <th style="    text-align: center;">@lang('variables.client_price')</th>
                            <th style="    text-align: center;">@lang('variables.total')</th>
                            <th style="    text-align: center;">@lang('variables.quantity')</th>
                            <th style="    text-align: center;">@lang('variables.name')</th>

                        </tr>
                        </thead>
                        <tbody id="result">
                            @foreach($result['items'] as $item)
                                <tr>
                                    <td>{{number_format($item['selling_price']-$item['buying_price'],1)}}</td>
                                    <td>{{number_format($item['selling_price'],1)}}</td>
                                    <td>{{number_format($item['buying_price'],1)}}</td>
                                    <td>{{number_format($item['count'],1)}}</td>
                                    <td>{{$item['name']}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    @endif
@stop
@section('js')
    <script src="{{URL::asset('/jquery-ui/jquery-ui.min.js')}}"></script>
    <script>
        //date picker
        $(function () {
            $("#start_date").datepicker({
                dateFormat: 'yy-mm-dd'
            })
                    .datepicker('setDate', new Date($("#start_date").val()));
        });
        //date picker
        $(function () {
            $("#end_date").datepicker({
                dateFormat: 'yy-mm-dd'
            })
                    .datepicker('setDate', new Date($("#end_date").val()));
        });
    </script>
@endsection
