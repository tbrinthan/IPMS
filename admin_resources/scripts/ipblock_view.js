/**
 * Created with JetBrains PhpStorm.
 * User: root
 * Date: 7/26/12
 * Time: 2:38 PM
 * To change this template use File | Settings | File Templates.
 */

//var site_url="http://localhost/IPMS_ver_1/index.php/";

function viewSubcategory(id){

   if(id==1){
        if($('#checkbox1').is(':checked')) {
            document.getElementById("checkbox1").checked=false;
            document.getElementById("node_button").style.display='block';
        }

        document.getElementById("check1").style.display= 'block';
        document.getElementById("hide").style.display= 'none';
        document.getElementById("nodelocation_table").style.display= 'none';
        document.getElementById("category_table").style.display= 'none';


//        $(".hide").hide();
    }
   else if (id == 0 ){
       document.getElementById("nodeip_table").style.display='none';
       document.getElementById("nodelocation_table").style.display='none';
       document.getElementById("category_table").style.display='none';
       document.getElementById("check1").style.display='none';
       document.getElementById("hide").style.display='none';


   }
    else {
        document.getElementById("check1").style.display= 'none';
        document.getElementById("hide").style.display= 'block';
        document.getElementById("nodeip_table").style.display='none';
       $.ajax(
            {
                type: "POST",
                url: site_url + "/ipblock_controller/get_subcategoryforview",
                data: "cat_id=" + $('#category').val()+"&subcatt_id="+ $('#subcatt_id').val(),
                async:false,
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


function view_checkbox(id){
    if($('#checkbox1').is(':checked')) {
//        alert($('#checkbox1').val());
        document.getElementById("hide").style.display= '';
        document.getElementById("node_button").style.display='none';
        document.getElementById("nodeip_table").style.display='none';

        $.ajax(
            {
                type: "POST",
                url: site_url + "/ipblock_controller/get_subcategoryforview",
                data: "cat_id=" + $('#checkbox1').val()+"&subcatt_id="+ $('#subcatt_id').val(),
                async:false,
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
        viewSubcategory(id);
        document.getElementById("node_button").style.display='block';

    }
//    $('#checkbox1').toggle();
}


function getIds(){
    var cat_id=$('#category').val();
    var subcat_id=$('#subcategory').val();
    return [cat_id,subcat_id];
}



function viewAssignedNodeblock(){
   
    document.getElementById("nodeip_table").style.display= 'block';
    document.getElementById("category_table").style.display= 'none';
    viewAssignedNodeblock_pagination(0);

}

//function viewAssignedNodeblock_pagination(offset){
//
//    if (window.XMLHttpRequest)
//    {// code for IE7+, Firefox, Chrome, Opera, Safari
//        xmlhttp=new XMLHttpRequest();
//    }
//    else
//    {// code for IE6, IE5
//        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
//    }
//    xmlhttp.onreadystatechange=function()
//    {
//        if (xmlhttp.readyState==4 && xmlhttp.status==200)
//        {
////            document.getElementById("nodeip_table").style.display= 'block';
//            document.getElementById("nodeip_table").innerHTML=xmlhttp.responseText;
//        }
//    }
//    xmlhttp.open("GET",site_url+"/ipblock_controller/test/" + offset,true);
//    xmlhttp.send();
//
//}

function viewAssignedNodeblock_pagination(offset){
    
    $.ajax(
        {
            type: "POST",
            url: site_url + "/ipblock_controller/view_assigned_nodeblocks/"+offset,
            success: function(msg){
//                alert(msg);
                
              $('#nodeip_table').html(msg);
                simpla_datatable.dt2();
                simpla_datatable.dt_actions_fb();

            },
            error: function(msg){
                alert(msg);
            }
        }
    );
}
function viewAssignedIpblock(){
 
   var cat_id=$('#category').val();
   var subcat_id=$('#subcategory').val();
    if(cat_id==0){
        alert('select a category');
    }
    else if(cat_id==1 && subcat_id==0){
        alert('select a location');
    }else if(cat_id==1 && subcat_id!=0) {
//        alert(ids[1]);
        $.ajax(
            {
                type: "POST",
                url: site_url + "/ipblock_controller/view_assigned_ipblocks/",
                data: "cat_id=" +$('#category').val()+ "&subcat_id=" + $('#subcategory').val(),
                success: function(msg){
                    document.getElementById("category_table").style.display= 'none';
                    document.getElementById("nodelocation_table").style.display= 'block';
                simpla_datatable.dt2();
                simpla_datatable.dt_actions_fb();
                viewAssignedlocationblock_pagination(cat_id,subcat_id,0);   
                }
            }
        );
    }
    else if(cat_id!=1){
        $.ajax(
            {
                type: "POST",
                url: site_url + "/ipblock_controller/view_assigned_ipblocks/",
                data: "cat_id=" +$('#category').val()+ "&subcat_id=" + $('#subcategory').val(),
                success: function(msg){
                    document.getElementById("nodelocation_table").style.display= 'none';
                    document.getElementById("category_table").style.display= 'block';
                    viewAssignedcategoryblock_pagination(cat_id,subcat_id,0);
                }
            }
        );
//        alert('hi');
    }

//    alert("cat_id="+$('#category').val()+" subcat_id="+$('#subcategory').val());
}

function viewAssignedlocationblock_pagination(cat_id,subcat_id,offset){

    $.ajax(
        {
            type: "POST",
            url: site_url + "/ipblock_controller/view_assigned_ipblocks/"+offset,
            data: "offset="+offset+"&cat_id=" +cat_id + "&subcat_id=" +subcat_id,
            success: function(msg){
//                alert(msg);
                
               $('#nodelocation_table').html(msg);
               simpla_datatable.dt2();
               simpla_datatable.dt_actions_fb();
            },
            error: function(msg){
                alert(msg);
            }
        }
    );
//    alert('hi');
}
function viewAssignedcategoryblock_pagination(cat_id,subcat_id,offset){

    $.ajax(
        {
            type: "POST",
            url: site_url + "/ipblock_controller/view_assigned_ipblocks/"+offset,
            data: "offset="+offset+"&cat_id=" +cat_id + "&subcat_id=" +subcat_id,
            success: function(msg){
//                alert(msg);


                $('#category_table').html(msg);
                simpla_datatable.dt2();
                simpla_datatable.dt_actions_fb();
            },
            error: function(msg){
                alert(msg);
            }
        }
    );
//    alert('hi');
}
function openNodeDetails(id){
    $.ajax
        (
            {
                type:"POST",
                url: site_url+"/ipblock_controller/open_node_details/",
                data: "nodeip_id=" + id,
                async:false,
                success: function(msg){
                    if(msg!=0)
                    $.facebox(msg);
                    else alert('Node blocks are not assigned for location!');

                },
                error: function(msg){
                    alert(msg);
                }
            }
        );
//    alert('hi');
}

function openNodeDetails_pagination(nodeip_id,offset){
//    alert(offset+"  "+nodeip_id);
    $.ajax
        (
            {
                type:"POST",
                url: site_url+"/ipblock_controller/open_node_details/"+offset,
                data: "offset=" + offset +"&nodeip_id=" + nodeip_id,
                async:false,
                success: function(msg){
                    $.facebox( msg);
                },
                error: function ( msg) {
                    alert(msg+" "+nodeip_id+" "+offset);
                }
            }
        );

}

function openCategoryDetails(id){
//$.facebox(id);
//alert(id);
    $.ajax
        (
            {
                type:"POST",
                url: site_url +"/ipblock_controller/open_category_details",
                data:"ip_id="+id,
                success: function(msg){
//                    $.facebox(msg);
                    if(msg!=0){
                        $.facebox(msg);
                    }
                    else{
                        alert('Customer not Assigned!');
                    }

                }
            }
        );
}

function editNodeDetails(id){
    $.ajax
        (
            {
                type:"POST",
                url: site_url +"/ipblock_controller/edit_nodeblocks/",
                data:"ip_id="+id,
                success: function(msg){
                    if(msg==0){
                        alert("can't edit or delete!");
                    }else alert('can delete');
                }
            }
        );
}

function deleteNodeDetails(id,trid){
    
    var   post_url  = site_url+"/ipblock_controller/delete_nodeblocks/" ;
    var dataURL = "ip_id=" +id;

    var answer=confirm("Are you sure want to Remove ",'Please Confirm');
    if(answer){
        $.ajax({
            type: "POST",
            url: post_url,
            data: dataURL,
            async: false,
            success: function(msg){
                if(msg==2){
                    alert("Cannot Delete");
                }
                else if(msg==0){
                    alert("Blocks are removed!");
                    document.getElementById(trid).style.display='none';                   
                }
                else if(msg==1){
                    alert("Assigned Location and SSID removed!");
                    if($('#category').val()==1 && $('#subcategory').val()==''){
                     document.getElementById("node_button").click();
                    }else if($('#category').val()==1 && $('#subcategory').val()!=''){
                     document.getElementById(trid).style.display='none';
                    }

                }
//                    $(#trid).fadeOut();
            },
            error: function(msg){
                alert(msg);
            }
        });

    }else{}

//    alert("category value="+$('#category').val()+"sub category value="+$('#subcategory').val());

}


function deleteCategoryDetails(id){
    var trid=id;
    var   post_url  = site_url+"/ipblock_controller/delete_categoryblocks/" ;
    var dataURL = "ip_id=" +id ;
    var answer=confirm("Are you sure want to Remove Category",'Please Confirm');
    if(answer){
        $.ajax({
            type: "POST",
            url: post_url,
            data: dataURL,
            async: false,
            success: function(msg){
//                alert(msg);
                if(msg==1){
                        alert('Assigned Category removed!');
                        document.getElementById(id).style.opacity=0; 
                        setTimeout(function(){document.getElementById(id).style.display = 'none'},300);
//                        document.getElementById(trid).style.display='none';
                }if(msg==2) alert('Error while deleting!!');
            },
            error: function(msg){
                alert(msg);
            }
        });
    }

}


function resetForm(){
    document.getElementById("ipblockform").reset();
}