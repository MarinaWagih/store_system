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
    {!! Form::label('name',$name) !!}
    {!! Form::text('name',null,['class'=>'form-control','placeholder'=>$write.' '.$name ]) !!}
</div>
<div class="form-group">
    {!! Form::label('code',$code) !!}
    {!! Form::text('code',null,['class'=>'form-control','placeholder'=>$write.' '.$code ]) !!}
</div>
<div class="form-group">
    {!! Form::label('price',$price) !!}
    {!! Form::input('number','price',null,['class'=>'form-control','id'=>'price','min'=>'0','step'=>"0.1"]) !!}
</div>
<div class="form-group">
    {!! Form::label('price',Lang::get('variables.client_price')) !!}
    {!! Form::input('number','client_price',null,['class'=>'form-control','id'=>'price','min'=>'0','step'=>"0.1"]) !!}
</div>
<div class="row">
    <div class="form-group col-lg-2">
        {!! Form::label('unit',Lang::get('variables.unit')) !!}
        {!! Form::text('unit',null,['class'=>'form-control','placeholder'=>Lang::get('variables.unit') ]) !!}
    </div>
    <div class="form-group col-lg-10">
        {!! Form::label('count',Lang::get('variables.count')) !!}
        {!! Form::input('number','count',null,['class'=>'form-control','id'=>'price','min'=>'0','step'=>"1"]) !!}
    </div>
</div>

<div class="form-group">
{!! Form::label('picture',$picture) !!}
{!! Form::file('picture', ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::submit($submitText,['class'=>'btn color']) !!}
</div>


