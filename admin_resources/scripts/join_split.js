//var site_url="http://localhost/IPMS_ver_1/index.php/";

var oTable1,oTable2,oTable3;

function node_table(){

    document.getElementById('node_blocks').style.display='';
    document.getElementById('category_blocks').style.display='none';
    document.getElementById('primary_blocks').style.display='none';

    oTable1 = $('#node_records').dataTable(
    {
        //                "fnDrawCallback": function() {
        //                    $.facebox($("#read"));
        //                },
        "bJQueryUI": true,
        "bRetrieve":true,
        "sPaginationType":'full_numbers',
        "iDisplayLength": 8,
        "aLengthMenu":  [[8,16, 32, 64,128, -1], [8,16, 32, 64,128, "All"]],
        "bProcessing": true,
        "bServerSide": true,
        "sScrollX": "100%",
        "bScrollCollapse":true,
        "sAjaxSource":site_url+"/join_split_controller/node_datatable",
        "aoColumns": [
        {
            "sName": 'ip_id'
        },

        {
            "sName": 'ip_addresses'
        },

        {
            "sName": 'subnet'
        },

        {},{},

        {
            "sName": 'status'
        }
        ],
        "aoColumnDefs":[
        {
            "fnRender": function ( oObj ) {
                if(oObj.aData[5]==0)
                    return '<input style="width:40px" type="text" id="cidr'+oObj.aData[0]+'" name="cidr[]" placeholder="CIDR" />';
                else
                    return '<input  type="text" id="cidr'+oObj.aData[0]+'" name="cidr[]" placeholder="Allocated" disabled="disabled" style="width:65px" />';

            },
            "aTargets":[3]
        },
        {
            "fnRender": function ( oObj ) {
                //                        return '<input type="checkbox" name="checkbox[]" value="'+oObj.aData[0]+'" />' +
                //                            '<input type="button" value="subnet" name="subnet" onclick="subnet_nodes('+oObj.aData[0]+',\''+oObj.aData[1]+'\','+oObj.aData[2]+')">';
                if(oObj.aData[5]==0)
                    return    '<input type="button" value="subnet" name="subnet" onclick="subnet_nodes('+oObj.aData[0]+',\''+oObj.aData[1]+'\','+oObj.aData[2]+')">' +
                    '<input type="button" value="join" name="join" style="width: 65px;" onclick="join_nodes('+oObj.aData[0]+',\''+oObj.aData[1]+'\','+oObj.aData[2]+')">';
                else
                    return    '<input type="button" value="subnet" name="subnet" disabled="disabled">' +
                    '<input type="button" value="join" name="join" disabled="disabled" style="width: 65px;">';


            },
            "aTargets":[4]
        },
        {
            "fnRender": function ( oObj ) {
                       
                if(oObj.aData[5]==0)
                    return '<img src = "http://localhost/IPMS_ver_1/admin_resources/images/icons/available.png" title="Can Subnet" style="cursor:pointer;" onclick="javascript:alert(\'Not Assigned for Locations.\');"/>';
                else
                    return '<img src = "http://localhost/IPMS_ver_1/admin_resources/images/icons/notavailable.png" title="Cannot Subnet" style="cursor:pointer;" onclick="openLocatonDetails('+oObj.aData[0]+')"/>';

            },
            "aTargets":[5]
        }

        ],

        'fnServerData'   : function(sSource, aoData, fnCallback){
            $.ajax ({
                'dataType': 'json',
                'type'    : 'POST',
                'url'     : sSource,
                'data'    : aoData,
                'success' : fnCallback
            });
        }
    }

    );
    oTable1.fnDraw();

}


function category_table(){
    //alert('Hello');
    document.getElementById('node_blocks').style.display='none';
    document.getElementById('category_blocks').style.display='block';
    document.getElementById('primary_blocks').style.display='none';

    oTable2 = $('#category_records').dataTable(
    {
        //                "fnDrawCallback": function() {
        //                    $.facebox($("#read"));
        //                },
        "bJQueryUI": true,
        "bRetrieve":true,
        "sPaginationType":'full_numbers',
        "iDisplayLength": 8,
        "aLengthMenu":  [[8,16, 32, 64,128, -1], [8,16, 32, 64,128, "All"]],
        "sScrollX": "100%",
        "bScrollCollapse": true,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource":site_url+"/join_split_controller/category_datatable",
        "aoColumns": [
        {
            "sName": 'ip_id'
        },

        {
            "sName": 'category_name'
        },

        {
            "sName": 'ssid'
        },

        {
            "sName": 'ip_addresses'
        },

        {
            "sName": 'subnet'
        },

        {},

        {},

        {
            "sName": 'status'
        },

        {
            "sName": 'customer_id',
            "bVisible":false
        }

        ],
        "aoColumnDefs":[
        {
            "fnRender": function ( oObj ) {
                if(oObj.aData[7]==0)
                    return '<input style="width:40px" type="text" id="cidr'+oObj.aData[0]+'" name="cidr[]" placeholder="CIDR" />';
                else
                    return '<input style="width:65px" type="text" id="cidr'+oObj.aData[0]+'" name="cidr[]" placeholder="Allocated" disabled="disabled"/>';

            },
            "aTargets":[5]
        },
        {
            "fnRender": function ( oObj ) {
                //                        return '<input type="checkbox" name="checkbox[]" value="'+oObj.aData[0]+'" />' +
                //                            '<input type="button" value="subnet" name="subnet" onclick="subnet_nodes('+oObj.aData[0]+',\''+oObj.aData[1]+'\','+oObj.aData[2]+')">';
                if(oObj.aData[7]==0)
                    return    '<input type="button" value="subnet" name="subnet" onclick="subnet_category('+oObj.aData[0]+',\''+oObj.aData[3]+'\','+oObj.aData[4]+')">' +
                    '<input type="button" value="join" name="join" style="width: 65px" onclick="join_category('+oObj.aData[0]+',\''+oObj.aData[3]+'\','+oObj.aData[4]+')">';
                else
                    return    '<input type="button" value="subnet" name="subnet" disabled="disabled">' +
                    '<input type="button" value="join" name="subnet" style="width: 65px" disabled="disabled">';


            },
            "aTargets":[6]
        },
        {
            "fnRender": function ( oObj ) {
                if(oObj.aData[7]==0 && oObj.aData[8]==null)
                    return '<img src = "http://localhost/IPMS_ver_1/admin_resources/images/icons/available.png" title="Can Subnet" style="cursor:pointer;" onclick="openCategoryDetails('+oObj.aData[0]+')"/>';
                else
                    return '<img src = "http://localhost/IPMS_ver_1/admin_resources/images/icons/notavailable.png" title="Cannot Subnet" style="cursor:pointer;" onclick="openCategoryDetails('+oObj.aData[0]+')"/>';

            },
            "aTargets":[7]
        }

        ],

        'fnServerData'   : function(sSource, aoData, fnCallback){
            $.ajax ({
                'dataType': 'json',
                'type'    : 'POST',
                'url'     : sSource,
                'data'    : aoData,
                'success' : fnCallback
            });
        }
    }

    );
    oTable2.fnDraw();

}


function primary_table(){

    document.getElementById('node_blocks').style.display='none';
    document.getElementById('category_blocks').style.display='none';
    document.getElementById('primary_blocks').style.display='';

    oTable3= $('#primary_records').dataTable(
    {
        //                "fnDrawCallback": function() {
        //                    $.facebox($("#read"));
        //                },
        "bJQueryUI": true,
        "bRetrieve":true,
        "sPaginationType":'full_numbers',
        "iDisplayLength": 5,
        "aLengthMenu":  [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
        "bProcessing": true,
        "bServerSide": true,
        "sScrollX": "100%",
        "sScrollY": "300px",
        "bScrollCollapse":true,
        "sAjaxSource":site_url+"/join_split_controller/primary_datatable",
        "aoColumns": [
        {
            "sName": 'sub_pool_id'
        },

        {
            "sName": 'sub_pool_values'
        },

        {
            "sName": 'subnet'
        },

        {},{},

        {
            "sName": 'status'
        }
        ],
        "aoColumnDefs":[
        {
            "fnRender": function ( oObj ) {
                if(oObj.aData[5]==0)
                    return '<input style="width:40px" type="text" id="cidr'+oObj.aData[0]+'" name="cidr[]" placeholder="CIDR" />';
                else
                    return '<input  type="text" id="cidr'+oObj.aData[0]+'" name="cidr[]" placeholder="Allocated" disabled="disabled" style="width:65px" />';

            },
            "aTargets":[3]
        },
        {
            "fnRender": function ( oObj ) {
                //                        return '<input type="checkbox" name="checkbox[]" value="'+oObj.aData[0]+'" />' +
                //                            '<input type="button" value="subnet" name="subnet" onclick="subnet_nodes('+oObj.aData[0]+',\''+oObj.aData[1]+'\','+oObj.aData[2]+')">';
                if(oObj.aData[5]==0)
                    return '<input type="button" value="join" name="join" style="width: 65px;" onclick="join_primary('+oObj.aData[0]+',\''+oObj.aData[1]+'\','+oObj.aData[2]+')">';
                else
                    return '<input type="button" value="join" name="join" disabled="disabled" style="width: 65px;">';


            },
            "aTargets":[4]
        },
        {
            "fnRender": function ( oObj ) {

                if(oObj.aData[5]==0)
                    return '<img src = "http://localhost/IPMS_ver_1/admin_resources/images/icons/available.png" title="Can Subnet" style="cursor:pointer;" onclick="javascript:void(0);"/>';
                else
                    return '<img src = "http://localhost/IPMS_ver_1/admin_resources/images/icons/notavailable.png" title="Cannot Subnet" style="cursor:pointer;" onclick="alert(\'check alert\')" />';

            },
            "aTargets":[5]
        }

        ],

        'fnServerData'   : function(sSource, aoData, fnCallback){
            $.ajax ({
                'dataType': 'json',
                'type'    : 'POST',
                'url'     : sSource,
                'data'    : aoData,
                'success' : fnCallback
            });
        }
    }

    );
    oTable3.fnDraw();

}
//
//function test(){
//    alert('hello');
//    }


function subnet_nodes(id,ip_add,netbits){
    $( '#ajaxLoadAni' ).fadeIn( 'slow' );
    if($('#cidr'+id).val()==''){
        alert("Please Enter the subnet value.")
    }
    else if($('#cidr'+id).val() <= netbits || $('#cidr'+id).val()>32){
        alert("Subnet value should be greater than "+netbits+" and less than 32");
    }
    else{
        //        alert(id+' '+ip_add+' '+netbits+' '+$('#cidr'+id).val());
        var subnet=$('#cidr'+id).val();
        var answer=confirm("Do you really want to subnet "+ip_add+"/"+netbits+ " blocks into "+" /"+subnet+" blocks?",'\\nPlease Confirm');
        if(answer){

            $.post(site_url+'/join_split_controller/node_subnet',{
                id:id,
                ip_add:ip_add,
                netbits:netbits,
                subnet:subnet
            },
            function(msg){
                $('#ajaxLoadAni').fadeOut( 'slow' );
                alert(msg);
                oTable1.fnDraw();
            });

        }

    }
    
}

function join_nodes(id,ip_add,netbits){
    if($('#cidr'+id).val()==''){
        alert("Please Enter the join as value.")
    }
    else if($('#cidr'+id).val() >= netbits || $('#cidr'+id).val()<24){
        alert("Join value should be less than "+netbits+" and greater than 24");
    }
    else{
        // alert(id+' '+ip_add+' '+netbits+' '+$('#cidr'+id).val());
        var join=$('#cidr'+id).val();
        var answer=confirm("Do you really want to Join "+ip_add+"/"+netbits+ " block as "+" /"+join+" blocks?");
        if(answer){

            $.post(site_url+'/join_split_controller/node_join',{
                id:id,
                ip_add:ip_add,
                netbits:netbits,
                join:join
            },
            function(msg){
                // alert(msg);
                $.facebox(msg);
                oTable1.fnDraw();
            });

        }else{}

    }
}



function subnet_category(id,ip_add,netbits){
    if($('#cidr'+id).val()==''){
        alert("Please Enter the subnet value.")
    }
    else if($('#cidr'+id).val() <= netbits || $('#cidr'+id).val()>32){
        alert("Subnet value should be greater than "+netbits+" and less than 32");
    }
    else{
        //        alert(id+' '+ip_add+' '+netbits+' '+$('#cidr'+id).val());
        var subnet=$('#cidr'+id).val();
        var answer=confirm("Do you really want to subnet "+ip_add+"/"+netbits+ " blocks into "+" /"+subnet+" blocks?",'\\nPlease Confirm');
        if(answer){

            $.post(site_url+'/join_split_controller/category_subnet',{
                id:id,
                ip_add:ip_add,
                netbits:netbits,
                subnet:subnet
            },
            function(msg){
                alert(msg);
                oTable2.fnDraw();
            });

        }

    }
    
}

function join_category(id,ip_add,netbits){
    if($('#cidr'+id).val()==''){
        alert("Please Enter the join as value.")
    }
    else if($('#cidr'+id).val() >= netbits || $('#cidr'+id).val()<24){
        alert("Join value should be less than "+netbits+" and greater than 24");
    }
    else{
        // alert(id+' '+ip_add+' '+netbits+' '+$('#cidr'+id).val());
        var join=$('#cidr'+id).val();
        var answer=confirm("Do you really want to Join "+ip_add+"/"+netbits+ " block as "+" /"+join+" blocks?");
        if(answer){

            $.post(site_url+'/join_split_controller/category_join',{
                id:id,
                ip_add:ip_add,
                netbits:netbits,
                join:join
            },
            function(msg){
                // alert(msg);
                $.facebox(msg);
                oTable2.fnDraw();
            });

        }else{}

    }
}

function join_primary(id,ip_add,netbits){
    if($('#cidr'+id).val()==''){
        alert("Please Enter the join as value.")
    }
    else if($('#cidr'+id).val() >= netbits || $('#cidr'+id).val()<24){
        alert("Join value should be less than "+netbits+" and greater than 24");
    }
    else{
        // alert(id+' '+ip_add+' '+netbits+' '+$('#cidr'+id).val());
        var join=$('#cidr'+id).val();
        var answer=confirm("Do you really want to Join "+ip_add+"/"+netbits+ " block as "+" /"+join+" blocks?");
        if(answer){

            $.post(site_url+'/join_split_controller/primary_join',{
                id:id,
                ip_add:ip_add,
                netbits:netbits,
                join:join
            },
            function(msg){
                // alert(msg);
                $.facebox(msg);
                oTable3.fnDraw();
            });

        }else{}

    }
}



function openLocatonDetails(id){
    $.post(site_url + "/join_split_controller/open_location_details", {
        id:id
    },
    function(msg){
        if(msg==0){
            alert('Error occured!!');
        }
        else
            $.facebox(msg);
    });
//alert(id);
}
