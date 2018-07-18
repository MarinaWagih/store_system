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
    {!! Form::label('sizes',Lang::get('variables.theSizes')) !!}
    {!! Form::select('sizes[]',isset($modelType)?$modelType->sizes:[],null,[
                                    'class'=>'form-control',
                                    'id'=>'sizes',
                                     'multiple'=>true

                                ]) !!}
</div>
<div class="form-group">
    {!! Form::submit( Lang::get('variables.add'),['class'=>'btn color']) !!}
</div>


