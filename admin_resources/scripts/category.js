/**
 * Category -> Javascript file
 * Contains functions to ajax call Save,add, modify categories, subcategories
 */
//var base_url = "http://localhost/IPMS_ver_1/index.php/";

//Add category/Subcategory  Names & details
function add_category(){
//    alert(($('#category').val()));
        //If Add New Category is selected
    var string = encodeURIComponent('+'); // "%2B"

    if(($('#category').val())== 0 && ( jQuery.trim($('#txtCategory').val())== '')){ //for the category input only
        $("#error_add_category").html("<div class='input-notification error png_bg'>Please fill Category...!!!</div> ");
        resetForm();
    }
       //If category->Node is selected check subcategory & Location
    else if(($('#category').val())== 1 && ( jQuery.trim($('#txtSubCategory').val().replace("+",string))== ''|| ($('#txtLocation').val())== 0)){ //for node
        $("#error_add_category").html("<div class='input-notification error png_bg'>Please fill the Mandatory fields...</div> ");
        resetForm();
    }
    //If categories other than Node is selected
    else if((($('#category').val())>1)  && ( jQuery.trim($('#txtSubCategory').val().replace("+",string))== '')){
        $("#error_add_category").html("<div class='input-notification error png_bg'>Please fill Sub Category...!!!</div> ");
        resetForm();
    }
    //If cat->node add ssid
    else if((($('#category').val())== 1)&&(( jQuery.trim($('#txtSubCategory').val().replace("+",string))!= '') && ( ($('#txtLocation').val()) != 0))){
        $("#error_add_category").html("<div class='input-notification error png_bg'>Validating...!!!</div> ");
       $.ajax
            (
                {
                    type:"POST",
                    url: site_url+"/category/saveSubCategory",
                    data: "cat_id="+($('#category').val())+"&cat_name="+($('#txtCategory').val())+"&subcat_name="+($('#txtSubCategory').val().replace("+",string))+"&location="+($('#txtLocation').val()),
                    async:false,
                    success: function(msg){
                        if(msg==1){
                            alert("New Node - SSID added!!!");
                            $("#error_add_category").html("<div class='input-notification success png_bg'>SSID details Successfully Added.....</div>");
                            setTimeout("location.href = site_url+'/category/addCategory';", 100);
                        }
                        else {
                            $("#error_add_category").html("<div class='input-notification error png_bg'>SSID already Exists...!!!</div>");
                            alert('SSID already Exists!!!');

                        }

                    },
                    error: function(msg){
                        alert(msg);
                    }
                }
            );
            resetForm();history.go(0);
        }
    //other than node->sside added
    else if((($('#category').val())> 1)&&( jQuery.trim($('#txtSubCategory').val().replace("+",string))!= '' &&  ($('#txtLocation').val()) == 0 )){
        $.ajax
            (
                {
                    type:"POST",
                    url: site_url+"/category/saveSubCategory",
                    data: "cat_id="+($('#category').val())+"&cat_name="+($('#txtCategory').val())+"&subcat_name="+($('#txtSubCategory').val().replace("+",string))+"&location="+ null,
                    async:false,
                    success: function(msg){
                        if(msg==1){
                            alert("New SSID added!!!");
                            $("#error_add_category").html("<div class='input-notification success png_bg'>SSID details Successfully Added.....</div>");
                            setTimeout("location.href = site_url+'/category/addCategory';", 100);
                        }
                        else {
                            $("#error_add_category").html("<div class='input-notification error png_bg'>SSID already Exists...!!!</div>");
                            alert('SSID already Exists!!!');

                        }

                    },
                    error: function(msg){
                        alert(msg);
                    }
                }
            );
        resetForm();history.go(0);
        }
    else if (($('#category').val())== 0 && (( jQuery.trim($('#txtCategory').val())!= '') &&( jQuery.trim($('#txtSubCategory').val().replace("+",string))== '') && ($('#txtLocation').val())== 0 ) ){
       $("#error_add_category").html("<div class='input-notification error png_bg'>Validating...!!!</div> ");

       $.ajax
        (
            {
            type:"POST",
            url: site_url+"/category/saveCategory",
            data: "cat_id="+($('#category').val())+"&cat_name="+($('#txtCategory').val()),
                async: false,
                success: function(msg){

                if(msg==1){
                    alert("New Category added!!!");
                    $("#error_add_category").html("<div class='input-notification success png_bg'>Category Details Successfully Added.....</div>");
                    setTimeout("location.href = site_url+'/category/addCategory';", 100);
                }
                    else
                       alert("Category already Exists!!!");

                    },
                error: function(msg){
                    alert(msg);
                    }
            }
        );
       $("#error_add_category").html("<div class='input-notification success png_bg'>Done...!!!</div> ");
        resetForm(); history.go(0);
   }
    else {
        alert("Refresh page and Try again!!!");
        resetForm();
        history.go(0);    }

}
//Reset category addition form
function resetForm(){
    document.getElementById("categoryform").reset();
}

//delete category Names
function delete_Category(id,trid){
    var r = confirm("Do you really want to delete the Category");
    if(r==true){
    $.ajax
        (
            {
                type:"POST",
                url: site_url+"/category/deleteCategory",
                data: "cat_id="+id,
                success: function(msg){
                    if(msg==1){
                        alert("Category is Deleted");
               //         document.getElementById(trid).style.display='none';
                        setTimeout("location.href = site_url+'/category/modifyCategory';", 10);
                    }
                    else
                    alert("Delete Subcategories first. And Try AGain !!!");


                },
                error: function(msg){
                    alert(msg);
                }
            }
        );
    }
}

//delete Sub category Names
function delete_SubCategory(subid,catid){
    var r = confirm("Do you really want to delete the SSID");
    if(r==true){
        $.ajax
            (
                {
                    type:"POST",
                    url: site_url+"/category/deleteSubCategory",
                    data: "cat_id="+catid+"&sub_cat_id="+subid,
                    success: function(msg){
                        if(msg != 0){
                            alert("SSID is Deleted");
                           //document.getElementById(subid).style.display='none';
                           setTimeout("location.href = site_url+'/category/modifyCategory';", 10);
                        }
                        else if(msg == 0)
                            alert("IPs are assigned to Subcategory.Delete them first and try again !!!");


                    },
                    error: function(msg){
                        alert(msg);
                    }
                }
            );
    }
}

//Update category Names
function update_category(catid){
    var r = confirm("Do you really want to rename Category");
    if(r==true){
        $.ajax
            (
                {
                    type:"POST",
                    url: site_url+"/category/updateCategory",
                    data: "cat_id="+catid+"&cat_name="+$('#txtCategory').val(),
                    success: function(msg){
                        if(msg==1){
                            alert("Category is Updated");
                            setTimeout("location.href = site_url+'/category/modifyCategory';", 10);
                        }
                        else
                            alert("I Don't Know... Try AGain !!!");


                    },
                    error: function(msg){
                        alert(msg);
                    }
                }
            );
    }

}

//Update Subcategory Names
function update_subcategory(subcatid){
    var string = encodeURIComponent('+'); // "%2B"

    var r = confirm("Do you really want to Update Changes");
    if(r==true){
        $.ajax
            (
                {
                    type:"POST",
                    url: site_url+"/category/updateSubCategory",
                    data: "sub_cat_id="+subcatid+"&ssid="+ $('#txtSubCategory').val().replace("+",string)+"&location="+$('#txtLocation').val(),
                    success: function(msg){
                        if(msg==1){
                            alert("SSID is Updated");
                            setTimeout("location.href = site_url+'/category/modifyCategory#tab2';", 10);
                        }
                        else
                            alert("I Don't Know... Try AGain !!!");


                    },
                    error: function(msg){
                        alert(msg);
                    }
                }
            );
    }

}

//If Node is selected -> Show Location & SSID inputs
function checkNode(catid){
//  alert(catid);
    if(catid == 1){
    document.getElementById('newlocation').style.display='';
    document.getElementById('newsubcategory').style.display='';
    }
    else{
    document.getElementById('newsubcategory').style.display='';
    document.getElementById('newlocation').style.display='none';
    }
}

//If Text input fields are onfocus -> Display input text fields according to Category
function checkOption(){
    if($('#category').val() == 0){
        document.getElementById('newcategory').style.display='';
        document.getElementById('newlocation').style.display='none';
        document.getElementById('newsubcategory').style.display='none';
    }
    else if($('#category').val() == 1){
        document.getElementById('newcategory').style.display='none';
        document.getElementById('newsubcategory').style.display='';
        document.getElementById('newlocation').style.display='';
    }
    else{
        document.getElementById('newcategory').style.display='none';
        document.getElementById('newsubcategory').style.display='';
        document.getElementById('newlocation').style.display='none';
    }
 }

//Add Node Location to the Location-Table
function add_NodeLocation(){
    $("#error_locationNode").html("<div class='input-notification error png_bg'>Validating..!!!</div>");

    $.ajax({
        type:"POST",
        url: site_url+"/category/addNodeLocation",
        data: "location="+ $('#txtLocationNode').val(),
        async:false,
        success: function(msg){
                if(msg==1){
                    alert('Location is Added!!!');
                    $("#error_locationNode").html("<div class='input-notification success png_bg'>Successful..!!!</div>");

                    resetNodeLocationForm();
                    document.location.reload(true);
//                    history.go(0);
                }
                else{
                    alert('Location Already Exists!!!');
                    resetNodeLocationForm();
                    $("#error_locationNode").html("<div></div>");


                }
        },
        error: function(msg){
            alert(msg);
        }

    });

}

//Reset Node Location Adding form
function resetNodeLocationForm(){
    document.getElementById("locationnodeform").reset();
}

//Get SSID details For a given Location details
function open_SSID_ForLocation(id){
    $.ajax({

        type:"POST",
        url: site_url+"/category/showLocationDetails",
        data: "location_id="+ id,
        async:false,
        success: function(msg){
            $.facebox(msg);

        },
        error: function(msg){
            alert(msg);
        }

    });
}

//Delete Location Value
function delete_Location(id,trid){
    var r = confirm("Do you really want to delete the Location");
    if(r==true){
        $.ajax
            (
                {
                    type:"POST",
                    url: site_url+"/category/deleteLocation",
                    data: "location_id="+id,
                    async:false,
                    success: function(msg){
                        if(msg==1){
                            alert("Location is Deleted");
                            document.getElementById(trid).style.display='none';
//                            setTimeout("location.href = site_url+'/category/addCategory';", 100);
                        }
                        else
                            alert("Delete Subcategories Assigned to Location first. And Try AGain !!!");


                    },
                    error: function(msg){
                        alert(msg);
                    }
                }
            );
    }
}

//Add Node Types
function add_NodeType(){
    $("#error_nodetype").html("<div class='input-notification error png_bg'>Validating..!!!</div>");

    $.ajax({
        type:"POST",
        url: site_url+"/category/addNodeType",
        data: "node_type="+ $('#txtNodeType').val(),
        async:false,
        success: function(msg){
            if(msg==1){
                alert('New NodeType is Added!!!');
                $("#error_nodetype").html("<div class='input-notification success png_bg'>Successful..!!!</div>");

                resetNodeTypeForm();
                document.location.reload(true);
//                    history.go(0);
            }
            else{
                alert('NodeType Already Exists!!!');
                resetNodeTypeForm();
                $("#error_nodetype").html("<div></div>");


            }
        },
        error: function(msg){
            alert(msg);
        }

    });

}

function resetNodeTypeForm(){
    document.getElementById("nodetypeform").reset();
}

//Delete Node Type Value
function delete_NodeType(id,trid){
    var r = confirm("Do you really want to delete the Node Type\?");
    if(r==true){
        $.ajax
            (
                {
                    type:"POST",
                    url: site_url+"/category/deleteNodeType",
                    data: "type_id="+id,
                    async:false,
                    success: function(msg){
                        if(msg==1){
                            alert("Node Type is Deleted");
                            document.getElementById("nodetype"+trid).style.display='none';
//                            setTimeout("location.href = site_url+'/category/addCategory';", 100);
                        }
                        else
                            alert("Error!\n\n Customers are assigned with those Node Types.");


                    },
                    error: function(msg){
                        alert(msg);
                    }
                }
            );
    }
}

