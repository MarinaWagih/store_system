$(document).ready(function () {
    var ItemsChange=function() {
        var itemCount=$("#tableBody").children().length;
        var total_before_discount=0.0;
        var total_after_discount=0.0;
        var additional_discount_percentage=parseFloat($("#additional_discount_percentage").val())||0;
        var additional_discount_value=parseFloat($("#additional_discount_value").val())||0;
        for(var i=0;i<itemCount;i++)
        {
            var quantity=parseInt($("[name='items["+i+"][quantity]']").val())||1;
            var price=parseFloat($("[name='items["+i+"][price]']").val());
            var discount_percent=parseFloat($("[name='items["+i+"][discount_percent]']").val())||0;
            var discount_value=parseFloat($("[name='items["+i+"][discount_value]']").val())||0;
            var price_before_discount=parseFloat(quantity*price);
            var price_after_discount=parseFloat(
                price_before_discount -
               (price_before_discount*discount_percent/100) -
                discount_value);

            $("[name='items["+i+"][quantity]']").val(quantity?quantity:1);
            $("[name='items["+i+"][price]']").val(price?price:0);
            $("[name='items["+i+"][discount_percent]']").val(discount_percent?discount_percent:0);
            $("[name='items["+i+"][total_before_discount]']").val(price_before_discount|0);
            $("[name='items["+i+"][total_after_discount]']").val(price_after_discount|0);
             total_before_discount+=price_before_discount;
             total_after_discount +=price_after_discount;
        }
        $("#Total_invoice_before_discount").html(total_before_discount);
        var total_after_add_discount=
                                    total_after_discount -
                                    (total_after_discount*additional_discount_percentage/100) -
                                    additional_discount_value;
        $("#Total_invoice_after_discount").html(total_after_add_discount);
        $("#total_after_sales_tax").val(total_after_add_discount);
    };
    var bindSelec2 = function(elem){
        elem.select2({
            dir: "rtl",
            ajax: {
                url: item_search,

                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        query: params.term, // search term
                        page: params.page,
                        price_type:$('#price_type').val()
                    };
                },
                processResults: function (data, page) {
                    return {

                        results: data
                    };
                },
                cache: true
            },
            minimumInputLength: 1
        });
        elem.on("select2:select", function (e) {
            console.log('changeeeeeeee select');
            $('[name="'+$(this).attr('name').replace('item_id','price')+'"]')
                .val(e.params.data.price);
            $('[name="'+$(this).attr('name').replace('item_id','quantity')+'"]')
                .val(1);
            ItemsChange();
        });
    };
    //date picker
    $(function () {
        $("#date").datepicker({
            dateFormat: 'yy-mm-dd'
        })
            .datepicker('setDate', new Date());
    });

    $('.repeater').repeater({
        //initEmpty: true,
        show: function () {
            $(this).slideDown();
            var this_select=$(this).find(".items_list");
                bindSelec2(this_select);
        },
        hide: function (deleteElement) {
            if(confirm('Are you sure you want to delete this element?')) {
                $(this).slideUp(deleteElement);
                ItemsChange();
            }
        }
    });
    $(document).on('change','._item_details',ItemsChange);
    bindSelec2($(".items_list"));
    //$("[data-repeater-create]").trigger('click');
    ItemsChange();

});
