/**
 * Created with JetBrains PhpStorm.
 * User: root
 * Date: 8/28/12
 * Time: 5:28 PM
 * To change this template use File | Settings | File Templates.
 */
//var site_url = "http://localhost/IPMS_ver_1/index.php/";

function customer_records(id){
    
    if(id !=0){

        $.ajax
            (
                {
                    type:"POST",
                    url: site_url+"/records/customer_details",
                    data: "cust_id="+ id,
                    async:false,
                    success: function(msg){
                        var temp = new Array();
                        temp = msg.split('/||\\');
                        document.getElementById('customer').style.display = '';
                        $('#customer').html('Customer: '+$("#custName option:selected").text()+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Address: '+temp[3]);
                        document.getElementById('table_nodeip').style.display = 'none';
                        document.getElementById('table_category_ip').style.display = 'none';
                        document.getElementById('table_private_ip').style.display = 'none';

//                        if(msg.search("1")!=-1){
                        if(temp[0]=="1"){
                            document.getElementById('table_nodeip').style.display = 'block';
                            display_node_table(id);
                        }
//                        if(msg.search("2")!=-1){
                        if(temp[1]=="2"){
                            document.getElementById('table_category_ip').style.display = 'block';
                            display_category_table(id);
                        }
//                        if(msg.search("3")!=-1){
                        if(temp[2]=="3"){
                            document.getElementById('table_private_ip').style.display = 'block';
                            display_private_table(id);
                        }
//                        if(msg.search("1")==-1 && msg.search("2")==-1 && msg.search("3")==-1){
                        if(temp[0]!="1" && temp[1]!="2" && temp[2]!="3"){
                            document.getElementById('table_category_ip').style.display = 'block';
                            $('#table_category_ip').html("<p style='font-size: 1.2em;font-family: sans-serif;font-variant: small-caps'>IPs are not assigned for this customer.</p>");
                        }
                    },
                    error: function(msg){
                        alert(msg);
                    }
                }
            );
    }
    else{
        history.go(0);
    }
}

function display_node_table(id){
    $.post(site_url+'/records/node_table',{ cust_id:id},
        function(msg){
            $('#table_nodeip').html(msg);
        });
}

function display_category_table(id){
    $.post(site_url+'/records/category_table',{ cust_id:id},
        function(msg){
            $('#table_category_ip').html(msg);
        });
}

function display_private_table(id){
    $.post(site_url+'/records/private_table',{ cust_id:id},
        function(msg){
            $('#table_private_ip').html(msg);
        });
}

function ip_search(){

    document.getElementById('results').style.display="block";
    document.getElementById('results').style.overflowY="scroll";

    $('input#txtSearch').keyup(function(e){
        e.preventDefault();
        var $q = $(this);

        if($q.val() == ''){
            $('div#results').html('');
            return false;
        }

        else{

            $.ajax(
                {
                    type:"POST",
                    url: site_url+"/records/ipBlockSearch",
                    data: "search=" + $q.val(),
                    success: function(data){
                        document.getElementById('results').style.height="200px";
                        $('div#results').html(data);
                    },
                    error: function(msg){
                        alert(msg);
                    }
                }

            );

        }

        $('#cusrecords').submit(function(e){
            e.preventDefault();
        });

    });
    $('input#txtSearch').keydown(function(){
    document.getElementById('results').style.height="";
    });
}

function print_records(printarea) {
    var printThis =  document.getElementById(printarea).innerHTML;
    var win = window.open();
    self.focus();
    win.document.open();
    win.document.write('<'+'html'+'><'+'body'+'>');
    win.document.write(printThis);
    win.document.write('<'+'/body'+'><'+'/html'+'>');
    win.document.close();
    win.print();
    win.close();
}
