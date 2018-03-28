<div class='row pull-right'>
{{--    {{ print_r(get_defined_vars()['__data']) }}--}}
    @foreach($sizes as $size)
        <div  class='col-md-3 pull-right masafa separator-left-gray'>
            <label class='col-md-3 pull-right'>{{$size}}</label>
            <div class='col-md-9 pull-right'>
                <input class='form-control dir-rtl'
                       type='number' min='0' step='1'
                       name='sizes[{{$size}}]'
                       value='{{isset($values)&&isset($values[$size])?$values[$size]:0}}'
                        >
            </div>

        </div>
    @endforeach
</div>