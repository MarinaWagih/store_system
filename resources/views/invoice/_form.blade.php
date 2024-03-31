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
                    @elseif(str_contains($error,'items'))
                        @lang('variables.items')
                    @endif
                    @if(str_contains($error,'required'))
                        @lang('variables.required')
                    @elseif(str_contains($error,'not a valid'))
                        @lang('variables.not_a_valid')
                    @endif
                </div>

            @endforeach
</div>
    @endif
    </div>
</div>
{{--===================Form=================================--}}
{{--========================================================--}}
<div class="form-group col-md-6">
    {!! Form::label('employee_id',Lang::get('variables.the_employee')) !!}
    {!! Form::select('employee_id',$employees,null,['class'=>"form-control"]) !!}
</div>
<div class="form-group col-md-6">
    {!! Form::label('date',$date) !!}
    {!! Form::input('date','date',null,['class'=>'form-control ','id'=>'date',]) !!}
</div>
<div class="form-group col-md-6">
    {!! Form::label('client_phone',Lang::get('variables.client_phone')) !!}
    {!! Form::text('client_phone',null,['class'=>'form-control ','id'=>'client_phone']) !!}
</div>
<div class="form-group col-md-6">
    {!! Form::label('client_name',Lang::get('variables.client_name')) !!}
    {!! Form::text('client_name',null,['class'=>'form-control ','id'=>'client_name']) !!}
</div>

<div class="form-group col-md-6"></div>
<div class="form-group col-md-6">
    {!! Form::label('client_way_of_payment',Lang::get('variables.client_way_of_payment')) !!}
    {!! Form::select('client_way_of_payment',[
        'cash'=>trans('variables.cash'),
        'credit_card'=>trans('variables.credit_card'),
        ],null,['class'=>"form-control"]) !!}
</div>

<div class="form-group col-md-6" id="DiscountFormGroup">
    <label  for="exampleInputAmount">@lang('variables.discount')</label>
    <div class="input-group">
        <div class="input-group-addon">%</div>
        <input type="number"
               class="form-control dir-rtl _item_details"
               id="additional_discount_percentage"
               name="additional_discount_percentage"
               placeholder="@lang('variables.percentage') @lang('variables.discount')"
               min="0"
               value="0">
        <div class="input-group-addon">.00</div>
    </div>
</div>
<div class="form-group col-md-6" id="DiscountFormGroup">
    <label  for="exampleInputAmount">@lang('variables.discount')</label>
    <div class="input-group">
        <div class="input-group-addon">EGP</div>
        <input type="number"
               class="form-control dir-rtl _item_details"
               id="additional_discount_value"
               name="additional_discount_value"
               placeholder="@lang('variables.percentage') @lang('variables.discount')"
               min="0"
               value="0">
        <div class="input-group-addon">.00</div>
    </div>
</div>


{{--========================================================--}}
{{--========================================================--}}
@include('invoice._item_invoice')
{{--===================calculations=========================--}}
{{--========================================================--}}
<div class="row" id="bordCalculationTable">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="row final_calc">
            {{--========================================================--}}
            {{--========================================================--}}
            <div class="row" style="padding: 20px;">
                <div class="col-md-6 col-sm-6 col-xs-6">

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
                <div class="col-md-6 col-sm-6 col-xs-6">

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
            </div>
            </div>
            <div class="row" style="padding: 20px;">
                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                    {!! Form::label('amount_paid',trans('variables.amount_paid'),['class'=>'color_dark']) !!}
                    {!! Form::input('amount_paid','number',null,['class'=>'form-control _item_details','id'=>'amount_paid']) !!}
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="row" style="padding-top: 20px;">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <span id="Total_invoice_remaining">0.000</span>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                            <div class="color_dark title4">
                                @lang('variables.remainder')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>
<br>
{{--========================================================--}}
{{--========================================================--}}
<div class="form-group">
    {!! Form::hidden('total_after_sales_tax','0',['id'=>'total_after_sales_tax']) !!}
    {!! Form::submit($submitText,['class'=>'btn color','id'=>'submit']) !!}
</div>
