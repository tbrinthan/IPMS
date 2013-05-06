/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function node_usage(){

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
        "iDisplayLength": 5,
        "aLengthMenu":  [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
        "bProcessing": true,
        "bServerSide": true,
        "sScrollX": "100%",
        "sScrollY": "300px",
        "bScrollCollapse":true,
        "sAjaxSource":site_url+"/usage_controller/node_datatable",
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


function openchart(id){
    $.post(site_url+'/usage_controller/openchart',{ pool_id:id},
        function(msg){
    $.facebox(msg);
    });
}

function readImage(){
  var window_dimensions = "height=148px,width=335px,toolbars=no,menubar=no,location=no,scrollbars=yes,resizable=yes,status=yes" ; 
  window.open(base_url+"admin_resources/images/colors_percent/percent.png","_blank",window_dimensions);
}

