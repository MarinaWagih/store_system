<div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>@lang('variables.there_is_an_error')</strong>
            @lang('variables.make_it_right')
            @lang('variables.and')
            @lang('variables.try_again')
            @foreach ($errors->all() as $key=>$error)
                <div>
                    @if(str_contains($error,'name'))
                        @lang('variables.name')
                    @elseif(str_contains($error,'price'))
                        @lang('variables.price')
                    @endif
                    @if(str_contains($error,'required'))
                        @lang('variables.required')
                    @elseif(str_contains($error,'at least'))
                        @lang('variables.at_least_12')
                    @elseif(str_contains($error,'taken'))
                        @lang('variables.taken')
                    @endif
                        {{--{{$error}}--}}
                </div>
            @endforeach
        </div>

    @endif
</div>
<div class="form-group">
    {!! Form::label('name',Lang::get('variables.name')) !!}
    {!! Form::text('name',null,['class'=>'form-control','placeholder'=>Lang::get('variables.write').' '.Lang::get('variables.name') ]) !!}
</div>
<div class="form-group">
    {!! Form::label('code',Lang::get('variables.code')) !!}
    {!! Form::text('code',null,['class'=>'form-control','placeholder'=>Lang::get('variables.write').' '.Lang::get('variables.code') ]) !!}
</div>
<div class="form-group">
    {!! Form::label('price',Lang::get('variables.price')) !!}
    {!! Form::input('number','price',null,['class'=>'form-control','id'=>'price','min'=>'0','step'=>"0.1"]) !!}
</div>
<div class="form-group">
    {!! Form::label('price',Lang::get('variables.client_price')) !!}
    {!! Form::input('number','client_price',null,['class'=>'form-control','id'=>'price','min'=>'0','step'=>"0.1"]) !!}
</div>
<div class="row">
    {{--<div class="form-group col-lg-2">--}}
        {{--{!! Form::label('unit',Lang::get('variables.unit')) !!}--}}
        {{--{!! Form::text('unit',null,['class'=>'form-control','placeholder'=>Lang::get('variables.unit') ]) !!}--}}
    {{--</div>--}}
    <div class="form-group col-lg-12">
        {!! Form::label('count',Lang::get('variables.count')) !!}
        {!! Form::input('number','count',null,['class'=>'form-control','id'=>'price','min'=>'0','step'=>"1"]) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('client',Lang::get('variables.client')) !!}
    {!! Form::select('client_id',$clients,null,['class'=>'js-example-rtl form-control dir-rtl','id'=>'clients']) !!}
</div>
<div class="form-group">
{{--{!! Form::label('model_type_id',Lang::get('variables.modelType')) !!}--}}
{{--{!! Form::select('model_type_id', ['class'=>'form-control']) !!}--}}
    <label for="model_type_id">@lang('variables.modelType')</label>
    <select name="model_type_id" class='form-control' style="direction: rtl">
        <option value="" data-sizes=""></option>
        @foreach($modelTypes as $type)
            <option
                    value="{{$type->id}}"
                    data-sizes="@include('item._sizes_form',['sizes'=>$type->sizes])"
                    {{isset($item)&&$item->model_type_id==$type->id?'selected':''}}
                    >
                {{$type->name}}
            </option>
        @endforeach
    </select>
</div>
<div class="form-group" id="sizes_count_container">
    @if(isset($item))
        @include('item._sizes_form',['sizes'=>$item->modelType->sizes,'values'=>$item->sizes])
    @endif
</div>
<div class="form-group">
    {!! Form::submit( Lang::get('variables.add'),['class'=>'btn color']) !!}
</div>


