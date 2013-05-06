/**
 * Date         User    Details
 * 22-Aug-12    Brinth  initialize Search.js
 */
//var site_url = "http://localhost/IPMS_ver_1/index.php/";


//function customer_Search(){
//    document.getElementById('results_cat').style.display="none";
//    document.getElementById('results_ipblk').style.display="none";
//    document.getElementById('results').style.display="block";
//
//    $("#custsearch").addClass("selected-on");
//    $("#ipblksearch").removeClass("selected-on");
//    $("#catsearch").removeClass("selected-on");
//
//$('input#txtSearch').keyup(function(e){
//    e.preventDefault();
//    var $q = $(this);
//
//    if($q.val() == ''){
//    $('div#results').html('');
//    return false;
//    }
//
//else{
//        var string = encodeURIComponent('+'); // "%2B"
//        $q = $q.val().replace("+",string);
//    $.ajax(
//            {
//                type:"POST",
//                url: base_url+"search_controller/customerSearch",
//                data: "search=" + $q,
//                success: function(data){
//                var msg = eval('(' + data + ')');
//
//                  var resultHtml = '';
//                    resultHtml+='<div class="result">';
//                    resultHtml+= '<ul class="search-results">';
//                    $.each(msg,function(i,item){
//                            resultHtml+= '<li>';
//                            if(item.end_date == null){
//                            resultHtml+='<h2><a href='+base_url+'customer_controller/viewCustomer/'+item.customer_id+'>'+item.customer_name+'</a></h2>';
//                        }
//                        else{
//                            resultHtml+='<h2><a href='+base_url+'customer_controller/viewTempCustomer/'+item.customer_id+'>'+item.customer_name+'</a></h2>';
//                        }
//                        resultHtml+='<p>'+item.address.replace($q, '<span class="highlight">'+ $q+'</span>')+'</p>';
//                        resultHtml+='<a href="#" class="readMore">Read more..</a>';
//                        resultHtml+= '</li>';
//                        }
//                    );
//                    resultHtml+='</ul>';
//                    resultHtml+='</div>';
//
//                    $('div#results').html(resultHtml);
//                },
//                error: function(msg){
//                    alert(msg);
//                }
//            }
//
//           );
//
//    }
//
//$('#searchform').submit(function(e){
//    e.preventDefault();
//    });
//});
//}

// editted for crm customers
function customer_Search(){
    document.getElementById('results_cat').style.display="none";
    document.getElementById('results_ipblk').style.display="none";
    document.getElementById('results').style.display="block";

    $("#custsearch").addClass("selected-on");
    $("#ipblksearch").removeClass("selected-on");
    $("#catsearch").removeClass("selected-on");

$('input#txtSearch').keyup(function(e){
    e.preventDefault();
    var $q = $(this);

    if($q.val() == ''){
    $('div#results').html('');
    return false;
    }

else{
        var string = encodeURIComponent('+'); // "%2B"
        $q = $q.val().replace("+",string);
        
               $.ajax(
                {
                    type:"POST",
                url: site_url+"/search_controller/customerSearch1",
                data: "search=" + $q,
                    success: function(data){
//                    alert(data);
                    $('div#results').html(data);
                    },
                    error: function(msg){
                        alert(msg);
                    }
                }
            );

    }

$('#searchform').submit(function(e){
    e.preventDefault();
    });
});
}

function ip_Block_Search(){
    $("#ipblksearch").addClass("selected-on");
    $("#custsearch").removeClass("selected-on");
    $("#catsearch").removeClass("selected-on");

    document.getElementById('results').style.display="none";
    document.getElementById('results_cat').style.display="none";
    document.getElementById('results_ipblk').style.display="block";


    $('input#txtSearch').keyup(function(e){
        e.preventDefault();
        var $q = $(this);

        if($q.val() == ''){
            $('div#results_ipblk').html('');
            return false;
        }

        else{

            $.ajax(
                {
                    type:"POST",
                    url: site_url+"/search_controller/ipBlockSearch",
                    data: "search=" + $q.val(),
                    success: function(data){

                            $('div#results_ipblk').html(data);
                    },
                    error: function(msg){
                        alert(msg);
                    }
                }

            );

        }

        $('#searchform').submit(function(e){
            e.preventDefault();
        });

    });

}

function cat_ssid_Search(){
    document.getElementById('results').style.display="none";
    document.getElementById('results_ipblk').style.display="none";
    document.getElementById('results_cat').style.display="block";

    $("#catsearch").addClass("selected-on");
    $("#custsearch").removeClass("selected-on");
    $("#ipblksearch").removeClass("selected-on");

    $('input#txtSearch').keyup(function(e){
        e.preventDefault();
        var $q = $(this);
//    var $q = $('#txtSearch');

        if($q.val() == ''){
            $('div#results_cat').html('');
            return false;
        }

        else{
            var string = encodeURIComponent('+'); // "%2B"
            $q = $q.val().replace("+",string);

            $.ajax(
                {
                    type:"POST",
                    url: site_url+"/search_controller/categorySearch",
                    data: "search=" + $q,
                    success: function(data){
                        var msg = eval('(' + data + ')');

                        var resultHtml = '';
                        resultHtml+='<div class="result">';
                        resultHtml+= '<ul class="search-results">';
                        $.each(msg,function(i,item){
                            resultHtml+='<li>';
                            resultHtml+='<h2><a href='+site_url+'/ipblock_controller/assigned_ipblocks/'+item.category_id+'>'+item.category_name+'</a></h2>';
                                if(item.category_id == 1){
                                    resultHtml+='<h2><a href='+site_url+'/ipblock_controller/assigned_ipblocks/'+item.category_id+'/'+item.location_id+'>'+item.ssid+'</a></h2>';
                                }
                                else if(item.category_id >1 && item.location_id == null){
                                        resultHtml+='<h2><a href='+site_url+'/ipblock_controller/assigned_ipblocks/'+item.category_id+'/'+item.sub_category_id+'>'+item.ssid+'</a></h2>';}
                                else{
                                    resultHtml+='<h2><a href='+site_url+'/ipblock_controller/assigned_ipblocks/'+item.category_id+'/'+item.location_id+'>'+item.ssid+'</a></h2>';
                                }
//                            }

                            resultHtml+='<p>'+item.ssid.replace($q, '<span class="highlight">'+ $q+'</span>')+'</p>';
                        });
                        resultHtml+='</li>';
                        resultHtml+='</div>';

                        $('div#results_cat').html(resultHtml);
//                    alert(data);
                    },
                    error: function(msg){
                        alert(msg);
                    }
                }

            );

        }

        $('#searchform').submit(function(e){
            e.preventDefault();
        });

    });
}