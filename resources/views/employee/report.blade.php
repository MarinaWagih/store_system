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
            <form method="post" action="{{URL::action('EmployeeController@getReport')}}">
                <input id="_token" type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="col-sm-3">
                    <button id="submit" type="submit" class="btn color">@lang('variables.search')</button>

                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input id="end_date" name="end_date" type="text"
                               class="form-control"
                               value="{{isset($result)&&isset(
                               $result['end_date'])?$result['end_date']:''}}"
                               placeholder="@lang('variables.end_date')">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input id="start_date" name="start_date" type="text"
                               class="form-control"
                               value="{{isset($result)&&
                               isset($result['start_date'])?
                               $result['start_date']:''}}"
                               placeholder="@lang('variables.start_date')">
                    </div>
                </div>
                <div class="col-sm-3">
                    {!! Form::select('employee_id',$employees,null,['class'=>"form-control"]) !!}
                </div>

            </form>

        </div>
        <div class="col-sm-2"></div>
    </div>
    @if(isset($result))
        <div class="row">
            @if(Auth::user()->type=='admin')
            <div class="col-sm-12">
                <div class="col-sm-6">{{number_format($result['total_price'],1)}}</div>
                <div class="col-sm-6 h4">أجمالي البيع </div>
            </div>
            @endif
            @if(Auth::user()->type=='admin')
            <div class="col-sm-12" style="background-color: #eee">
                <div class="col-sm-6">{{number_format($result['total_employee_percentage'],1)}}</div>
                <div class="col-sm-6 h4">ألمكسب</div>
            </div>
            @endif
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
