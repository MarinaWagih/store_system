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
<div class="form-group col-md-6" id="DiscountFormGroup">
    <label  for="exampleInputAmount">@lang('variables.discount')</label>
    <div class="input-group">
        <div class="input-group-addon">%</div>
        <input type="number"
               class="form-control dir-rtl"
               id="discount_percentage"
               placeholder="@lang('variables.percentage') @lang('variables.discount')"
               min="0"
               value="0">
        <div class="input-group-addon">.00</div>
    </div>
</div>
<div class="form-group col-md-6">
    {!! Form::label('date',$date) !!}
    {!! Form::input('date','date',null,['class'=>'form-control ','id'=>'date',]) !!}
</div>
{{--========================================================--}}
{{--========================================================--}}
@include('invoice._item_invoice')
{{--===================calculations=========================--}}
{{--========================================================--}}
<div class="row" id="bordCalculationTable">
<div class="col-lg-10">
    <div class="row final_calc">
        {{--========================================================--}}
        {{--========================================================--}}
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
</div>
<div class="col-lg-1"></div>
</div>
<br>
{{--========================================================--}}
{{--========================================================--}}
<div class="form-group">
    {!! Form::hidden('total_after_sales_tax','0',['id'=>'total_after_sales_tax']) !!}
    {!! Form::submit($submitText,['class'=>'btn color','id'=>'submit']) !!}
</div>
