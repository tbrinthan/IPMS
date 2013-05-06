/**
 * Created with JetBrains PhpStorm.
 * User: root
 * Date: 7/26/12
 * Time: 2:38 PM
 * To change this template use File | Settings | File Templates.
 */

//var site_url="http://localhost/IPMS_ver_1/index.php/";
function getSubcategory(id){

    document.getElementById("txtcidr").value='';

    if(id==1){
        if($('#checkbox1').is(':checked')) {
            document.getElementById("checkbox1").checked=false;
            document.getElementById("node_button").style.display='block';
        }else
            document.getElementById("subcategory").value=0;

        document.getElementById("check1").style.display= 'block';
        document.getElementById("hide").style.display= 'none';
//        $(".hide").hide();
    }
    else {
        document.getElementById("check1").style.display= 'none';
        document.getElementById("hide").style.display= 'block';

    $.ajax(
        {
            type: "POST",
            url: site_url + "/ipblock_controller/get_subcategory",
            data: "cat_id=" + id,
            success: function(msg){
//                alert(msg);
                if(msg!=0){
                    $('#subcat').html(msg);
//                    alert("hi");
                }
                else{
//                    $('#subcategory').empty();
                    document.getElementById("subcategory").selectedIndex=0;

                }

            }

        }
    );

    }
}


function checkbox(id){
    if($('#checkbox1').is(':checked')) {
//        alert($('#checkbox1').val());
        document.getElementById("hide").style.display= '';
        document.getElementById("node_button").style.display='none';
        document.getElementById("txtcidr").value='';

        $.ajax(
            {
                type: "POST",
                url: site_url + "/ipblock_controller/get_subcategory",
                data: "cat_id=" + $('#checkbox1').val(),
                success: function(msg){
//                alert(msg);
                    if(msg!=0){
                        $('#subcat').html(msg);
//                    alert("hi");
                    }
                    else{
//                    $('#subcategory').empty();
                        document.getElementById("subcategory").selectedIndex=0;

                    }

                }

            }
        );
    }
    else{
        getSubcategory(id);
        document.getElementById("node_button").style.display='block';

    }
//    $('#checkbox1').toggle();
}

//function checked_values(){
//    var checkedValues = [];
//    var allCheckboxes = document.getElementsByName("checkbox[]");
//    for(var i = 0; i < allCheckboxes.length; i++){
//        if (allCheckboxes[i].checked)
//            checkedValues.push(allCheckboxes[i].value);
//        else  document.getElementById("txtcidr").value='';
//
//    }
//    return checkedValues;
//}

function node_blocks(){
    oTable = $('#dt22').dataTable();
    var  checked = new Array();
        $('input[@name=row_sel]:checked', oTable.fnGetNodes()).closest('tr').each( function (i) {
                    checked[i] = $(this).attr('id');

    });
    if(checked==false) document.getElementById("txtcidr").value='';
    $.ajax(
        {
            type: "POST",
            url: site_url + "/ipblock_controller/add_nodeblocks",
            data:"subpool_id=" + checked,
            success:function(msg){
//                alert(msg);
                $('#ipaddress').html(msg);
            }

        }
    );
    $('#facebox').fadeOut();
}

function node_locations(){
    oTable = $('#dt22').dataTable();
    var  checked = new Array();
        $('input[@name=row_sel]:checked', oTable.fnGetNodes()).closest('tr').each( function (i) {
                    checked[i] = $(this).attr('id');
    });
//    alert(temp);
if(checked==false) document.getElementById("txtcidr").value='';

    $.ajax(
        {
            type: "POST",
            url: site_url + "/ipblock_controller/add_locationIP",
            data: "ip_id="+ checked,
            success:function(msg){
//                alert(msg);
                $('#ipaddress').html(msg);
            }

        }
    );
    $('#facebox').fadeOut();
}

function viewNodeblock(){


        $.ajax(
            {
                type: "POST",
                url: site_url + "/ipblock_controller/view_nodeblocks",
                data:"cat_id=" + $('#category').val(),
                async:false,
                success: function(msg){
                    $.facebox(msg);
//                    alert(msg);
                },
//                error: function ( msg) {
////                    if(xmlHttpRequest.readyState == 0 || xmlHttpRequest.status == 0)
////                        return '';
////                    else
//                    alert(msg);
//                }
                error: function (xmlHttpRequest, textStatus, errorThrown) {
                    if(xmlHttpRequest.readyState == 0 || xmlHttpRequest.status == 0)
                        return '';  // it's not really an error
                   else{alert('error');}}

                        }
        );
}

function viewNodeblock_pagination(cat_id,offset){
      $.ajax(
        {
            type: "POST",
            url: site_url + "/ipblock_controller/view_nodeblocks/"+offset,
            data:"cat_id="+cat_id,
            async: false,
            success: function(msg){
//                alert("how are you??");
                $.facebox(msg);
//               $('#nodeip_table').html(msg);
            },
            error: function(msg){
                alert(msg);
            }
        }
    );
}

function viewIpblock(){

        $.ajax(
            {
                type: "POST",
                url: site_url + "/ipblock_controller/view_ipblocks",
                data: "cat_id="+ $('#category').val()+"&subcat_id="+ $('#subcategory').val(),
                async: false,
                success:function(msg){
                    if(msg==0){alert('Please select a subcategory!');}
                    else
                        {
                    
                    $.facebox(msg);
                        }
                        
                }
            }
        );

}

function viewIpblock_pagination(cat_id,subcat_id,offset){

    $.ajax(
        {
            type: "POST",
            url: site_url + "/ipblock_controller/view_ipblocks/"+offset,
            data: "cat_id="+ cat_id +"&subcat_id="+ subcat_id,
            async: false,
            success:function(msg){
                if(msg==0){alert('Please select a subcategory!');}
                else
                    $.facebox(msg);
            }
        }
    );

}

function addIpblock(){
//    var subcat_id = document.getElementById('subcategory').value;
//    var node_blocks=document.getElementById('txtcidr').value;

    $("#error_add_ipblock").html("<div class='input-notification error png_bg'>Validating...!</div> ");
//    alert($('#txtIPaddress').val()+"  $$$  "+$('#txtSubnetMask').val());

    $.ajax
        (
            {
                type:"POST",
                url: site_url+"/ipblock_controller/save_ipblocks",
                data: "cat_id="+$('#category').val() +"&node_blocks="+ $('#txtcidr').val() + "&subcat_id="+ $('#subcategory').val()+ "&subpool_id="+$('#checked').val(),
                async: false,
                success: function(msg){
                    alert(msg);
//                    alert(test);
                },
                error: function(msg){
//                    alert(msg);
                }
            }
        );
//    alert(node_blocks);
    document.getElementById('txtcidr').value='';
    history.go(0);
}

function resetForm(){
    document.getElementById("ipblockform").reset();
}