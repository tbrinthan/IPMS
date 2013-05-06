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
        margin: 20px 30px 0 20px;
        padding-left: 25px;  !important;
        background: 0;
    }



</style>
<script type="text/javascript">
    $(function(){
        if($('#custName').val() != 0)
            customer_records($('#custName').val());
    });
</script>


<div class="content-box" xmlns="http://www.w3.org/1999/html"><!-- Start Content Box -->
    <div class="content-box-header">
        <h3><?php echo $title; ?></h3>

        <div class="clear"></div>
    </div> <!-- End .content-box-header -->

    <div class="content-box-content" style="overflow-x: scroll;" >
        <div class="notification attention png_bg">
            <a href="#" class="close"><img src="<?php echo base_url(); ?>admin_resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
            <div>
                Select from Drop Down box to Obtain the Details of the Customers.
            </div>
        </div>

        <form  action="#" method="post" id="cusrecords" >
            <fieldset>

                <span>
                    <b>Customer Name&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;   </b>
                    <select id="custName" name="custName" width="25%" onchange="customer_records(this.value)" >
                        <option value="0">Select Customer Name</option>
                        <?php
                        foreach ($customers as $row) {

                                if ($row->customer_id == $select_value) {
                                    ?>
                                    <option  value="<?php echo $row->customer_id; ?>"  selected="selected"><?php echo $row->customer_name; ?></option>
                                <?php } else { ?>
                                    <option  value="<?php echo $row->customer_id; ?>" ><?php echo $row->customer_name; ?></option>
                                <?php
                                }
                        }
                        ?>
                    </select>

                <b>&nbsp;&nbsp;&nbsp;IP Address:&nbsp;&nbsp;</b>
                <input class="text-input small-input" type="text" id="txtSearch" name="txtSearch" onclick="ip_search();" />
                </span>

                <div id="results" class="results" style="display:none;">

                </div>
                <hr/>

                <div id="print">
                <p>
                <span id="customer" style="display: none;font-size: 0.8em"></span>
                <img style="float:right" onclick="print_records('print')" src="<?php echo base_url();?>admin_resources/images/icons/printbutton.gif" alt="Print" title="Print" /></p>

                <div id="table_nodeip" style="display:none;overflow: auto;" >

                </div>
                <hr/>
                <div class="clear"></div>

                <div id="table_category_ip" style="display:none;"></div>

                <hr/>
                <div class="clear"></div>

                <div id="table_private_ip" style="display: none;"></div>
                <hr/>
                </div>
            </fieldset>
            <div class="clear"></div>
        </form>

        <div class="clear"></div>
    </div>

    </div>

    <script type="text/javascript">
        $('#4').addClass('current');
    </script>
