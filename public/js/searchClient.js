$(document).ready(function () {

    function sendData()
    {
        $.post(search_url,
            {
                'query':$('#query').val(),
                '_token':$('#_token').val(),
                'type':'json'
            },
            function(result){
                var count=result.data.length;
                var toShow="";
                for(var i=0;i<count;i++)
                {
                    toShow+='<tr>' ;
                    toShow+='<td>';
                    var link_show=client_index+'/'+result.data[i].id ;
                    var link_edit=client_index+'/'+result.data[i].id+'/edit';
                    var link_delete=window.location.href+'/'+result.data[i].id+'/delete';

                    toShow+='<a href="'+link_show+'")>'+"@lang('variables.show')"+'</a>';
                    toShow+=' <a href="'+link_edit+'">'+"@lang('variables.edit')"+'</a>';
                    if($('#U_type').val()=='admin')
                    {
                        toShow+=' <a href="'+link_delete+'">'+"@lang('variables.delete')"+'</a>';
                    }
                    toShow+='</td>';
                    toShow+='<td>'+result.data[i].trading_name+'</td>';
                    toShow+='<td>'+result.data[i].phone+'</td>';
                    toShow+='<td>'+result.data[i].name+'</td>';
                    toShow+='<td>'+result.data[i].id+'</td>';
                    toShow+='</tr>';
                }
                $('#result').html(toShow);
                $('#render').html(result.render);
                //console.log();

            });
    }
    $('#submit').click(function () {
        sendData()
    });
    $('#query').keyup(function () {
        sendData()
    });
});