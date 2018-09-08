
{{--==================Items show table======================--}}
{{--========================================================--}}
<div class="repeater">


<table class="table table-hover table-responsive dir-rtl" id="itemFormTable">
    <thead>
    <tr>
        <th class="col-md-2">@lang('variables.name')</th>
        <th class="col-md-1">@lang('variables.theSize')</th>
        <th class="col-md-1">@lang('variables.quantity')</th>
        <th class="col-md-1">@lang('variables.price') @lang('variables.before') @lang('variables.discount')</th>
        <th class="col-md-1">@lang('variables.percentage')  @lang('variables.discount') "EGP"</th>
        <th class="col-md-1">@lang('variables.percentage')  @lang('variables.discount') "%"</th>
        <th class="col-md-2">@lang('variables.price') @lang('variables.after') @lang('variables.discount')</th>
        <th class="col-md-2">@lang('variables.the_total') @lang('variables.after') @lang('variables.discount')</th>
        <th class="col-md-1">@lang('variables.operations')</th>
    </tr>
    </thead>
    <tbody id="tableBody" data-repeater-list="items">
    @if(isset($invoice))
        @foreach($invoice->items as $item)
            <tr  data-repeater-item >
                <td>
                    <select
                            class='js-example-rtl
                            form-control items_list'
                            name="item_id"
                            >
                        <option selected value="{{$item->id}}">
                            {{$item->name}}
                        </option>
                    </select>
                </td>
                <td>
                    <input type="text"
                           class="form-control "
                           name="size"
                           value="{{ $item->pivot->size  }}" >
                </td>
                <td>
                    <input type="number"
                           class="form-control _item_details"
                           name="quantity"
                           value="{{ $item->pivot->quantity  }}" >

                </td>
                <td>
                    <input type="number" name="price"
                           class="form-control _item_details"
                           value="{{ $item->pivot->price  }}" >


                </td>
                <td>
                    <input name="discount_percent"
                           class="form-control _item_details"
                           value="{{$item->pivot->discount_value}}"
                            >
                </td>
                <td>
                    <input name="discount_percent"
                           class="form-control _item_details"
                           value="{{$item->pivot->discount_percent}}"
                            >
                </td>

                <td>
                    <input
                            class="form-control"
                            name="total_before_discount"
                            value="{{$item->pivot->price-
                            ($item->pivot->price *
                            $item->pivot->discount_percent)/100  }}"
                            disabled>
                </td>
                <td>
                    <input
                            class="form-control"
                            name="total_after_discount"
                            value="{{($item->pivot->price-(
                            $item->pivot->price *$item->pivot->
                            discount_percent)/100)*$item->pivot->quantity }}"
                            disabled>

                </td>
                <td>
                    <input data-repeater-delete type="button"
                           class="btn btn-danger delete_item "
                           value="@lang('variables.delete')"/>
                </td>
            </tr>
        @endforeach
    @else
        <tr  data-repeater-item >
            <td><select class='js-example-rtl form-control items_list' name="item_id"></select></td>
            <td><input type="text"   name="size"                  class="form-control"                value="" ></td>
            <td><input type="number" name="quantity"              class="form-control _item_details"  value="0" min="0"></td>
            <td><input type="number" name="price"                 class="form-control _item_details"  value="0" min="0" step="0.5"></td>
            <td><input type="number" name="discount_value"        class="form-control _item_details"  value="0" min="0" step="0.5"></td>
            <td><input type="number" name="discount_percent"      class="form-control _item_details"  value="0" min="0" step="0.1" ></td>
            <td><input type="text"   name="total_before_discount" class="form-control"                value="0"   disabled></td>
            <td><input type="text"   name="total_after_discount"  class="form-control"                value="0"   disabled></td>
            <td><input data-repeater-delete type="button" class="btn btn-danger delete_item " value="@lang('variables.delete')"/></td>
        </tr>
    @endif



    </tbody>
</table>
<input data-repeater-create
       type="button"
       class="btn color"
       value="@lang('variables.add') @lang('variables.items')"/>
</div>
{{--========================================================--}}
{{--========================================================--}}



