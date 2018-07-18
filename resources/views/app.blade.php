<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="{{ URL::asset('/fav.png')}}">

    <title>
        @yield('title')
    </title>
    <link rel="stylesheet" media="all" type="text/css" href="{{ URL::asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" media="all" type="text/css" href="{{ URL::asset('css/bootstrap-theme.min.css')}}">
    <link rel="stylesheet" media="all" type="text/css" href="{{ URL::asset('css/ar.css')}}">

    @yield('css')
</head>
<body>
<nav class="nav-color">
    <div class="container-fluid title3">
        <div class="navbar-header navbar-right">
            <a class="navbar-brand  dash_link" href="{{ URL::action('HomeController@index') }}">
                @lang("variables.brand")
            </a>

        </div>

        <div class="navbar-header navbar-nav">

            <a href="{{ URL::action('Auth\AuthController@getLogout') }}" class="navbar-brand dash_link">
                @lang('variables.logout')
            </a>

        </div>

    </div>
</nav>

<div id="body">
<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 left-side">
    <div class='container-fluid'>
        @yield('content')
    </div>
</div>
<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 Dashboard right-side">
    {{--******************Client Element**************--}}
    <div class="panel-default">
        <a class="collapsed" role="button"
           data-toggle="collapse" data-parent="#accordion"
           href="#collapseClient" aria-expanded="false"
           aria-controls="collapseClient">
            <div class="color title3 panel_title" role="tab" id="headingClient">
                @lang('variables.clients')
            </div>
        </a>

        <div id="collapseClient" class="panel-collapse collapse color"
             role="tabpanel" aria-labelledby="headingClient">
            <div class="panel-body title4">
                <a role="button" href="{{ URL::action('ClientsController@index') }}" class="dash_link">
                    @lang('variables.search')
                    <span class="glyphicon glyphicon-search"></span>
                </a>
                <br>
                <a role="button"  href="{{ URL::action('ClientsController@create') }}" class="dash_link">

                    @lang('variables.add') @lang('variables.client')
                    <span class="glyphicon glyphicon-plus"></span>
                </a>
            </div>
            </div>
        </div>

    {{--**********************************************--}}
    <hr>
    {{--******************item Element**************--}}
    @if(Auth::user()->type!='user')
    <div class="panel-default">
        <a class="collapsed" role="button"
           data-toggle="collapse" data-parent="#accordion"
           href="#collapseitem" aria-expanded="false"
           aria-controls="collapseitem">
            <div class="color title3 panel_title" role="tab" id="headingitem">
                @lang('variables.items')
            </div>
        </a>

        <div id="collapseitem" class="panel-collapse collapse color" role="tabpanel" aria-labelledby="headingitem">
            <div class="panel-body title4">
                <a role="button" href="{{ URL::action('ItemController@index') }}" class="dash_link">
                    @lang('variables.search')
                    <span class="glyphicon glyphicon-search"></span>
                </a>
                <br>
                @if(Auth::user()->type=='admin')
                    <a role="button"  href="{{ URL::action('ItemController@create') }}" class="dash_link">
                        @lang('variables.add') @lang('variables.item')
                        <span class="glyphicon glyphicon-plus"></span>
                    </a>
                @endif
            </div>
        </div>
    </div>
    <hr>
    @endif
    {{--**********************************************--}}
 {{--******************item Element**************--}}
    @if(Auth::user()->type!='user')
    <div class="panel-default">
        <a class="collapsed"
           role="button"
           data-toggle="collapse"
           data-parent="#accordion"
           href="#collapseModelType" aria-expanded="false"
           aria-controls="collapseModelType">
            <div class="color title3 panel_title" role="tab" id="headingModelType">
                @lang('variables.modelTypes')
            </div>
        </a>

        <div id="collapseModelType"
             class="panel-collapse collapse color"
             role="tabpanel" aria-labelledby="headingcModelType">
            <div class="panel-body title4">
                <a role="button" href="{{ URL::action('ModelTypeController@index') }}" class="dash_link">
                    @lang('variables.search')
                    <span class="glyphicon glyphicon-search"></span>
                </a>
                <br>
                @if(Auth::user()->type=='admin')
                    <a role="button"  href="{{ URL::action('ModelTypeController@create') }}" class="dash_link">
                        @lang('variables.add') @lang('variables.modelType')
                        <span class="glyphicon glyphicon-plus"></span>
                    </a>
                @endif
            </div>
        </div>
    </div>
    <hr>
    @endif
    {{--**********************************************--}}

    {{--******************invoice Element**************--}}
    @if(Auth::user()->type!='user')
    <div class="panel-default">
        <a class="collapsed" role="button"
           data-toggle="collapse" data-parent="#accordion"
           href="#collapseinvoice" aria-expanded="false"
           aria-controls="collapseinvoice">
            <div class="color title3 panel_title" role="tab" id="headinginvoice">
                @lang('variables.invoices')
            </div>
        </a>

        <div id="collapseinvoice" class="panel-collapse collapse color" role="tabpanel" aria-labelledby="headinginvoice">
            <div class="panel-body title4">
                <a role="button" href="{{ URL::action('InvoiceController@index') }}" class="dash_link">
                    @lang('variables.search')
                    <span class="glyphicon glyphicon-search"></span>
                </a>
                <br>
                <a role="button"  href="{{ URL::action('InvoiceController@create') }}" class="dash_link">

                    @lang('variables.add') @lang('variables.invoice')
                    <span class="glyphicon glyphicon-plus"></span>
                </a>
            </div>
        </div>
    </div>
    <hr>
    @endif
    {{--**********************************************--}}
    {{--******************report Element**************--}}
    <div class="panel-default">
        <a
           href="{{URL::action('InvoiceController@getTotalFromDateToDateForm')}}"
           aria-controls="collapseinvoice">
            <div class="color title3 panel_title" role="tab" id="headinginvoice">
                              الارباح
            </div>
        </a>

    </div>
    <hr>
    {{--**********************************************--}}
</div>
</div>

<script src="{{ URL::asset('js/jquery-2.1.3.js')}}"></script>
{{--<script src="{{ URL::asset('js/select2.min.js')}}"></script>--}}
<script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
@yield('js')
</body>
</html>