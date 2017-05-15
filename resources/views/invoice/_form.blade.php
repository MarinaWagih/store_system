{{--===================Errors===============================--}}
{{--========================================================--}}
<div>
    <div class="percentage" id="msg">
    @if(count($errors) > 0)
            <div class="alert alert-danger" id="msg">
            <strong>@lang('variables.there_is_an_error')</strong>
            @lang('variables.make_it_right')
            @lang('variables.and')
            @lang('variables.try_again')
            @foreach ($errors->all() as $key=>$error)
                <div>
                    @if(str_contains($error,'date'))
                        @lang('variables.date')
                    @elseif(str_contains($error,'client'))
                        @lang('variables.El-client')
                    @endif
                    @if(str_contains($error,'required'))
                        @lang('variables.required')
                    @elseif(str_contains($error,'not a valid'))
                        @lang('variables.not_a_valid')
                    @endif
{{--                                            {{$error}}--}}
                </div>

            @endforeach
</div>
    @endif
    </div>
</div>
{{--===================Form=================================--}}
{{--========================================================--}}
<div class="form-group">
    {!! Form::label('date',$date) !!}
    {!! Form::input('date','date',null,['class'=>'form-control','id'=>'date',]) !!}
</div>
<div class="form-group">
    {!! Form::label('client',$client) !!}
    {!! Form::select('client_id',[],null,['class'=>'js-example-rtl form-control','id'=>'clients']) !!}
</div>
<div class="checkbox">
    {!! Form::label('type',Lang::get('variables.pay'),[]) !!}
    {!! Form::radio('type', 'pay',false,['id'=>'inv_type2'])  !!}

    {!! Form::label('type',$sell,[]) !!}
    {!! Form::radio('type', 'sell',true,['id'=>'inv_type'])  !!}


</div>
<div id="totalShowForPayCheck" class="form-group hidden">
    {!! Form::label('total',Lang::get('variables.the_amount'),[]) !!}
    <input type="number" class="form-control"
           id="total_after_sales_tax_in_pay"
           name="total_at_pay"
           placeholder="@lang('variables.the_amount')"
           min="0">

</div>
<div class="form-group" id="DiscountFormGroup">
    <label  for="exampleInputAmount">@lang('variables.discount')</label>
    <div class="input-group">
        <div class="input-group-addon">%</div>
        <input type="number" class="form-control" id="discount_percentage" placeholder="@lang('variables.percentage') @lang('variables.discount')" min="0" value="20">
        <div class="input-group-addon">.00</div>
    </div>
</div>
{{--================== Item Form button luncher=============--}}
{{--========================================================--}}
<!-- Button trigger modal -->
<button type="button" class="btn color" id="itemFormLauncher"
        data-toggle="modal" data-target="#itemFormModel">
    @lang('variables.add') @lang('variables.items')
</button>
{{--========================================================--}}
{{--========================================================--}}
{{--====================items Form Model====================--}}
{{--========================================================--}}
<!-- Modal -->
<div class="modal fade" id="itemFormModel"
     role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">
                    @lang('variables.add') @lang('variables.item')
                </h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    {!! Form::label('item',$item) !!}
                    <br>
                    {!! Form::select('item_id',[],null,['class'=>'js-example-rtl form-control','id'=>'items_list']) !!}
                </div>


                <div class="form-group">
                    {!! Form::label('quantity',$quantity) !!}
                    {!! Form::input('number','quantity',0,['class'=>'form-control','id'=>'quantity','min'=>'0']) !!}
                </div>
                <div class="form-group" id="price">
                    {!! Form::label('price',$price) !!}
                    {!! Form::input('number','price',0,['class'=>'form-control','id'=>'item_price','min'=>'0','step'=>"0.1",'disabledse']) !!}
                </div>
                <div class="form-group">

                    <div id="total_after_discount">
                    <h1 class="color_pink title3">
                        <span id="total_item"> 0</span>  : @lang('variables.the_total')

                    </h1>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">
                    @lang('variables.end')
                </button>
                <button type="button" class="btn color" id="item_add_end">
                    @lang('variables.adding') @lang('variables.and') @lang('variables.end')
                </button>
                <button type="button" class="btn color" id="item_add">
                    @lang('variables.add')
                </button>
            </div>
        </div>
    </div>
</div>
{{--========================================================--}}
{{--========================================================--}}

{{--==================Items show table======================--}}
{{--========================================================--}}
<table class="table table-hover table-responsive" id="itemFormTable">
    <thead>
    <tr>
        <th>@lang('variables.operations')</th>
        <th>@lang('variables.the_total') @lang('variables.after') @lang('variables.discount')</th>
        <th>@lang('variables.price') @lang('variables.after') @lang('variables.discount')</th>
        <th>@lang('variables.percentage')  @lang('variables.discount')</th>
        <th>@lang('variables.price') @lang('variables.before') @lang('variables.discount')</th>
        <th>@lang('variables.quantity')</th>
        <th>@lang('variables.image')</th>
        <th>@lang('variables.name')</th>
        <th>@lang('variables.number')</th>
    </tr>
    </thead>
    <tbody id="tableBody">
    @if(isset($invoice))
        @foreach($invoice->items as $item)
            <tr id="{{$item->id}}" class="items_row">
                <td class="delete_item" id="x-{{$item->id}}"> @lang('variables.delete') </td>
                <td>
                    {{($item->pivot->price-($item->pivot->price *$item->pivot->discount_percent)/100)*$item->pivot->quantity }}
                </td>
                <td>
                    {{$item->pivot->price-($item->pivot->price *$item->pivot->discount_percent)/100  }}
                </td>
                <td>
                    {{$item->pivot->discount_percent}}
                </td>
                <td>
                    {{ $item->pivot->price  }}
                </td>
                <td>
                    {{ $item->pivot->quantity  }}
                </td>
                <td>
                    <img src="{{URL::asset('images/'.$item->picture)}}" style="height: 50px;width:50px">
                </td>
                <td>
                    {{ $item->name  }}
                </td>
                <td>
                    {{ $item->id }}
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
{{--========================================================--}}
{{--========================================================--}}

{{--===================calculations=========================--}}
{{--========================================================--}}
<div class="row" id="bordCalculationTable">
<div class="col-lg-1"></div>
<div class="col-lg-10">
    <div class="row final_calc">
        {{--========================================================--}}
        {{--========================================================--}}
        <div class="col-xs-offset-6 col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <span id="Total_invoice_before_discount">0.000</span>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                <span class="color_dark title5">
                    @lang('variables.total') @lang('variables.price') @lang('variables.before') @lang('variables.discount')
                </span>
                </div>

            </div>
            <div class="row">

                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <span id="Total_invoice_after_discount">0.000</span>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                <span class="color_dark title5">
                    @lang('variables.total') @lang('variables.price') @lang('variables.after') @lang('variables.discount')
                </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-1"></div>
</div>
<br>
{{--========================================================--}}
{{--========================================================--}}
<div class="form-group">
    {!! Form::hidden('items','',['id'=>'items']) !!}
    {!! Form::hidden('total_after_sales_tax','',['id'=>'total_after_sales_tax']) !!}
    {!! Form::submit($submitText,['class'=>'btn color','id'=>'submit']) !!}
</div>
