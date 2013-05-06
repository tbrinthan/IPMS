/**
 * Created with JetBrains PhpStorm.
 * User: DELL
 * Date: 8/8/12
 * Time: 12:16 PM
 * To change this template use File | Settings | File Templates.
 */
//var site_url = "http://localhost/IPMS_ver_1/index.php/";

function get_CustomerDetails(id){
//    alert(id);
   if(id !=0){
    view_CustomerDetails();  
    $('#temp2').hide();
    $.ajax
        (
            {
                type:"POST",
                url: site_url+"/customer_controller/displayCustomerDetails",
                data: "cust_id="+ id+ "&linkid="+$("#linkid").val(),
                async:false,
                success: function(msg){
//                    var temp = new Array();
//                    temp = msg.split('||');
//                    document.getElementById('custID').style.display='';
//                        document.getElementById('display_custID').innerHTML = temp[0];
//                    document.getElementById('custBW').style.display='';
//                        document.getElementById('display_custBW').innerHTML = temp[1];
//                   document.getElementById('custAddress').style.display='';
//                        document.getElementById('display_custAddress').innerHTML = temp[2];
//                   document.getElementById('custConnection').style.display='';
//                         document.getElementById('display_custCon').innerHTML = temp[3];
//                    displayNodeIpTable();
//                    displayCategoryIPTable();
//                    displayPvtIpTable();
//                    displayEndDate(id);
                      $('#temp1').html(msg);
//alert(msg);

                },
                error: function(msg){
                    alert(msg);
                }
            }
        );
    }
    else{
//        resetCustomerForm();
    history.go(0);
   }

}

function view_CustomerDetails(){
id=$('#custName').val();
enddate=$('#display_EndDate').val();
if(id !=0){
    if($('#LinkService').val() !=0)
        $('#LinkService').val(0);   
    $('#temp2').hide();
    $('#edit_cust').hide();

     displayNodeIpTable();
     displayCategoryIPTable();
     displayPvtIpTable();
    }
    else{
//        resetCustomerForm();
alert('Please select a customer');
 history.go(0);
   }

}


function displayNodeIpTable(){
    document.getElementById('table_nodeip').style.display = '';
    $.ajax({
        type: "POST",
        url: site_url + "/customer_controller/displayNodeIpTable",
        data: "custservid="+ $('#LinkService').val() + "&cust_id=" + $('#custName').val() + "&enddate=" +$('#display_EndDate').val() ,
        async: false,
        success:function(msg){
            $('#table_nodeip').html(msg);
        },
        error: function(msg){
            alert(msg);
        }
    });
}

function displayEndDate(id){
    document.getElementById('custEndDate').style.display = '';
    $.ajax({
        type: "POST",
        url: site_url + "/customer_controller/displayEndDate",
        data: "cust_id="+ id,
        async: false,
        success:function(msg){
            $('#display_EndDate').html(msg);
        },
        error: function(msg){
            alert(msg);
        }
    });
}
function resetCustomerForm(){
    document.getElementById("addcustomerform").reset();
}

function resetTempCustomerForm(){
    document.getElementById("viewtempcustomerform").reset();
}

function showNodeIPButton(id){
    if(id!=0)
        document.getElementById('node_ip_available').style.display = '';
    else
        document.getElementById('node_ip_available').style.display = 'none';
}

function showCategoryIPButton(id){
    if(id!=0)
        document.getElementById('service_ip_available').style.display = '';
    else
        document.getElementById('service_ip_available').style.display = 'none';
}

function get_NodeIPDetails_ForSSID(){
    if($('#custName').val()==0){
        alert('Please select a customer');
    }
    else if($('#LinkService').val()==0){
        alert('Please select a link or Service');
    }
    else if($('#NodeLocation').val()==0){
        alert('Please select a location');
    }else if($('#NodeSSID').val()==0){
        alert('Please select an SSID');
    }
//    if($('#NodeLocation').val() !=0 && $('#NodeSSID').val() != 0 ){
else{
        $.ajax(
            {
                type: "POST",
                url: site_url + "/customer_controller/displayNodeDetail",
                data: "sub_cat_id="+ $('#NodeSSID').val(),
                async: false,
                success:function(msg){
                    $.facebox(msg);
//                    alert(msg);

                },
                error: function(msg){
                    alert(msg);
                }

            }
        );
    }
//    else alert("Please select a SSID");
}

function get_NodeIPDetails_ForSSID_GET(sub_cat_id,offset){
    if(sub_cat_id != 0 ){
        $.ajax(
            {
                type: "POST",
                url: site_url + "/customer_controller/displayNodeDetail/"+offset,
                data: "sub_cat_id="+ sub_cat_id + "&offset="+offset,
                async: false,
                success:function(msg){
                    $.facebox(msg);
//                    alert(msg);

                },
                error: function(msg){
                    alert(msg);
                }

            }
        );
    }
    else alert("Please select a SSID");
}


//Obtain the Checked Checkbox values in from the Input Tables
function get_CheckedValues(){
    var checkedValues = [];
    var allCheckboxes = document.getElementsByName("checkbox[]");
    for(var i = 0; i < allCheckboxes.length; i++){
        if (allCheckboxes[i].checked)
            checkedValues.push(allCheckboxes[i].value);
    }
    return checkedValues;
}

//Obtain the selected drop down list values for the checked IP addresses
function get_NodeTypeSelectedValues(){

    var  checkedBoxes = get_CheckedValues();
    var selectedValues = [];
    var allSelectedValues = new Array();
    for(var i = 0; i< checkedBoxes.length;i++){
        var check = "node_type"+checkedBoxes[i];
        allSelectedValues[i] = $('#'+check).val();
    }
    return allSelectedValues;
}

//Assign nodeIP addresese to customers
function add_NodeIP_to_Customer(){
//    alert(get_CheckedValues());
//    alert(get_NodeTypeSelectedValues());
//    alert($('#custName').val());

//    //gets table
//
    //gets rows of table
//    for (i = 0; i < rowLength; i++){
//    //loops through rows
//
//       var oCells = oTable.rows.item(i).cells;
//       //gets cells of current row
//       var cellLength = oCells.length;
//           for(var j = 0; j < cellLength; j++){
//           //loops through each cell in current row
//              var cellVal = oCells.item(j).innerHTML;
//              alert(cellVal);
//           }
//    }
    
    $.ajax(
        {
            type: "POST",
            url: site_url + "/customer_controller/addNodeDetail",
            data: "checked_values="+ get_CheckedValues() +"&selected_values="+get_NodeTypeSelectedValues()+"&customer="+$('#custName').val()+"&custservid="+$('#LinkService').val(),
            async: false,
            success:function(msgg){
//alert(msgg);
                $('#facebox').fadeOut();
                if(msgg != 0){
                document.getElementById('table_nodeip').style.display = '';
                $('#table_nodeip').html(msgg);
//                    alert(msgg);
                }
                else
                    alert("ERror");

            },
            error: function(msg){
                alert(msg);
            }

        }
    );
}

//This function is to SEnd the LocationID to controller and get SSIDs for them
function show_SSIDPerLocation(id){
    $.ajax(
        {
            type: "POST",
            url: site_url + "/customer_controller/showNodeSSID",
            data: "location_id="+ id,
            async: false,
            success:function(msg){
                $('#NodeSSID').html(msg);
            },
            error: function(msg){
                alert(msg);
            }

        }
    );
}


function delete_AssignedNodeIP(id,trid){
    var r = confirm("  Do you really want to remove the assigned Node IP Address \?");
    if(r==true){
        $.ajax
            (
                {
                    type:"POST",
                    url: site_url+"/customer_controller/deleteAssignedNodeIP",
                    data: "nodedetail_id=" + id,
                    async:false,
                    success: function(msg){
                        if(msg == 1){
                            alert("Assigned Node IP Deleted");
                            document.getElementById("node"+trid).style.display = 'none';
                        }
                        else
                            alert('Error');
                    },
                    error: function(msg){
                        alert(msg);
                    }
                }
            );

    }
}

function delete_AlreadyAssignedNodeIP(id,trid){
    var r = confirm("  You are About to Delete an IP Address Which was assigned Previously\n\nDo you really want to remove the Previously assigned Node IP Address \?");
    if(r==true){
        var q = prompt("Leave Remarks:");
        $.ajax
            (
                {
                    type:"POST",
                    url: site_url +"/customer_controller/deleteAlreadyAssignedNodeIP",
                    data: "nodedetail_id=" + id +"&remark=" + q,
                    async:false,
                    success: function(msg){
                        if(msg == 1){
                            alert("Previously Assigned Node IP Deleted");
                            document.getElementById("node"+trid).style.display = 'none';
                        }
                        else
                            alert('Error');
                    },
                    error: function(msg){
                        alert(msg);
                    }
                }
            );

    }
}

//function delete_AlreadyAssignedNodeIP(id,trid){
//    var r = confirm("  You are About to Delete an IP Address Which was assigned Previously\n\nDo you really want to remove the Previously assigned Node IP Address \?");
//    if(r==true){
//        $.ajax
//            (
//                {
//                    type:"POST",
//                    url: site_url+"/customer_controller/deleteAlreadyAssignedNodeIP",
//                    data: "nodedetail_id=" + id,
//                    async:false,
//                    success: function(msg){
//                        if(msg == 1){
//                            alert("Previously Assigned Node IP Deleted");
//                            document.getElementById("node"+trid).style.display = 'none';
//                        }
//                        else
//                            alert('Error');
//                    },
//                    error: function(msg){
//                        alert(msg);
//                    }
//                }
//            );
//
//    }
//}



function show_SubcatPerCat(id){
    $.ajax(
        {
            type: "POST",
            url: site_url + "/customer_controller/showSubCatPerCategory",
            data: "cat_id="+ id,
            async: false,
            success:function(msg){
                $('#SubCategoryIP').html(msg);
            },
            error: function(msg){
                alert(msg);
            }

        }
    );
}


function get_CategoryIPDetails_ForSSID(){
    if($('#custName').val()==0){
        alert('Please select a customer');
    }
    else if($('#LinkService').val()==0){
        alert('Please select a link or Service');
    }
    else if($('#CategoryIP').val()==0){
        alert('Please select a category');
    }else if($('#SubCategoryIP').val()==0){
        alert('Please select a sub category');
    }
    else{
        $.ajax(
            {
                type: "POST",
                url: site_url + "/customer_controller/displayCategoryIPDetail",
                data: "sub_cat_id="+ $('#SubCategoryIP').val(),
                async: false,
                success:function(msg){
                    $.facebox(msg);
//                    alert(msg);

                },
                error: function(msg){
                    alert(msg);
                }

            }
        );
    }
    
}

function get_CategoryIPDetails_ForSSID_GET(sub_cat_id,offset){
    if(sub_cat_id != 0 ){
        $.ajax(
            {
                type: "POST",
                url: site_url + "/customer_controller/displayCategoryIPDetail/"+offset,
                data: "sub_cat_id="+ sub_cat_id + "&offset="+offset,
                async: false,
                success:function(msg){
                    $.facebox(msg);
//                    alert(msg);

                },
                error: function(msg){
                    alert(msg);
                }

            }
        );
    }
    else alert("Please select a SSID");
}


//Assign category_IP addresese to customers
function add_CategoryIP_to_Customer(){
//    alert(get_CheckedValues());

oTable = $('#dt_customer2').dataTable();
    var  checked = new Array();
        $('input[@name=row_sel]:checked', oTable.fnGetNodes()).closest('tr').each( function (i) {
                    checked[i] = $(this).attr('id');

    });
    $.ajax(
        {
            type: "POST",
            url: site_url + "/customer_controller/addCategoryIPDetail",
            data: "checked_values="+ checked +"&customer="+$('#custName').val()+"&custservid="+$('#LinkService').val(),
            async: false,
            success:function(msgg){
                $('#facebox').fadeOut();
                if(msgg != 0){
                    document.getElementById('table_service_ip').style.display = '';
                    $('#table_service_ip').html(msgg);
                }
                else
                    alert("Error");
            },
            error: function(msg){
                alert(msg);
            }

        }
    );
}

function displayCategoryIPTable(){
    document.getElementById('table_service_ip').style.display = '';
    $.ajax({
        type: "POST",
        url: site_url + "/customer_controller/displayCategoryIPTable",
        data: "custservid="+ $('#LinkService').val() + "&cust_id=" + $('#custName').val() + "&enddate=" +$('#display_EndDate').val(),
        async: false,
        success:function(msg){
            $('#table_service_ip').html(msg);
            //                    alert(msg);

        },
        error: function(msg){
            alert(msg);
        }
    });
}

function delete_AssignedCategoryIP(id,trid){
    var r = confirm("  Do you really want to remove the assigned Service IP Address \?");
    if(r==true){
        $.ajax
            (
                {
                    type:"POST",
                    url: site_url+"/customer_controller/deleteAssignedCategoryIP",
                    data: "ip_id=" + id,
                    async:false,
                    success: function(msg){
                        if(msg == 1){
                            alert("Assigned Service IP Deleted");
                            document.getElementById("categoryip"+trid).style.display = 'none';
                        }
                        else
                            alert('Error');
                    },
                    error: function(msg){
                        alert(msg);
                    }
                }
            );

    }
}

function delete_AlreadyAssignedCategoryIP(id,trid){
    var r = confirm("  You are About to Delete an IP Address Which was assigned Previously\n\nDo you really want to remove the Previously assigned Service IP Address \?");
    if(r==true){
        var q = prompt("Leave Remarks:");
        $.ajax
            (
                {
                    type:"POST",
                    url: site_url +"/customer_controller/deleteAlreadyAssignedCategoryIP",
                    data: "ip_id=" + id + "&remark="+ q,
                    async:false,
                    success: function(msg){
                        if(msg == 1){
                            alert("Previously Assigned Service IP Deleted");
                            document.getElementById("categoryip"+trid).style.display = 'none';
                        }
                        else
                            alert('Error');
                    },
                    error: function(msg){
                        alert(msg);
                    }
                }
            );

    }
}
//function delete_AlreadyAssignedCategoryIP(id,trid){
//    var r = confirm("  You are About to Delete an IP Address Which was assigned Previously\n\nDo you really want to remove the Previously assigned Service IP Address \?");
//    if(r==true){
//        $.ajax
//            (
//                {
//                    type:"POST",
//                    url: site_url+"/customer_controller/deleteAlreadyAssignedCategoryIP",
//                    data: "ip_id=" + id,
//                    async:false,
//                    success: function(msg){
////                        if(msg == 1){
////                            alert("Previously Assigned Service IP Deleted");
////                            document.getElementById("categoryip"+trid).style.display = 'none';
////                        }
////                        else
////                            alert('Error');
//alert(msg);
//                    },
//                    error: function(msg){
//                        alert(msg);
//                    }
//                }
//            );
//
//    }
//}

//Assign category_IP addresese to customers
function add_PrivateIP_to_Customer(){
if($('#txtPvtIP').val()=='' || $('#txtCIDR').val()=='')
    alert('Please enter a CIDR Address');
else if($('#txtCIDR').val()<0 || $('#txtCIDR').val()>32)
    alert('CIDR should be between 0 and 32');
else
    {
        $.ajax(
        {
            type: "POST",
            url: site_url + "/customer_controller/addPrivateIPDetail",
            data: "pvt_ip="+ $('#txtPvtIP').val()+"&cidr="+$('#txtCIDR').val()+"&customer="+$('#custName').val() + "&custservid=" + $('#LinkService').val(),
            async: false,
            success:function(msg){
//                alert(msg);
                var temp = new Array();
                temp = msg.split('||');

                if(msg == 0)
                    alert('Invalid IP Address');
                else if(msg == 1)
                    alert('Invalid IP Block');
                else if(msg == 2)
                    alert("Reserved IPs");
                else if(temp[0] == 3)
                    $.facebox(temp[1]);
                else if(msg==4)
                    alert('Error while assigning');
                else {
                    document.getElementById('txtPvtIP').value = "";
                    document.getElementById('txtCIDR').value = "";
                    document.getElementById('table_private_ip').style.display = '';
                    $('#table_private_ip').html(msg);
                }
               
                
            },
            error: function(msg){
                alert(msg);
            }

        }
    );
    }
}

function display_addPvtIP(){
    if($('#custName').val() != 0 && $('#LinkService').val() !=0){
        if(document.getElementById('checkbox_pvtip').checked == true){
            document.getElementById('add_private_ip').style.display = "";
            document.getElementById('add_privateip').style.display = "";
        }
        else{
            document.getElementById('add_private_ip').style.display = "none";
            document.getElementById('add_privateip').style.display = "none";
        }
    }
}

function displayPvtIpTable(){
    document.getElementById('table_private_ip').style.display = '';
    $.ajax({
        type: "POST",
        url: site_url + "/customer_controller/displayPvtIpTable",
        data: "custservid="+ $('#LinkService').val() + "&cust_id=" + $('#custName').val() + "&enddate=" +$('#display_EndDate').val() ,
        async: false,
        success:function(msg){
            $('#table_private_ip').html(msg);
        },
        error: function(msg){
            alert(msg);
        }
    });
}

function delete_AssignedPrivateIP(id,trid){
    var r = confirm("  Do you really want to remove the assigned Private IP Address Block \?");
    if(r==true){
        $.ajax
            (
                {
                    type:"POST",
                    url: site_url+"/customer_controller/deleteAssignedPvtIP",
                    data: "pvt_ip_id=" + id,
                    async:false,
                    success: function(msg){
                        if(msg == 1){
                            alert("Assigned Private IP Deleted");
                            document.getElementById("pvtip"+trid).style.display = 'none';
                        }
                        else
                            alert('Error');
                    },
                    error: function(msg){
                        alert(msg);
                    }
                }
            );

    }
}

function add_Temp_Customer(){
    if($('#txtCustomer').val() != "" || $('#txtAddress').val() !="" ||$('#txtBW').val()!= "" ||$('#txtEndDate').val()!= "" ){
    var r = confirm("Confirm add New Temporary Customer: \n\n\t Customer\t:"+$('#txtCustomer').val()+"\n\t Address\t:"+$('#txtAddress').val()+"\n\t Bandwidth\t:"+$('#txtBW').val()+"\n\t Connection\t:"+ $('#txtConn').val()+" \n");
    if(r==true){
        $.ajax
            (
                {
                    type:"POST",
                    url: site_url+"/customer_controller/saveTempCustomer",
                    data: "cust=" + $('#txtCustomer').val()+"&add="+$('#txtAddress').val()+"&conn="+$('#txtConn').val()+"&bw="+$('#txtBW').val()+"&end_date="+$('#txtEndDate').val(),
                    async:false,
                    success: function(msg){
                        if(msg == 0)
                            alert('Error\n# Temporary Customer Name already Exists.!\n');
                        else if(msg == 2)
                            alert('Error\n# Check End Date for Temporary Connection.!\n');
                        else{
                            alert("Temporary Customer "+$('#txtCustomer').val()+' added...!!!');
                            document.getElementById("temp_cust_detail").style.display = '';
                            document.getElementById("table_customer_detail").style.display = '';
                            document.getElementById("customer_add").style.display = 'none';
                            document.getElementById("txtCustomer").value = '';
                            document.getElementById("txtAddress").value = '';
                            document.getElementById("txtBW").value = '';
                            document.getElementById("txtConn").value = '';
                            document.getElementById("txtEndDate").value = '';


                            $('#table_customer_detail').html(msg);

                        }

                    },
                    error: function(msg){
                        alert(msg);
                    }
                }
            );

    }
    }else alert("Check the Inputs");

}

function edit_Temp_Customer(){

    window.location.href = site_url+'/customer_controller/editTempCustomer/'+ $("#custName option:selected").val();

//alert($("#custName option:selected").val());
}

function remove_Temp_Customer(){
//    alert($('#custName').val());
    alert("You are about to Delete both Temporary Allocation Details and ASsigned IP values");
    var r = confirm("  Do you really want to remove the Temporary Allocation Customer IPs and Details \?");
    if(r==true){
        $.ajax
            (
                {
                    type:"POST",
                    url: site_url+"/customer_controller/deleteTempCustomer",
                    data: "cust_id=" + $('#custName').val(),
                    async:false,
                    success: function(msg){
                        if(msg == 1){
                            alert("Temporary Allocation is Deleted");
//                            document.getElementById("pvtip"+trid).style.display = 'none';
//                            history.go(0);
                            setTimeout("location.href = site_url+'/customer_controller/viewTempCustomer';", 100);


                        }
                        else
                            alert('Error');
                    },
                    error: function(msg){
                        alert(msg);
                    }
                }
            );

    }
}


/*************functions written for crm customers******************/
 function get_LinkServiceDetails(id){
    if(typeof id == 'undefined')
       $('#edit_cust').hide();
   
   else if(id !=0){
    $('#temp2').show();
    $.ajax
        (
            {
                type:"POST",
                url: site_url+"/customer_controller/displayLinkServiceDetails",
                data: "custserv_id="+ id +"&cust_id=" +$('#custName').val(),
                async:false,
                success: function(msg){
                    $('#temp2').html(msg);
                    $('#edit_cust').show();
                    displayNodeIpTable();
                    displayCategoryIPTable();
                    displayPvtIpTable();
                    displayEndDate(id);
                },
                error: function(msg){
                    alert(msg);
                }
            }
        );
    }
    else{
        $('#temp2').hide();
        history.go(0);
   }
 }

/*************functions written for crm customers******************/
// to edit the Customer Allocatoin Details in Add New Customer Page
function open_Edit_Customer(){
    
    
   window.location = site_url+'/customer_controller/addNewCustomer/'+ $('#custName').val()+'/'+$('#LinkService').val();
}