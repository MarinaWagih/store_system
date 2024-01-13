@extends('app')
@section('title')
    @lang('variables.emplyees')
@stop
@section('content')
    <div class="row masafa">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <input id="_token" type="hidden" name="_token" value="{{ csrf_token() }}">
            <input id="search_link" type="hidden" name="search_link" value="{{ URL::action('EmployeeController@search') }}">

            <div class="col-lg-2">
                <button id="submit" type="submit" class="btn color">@lang('variables.search')</button>

            </div>
            <div class="col-lg-10">
                <div class="form-group">
                    <input id="query" name="query" type="text" class="form-control"
                           placeholder="@lang('variables.search')">
                </div>
            </div>
            {{--</form>--}}

        </div>

        <div class="col-lg-2"></div>
    </div>
    <div class="row">

            <div class="center">
                <table class="table table-hover">
                    <caption class="color_pink title3">@lang('variables.employees')</caption>
                    <thead>
                    <tr>
                        <th>@lang('variables.operations')</th>
                        <th>@lang('variables.phone')</th>
                        <th>@lang('variables.name')</th>
                        <th></th>

                    </tr>
                    </thead>
                    <tbody id="result">
                    @if(isset($employees))
                        @foreach($employees as $employee)
                            <tr>
                                <td>
                                    <a href='{{ URL::action('EmployeeController@index') }}/{{$employee->id}}'>
                                        @lang('variables.show')
                                    </a>
                                    <a href="{{ URL::action('EmployeeController@index')}}/{{$employee->id}}/edit">
                                        @lang('variables.edit')</a>
                                    @if(Auth::user()->type=='admin')
                                        <a href="{{ URL::action('EmployeeController@destroy',['id'=>$employee->id])}}">@lang('variables.delete')</a>
                                    @endif
                                </td>
                                <td>{{$employee->phone}}</td>
                                <td>{{$employee->name}}</td>
                                <th scope="row">{{$employee->id}}</th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="center" id="render">

                    {!! $employees->render()!!}

                </div>
            <input id="U_type" type="hidden" value="{{Auth::user()->type}}">
                @endif
            </div>
        </div>
@stop