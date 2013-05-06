/**
 * Created with JetBrains PhpStorm.
 * User: DELL
 * Date: 7/25/12
 * Time: 12:45 PM
 * To change this template use File | Settings | File Templates.
 */
//var site_url = "http://localhost/IPMS_ver_1/index.php/";

function addIPPool(){
    $("#error_add_ip_pool").html("<div class='input-notification error png_bg'>Validating...!</div> ");
//    alert($('#txtIPaddress').val()+"  $$$  "+$('#txtSubnetMask').val());
if($('#txtSubnetMask').val()>24)
        alert('CIDR value should be less than or equal to 24');
    else{
    $.ajax
        (
            {
                type:"POST",
                url: site_url+"/ip_controller/saveIPPool",
                data: "ip_pool="+$('#txtIPaddress').val()+"&subnet="+ $('#txtSubnetMask').val(),
                async:false,
                success: function(msg){
                    if(msg==1){
                        $("#error_add_ip_pool").html("<div class='input-notification SUCCESS png_bg'>Validating...!</div> ");
                        alert("New IP POOl Added!!!");
                        window.location.reload(true);
                        setTimeout("location.href = site_url+'/ip_controller/addIPPool';", 100);

                    }
                    else if(msg == 2){
                        $("#error_add_ip_pool").html("<div class='input-notification error png_bg'>Check the IP address or CIDR value...!</div> ");
                        alert("IP Address already Exists!!!");
                        resetIPPoolForm();history.go(0);

                    }
                    else if(msg == 0){
                        alert("Invalid IP address or Subnet Value");
                        resetIPPoolForm();history.go(0);
                    }
                    else
                        alert(msg);
                },
                error: function(msg){
                    alert(msg);
                }
            }
        );
		}
    resetIPPoolForm();history.go(0);

}

function resetIPPoolForm(){
    document.getElementById("ippoolform").reset();
}

//function to delete the IP Main Pool, if and only if <generated primary sub pool IPs> are not assigned
function delete_IPPool(id,trid){
//    alert(id+" "+trid);
    var r = confirm("  Do you really want to delete the Main IP Pool \? \n\n Check if Generated PrimarySub Pool IPs are not Assigned\n");
    if(r==true){
        $.ajax
            (
                {
                    type:"POST",
                    url: site_url+"/ip_controller/deleteIPPool",
                    data: "ippool_id=" + id,
                    async:false,
                    success: function(msg){
                        if(msg == 1){
                            alert("Main IP Pool is Deleted");
                            setTimeout("location.href = site_url+'/ip_controller/addIPPool';", 100);
                        }
                        else if(msg == 0)
                            alert("Main IP Pool cannot be deleted. Check if IP blocks are already assigned.\n Delete them and Delete the Main IP Pool. !!!");
                        else{
                            alert(msg); history.go(0);
                        }
                    },
                    error: function(msg){
                        alert(msg);
                    }
                }
            );

    }
}


function open_PoolDetails(id){
        $.ajax
            (
                {
                    type:"POST",
                    url: site_url+"/ip_controller/openPoolDetails/",
                    data: "ippool_id=" + id,
                    async:false,
                    success: function(msg){
                       $.facebox(msg);

                    },
                    error: function(msg){
                        alert(msg);
                    }
                }
            );
}

function open_PoolDetails_Retrieve(pool_id,offset){
//    alert(offset+"  "+pool_id);
        $.ajax
        (
            {
                type:"POST",
                url: site_url+"/ip_controller/openPoolDetails/"+offset,
                data: "offset=" + offset +"&ippool_id=" + pool_id,
                async:false,
                success: function(msg){
                    $.facebox( msg);
                },
                error: function ( msg) {
                    alert(msg+" "+pool_id+" "+offset);
                }
            }
        );

}



