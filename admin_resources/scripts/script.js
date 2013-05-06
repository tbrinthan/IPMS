/**
 * Created with JetBrains PhpStorm.
 * User: DELL
 * Date: 7/16/12
 * Time: 1:47 PM
 * To change this template use File | Settings | File Templates.
 */

function showHideCategory(id){
       //alert(id);
    if(id == 0){
        document.getElementById('newcategory').style.display= '';
        document.getElementById('newsubcategory').style.display='none';
        document.getElementById('newlocation').style.display='none';
        document.getElementById('txtCategory').value=null;
        document.getElementById('txtSubCategory').value=null;
        document.getElementById('txtLocation').value=0;
        $('#error_add_category').html("<div></div>");

    }
    else if(id == 1) {
        document.getElementById('newcategory').style.display='none';
        document.getElementById('newsubcategory').style.display= '';
        document.getElementById('newlocation').style.display='';
        document.getElementById('txtCategory').value=null;
        document.getElementById('txtSubCategory').value=null;
        document.getElementById('txtLocation').value=0;
        $('#error_add_category').html("<div></div>");

    }
    else {
        document.getElementById('newcategory').style.display='none';
        document.getElementById('newsubcategory').style.display= '';
        document.getElementById('newlocation').style.display='none';
        document.getElementById('txtCategory').value=null;
        document.getElementById('txtSubCategory').value=null;
        document.getElementById('txtLocation').value=0;
        $('#error_add_category').html("<div></div>");

    }
}

function get_Notification(){
    $.ajax
        (
            {
                type:"POST",
                url: site_url+"/customer_controller/getNotifications",
                success: function(msg){
                    $.facebox(msg);
                },
                error: function(msg){
                    alert(msg);
                }
            }
        );
}
//to Redirect to Customer Details form Notificatoin Panel
function get_TempCustDetail(id){
    window.location = site_url+'/customer_controller/viewTempCustomer/'+id;

//    $('#custName option:selected').val(id);
}

