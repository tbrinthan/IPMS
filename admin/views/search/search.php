<style type="text/css">
    form{
        margin:15px;
        padding:5px;
        border-bottom:1px solid #ddd;
    }
    form input[type=submit]{display:none;}

    .results{
        padding:10px 0px 0px 15px;
    }

    .results div.result{
        padding:10px 0px;
        margin:10px 0px 10px;
    }

    .results div.result a.readMore{color:green;}

    .results div.result h2{
        font-size:14px;
        margin:0px 0px 5px;
        padding:0px;
        color:#1111CC;
        font-weight:400;
    }

    .results div.result h2 a{
        text-decoration:none;
        border-bottom:1px solid #1111cc;
    }

    .results div.result p{
        margin:0;
        padding:0;
    }

    span.highlight{
        background:#FCFFA3;
        padding:3px;
        font-weight:bold;
    }

    ul.search-results li {
        float: left;
        margin: 30px 30px 0 20px;
        /*padding-left: 25px;  !important;*/
        width: 200px;
        height: 70px;
        background: url('<?php echo base_url();?>admin_resources/images/icons/bullet_black.png') center left no-repeat;

    }
    

</style>

<div class="content-box" xmlns="http://www.w3.org/1999/html"><!-- Start Content Box -->
    <div class="content-box-header">
        <h3><?php echo $title; ?></h3>

        <div class="clear"></div>
    </div> <!-- End .content-box-header -->

    <div class="content-box-content" >
        <div style="position: absolute; margin-left: 20px;">
            <ul class="shortcut-buttons-set">

                <li><a class="shortcut-button"  style="cursor: pointer;" id="custsearch" onclick="customer_Search()"><span>
                                   <img src="<?php echo base_url();?>admin_resources/images/icons/customer_64.png"  alt="Search Customers" title="Search Customers" /><br />
                            Customers                               </span></a></li>

                <li><a class="shortcut-button"  style="cursor: pointer;" id="ipblksearch" onclick="ip_Block_Search()"><span>
                                   <img src="<?php echo base_url();?>admin_resources/images/icons/find_64.png" alt="Search IP Blocks" title="Search IP Blocks" /><br />
                                   IP Blocks
                               </span></a></li>

                <li><a class="shortcut-button"  style="cursor: pointer;" id="catsearch" onclick="cat_ssid_Search()"><span>
                                   <img src="<?php echo base_url();?>admin_resources/images/icons/ssid_64.png" alt="Search SSID" title="Search Category/ SSID" /><br />
                                   SSID                               </span></a></li>


            </ul>
        </div>

        <div style="position: relative; margin-top: 150px;">
        <form action="#" method="post" id="searchform" >

            <fieldset>

                <p id="search">
                    <label>Search : </label>
                    <input class="text-input medium-input" type="text" id="txtSearch" style="padding-bottom: 10Px;padding-top: 10Px; font-size: 20Px;font-family: Book Antiqua;"/>
                </p>

                <div id="results" class="results" style="overflow-y: scroll; height: 500Px; display:none;"></div>
                <div id="results_cat" class="results" style="overflow-y: scroll; height: 500Px; display: none;"></div>
                <div id="results_ipblk" class="results" style="overflow-y: scroll; height: 500Px; display: none;"></div>

                <div id="error_search"></div>
                    <input class="button" id="search_button" type="button" value="Search"  style="display: none; height: 40px; width:100Px; font-variant:small-caps; ; "/>

            </fieldset>
            <div class="clear"></div><!-- End .clear -->
        </form>
    </div>
</div>
</div>
<script type="text/javascript">
    $('#6').addClass('current');
</script>