<script type="text/javascript">
    $(function() {
        $("#txtEndDate").datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
    });
</script>
<script type="text/javascript">


    $(document).bind('beforeReveal.facebox', function() {

        var padding = parseInt($('#facebox .body').css('padding-left'))
            + parseInt($('#facebox .body').css('padding-right'))
            + parseInt($('#facebox .tl').width())
            + parseInt($('#facebox .tr').width());

        var offset = 20;

        $('#facebox').css('left', '0px');
        $('#facebox .body').width( ($(window).width()/2 - padding - offset) + 'px' );
//        $('#facebox .body').height( ($(window).width()/2 - padding - offset) + 'px' );

    });
    $(function(){
       var id = $('#custName').val();
        displayNodeIpTable(id);
        displayCategoryIPTable(id);
        displayPvtIpTable(id);
        displayEndDate(id);
    });
</script>

<div class="content-box" xmlns="http://www.w3.org/1999/html"><!-- Start Content Box -->
    <div class="content-box-header">
        <h3><?php echo $title; ?></h3>

        <div class="clear"></div>
    </div> <!-- End .content-box-header -->

    <div class="content-box-content" >
        <div class="notification attention png_bg">
            <a href="#" class="close"><img src="<?php echo base_url();?>admin_resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
            <div>
                Add Temporary Customer and Assign IP Addresses
            </div>
        </div>

        <form  action="#" method="post" id="addtempcustomerform" >
            <fieldset>
                <div id="customer_add">
                    <?php
                        $detail=$this->customer_model->getCustomerDetailsByID();
                        foreach($detail as $row){
                    ?>
                    <b>Customer Name&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;</b><input type="hidden" id="LinkService" value="<?php echo $row->customer_id;?>"><?php echo $row->customer_name;?>
                    <p></p>

                    <b>Address&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;</b><?php echo $row->address?>
                    <p></p>
                    <b>BandWidth&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;</b><?php echo $row->bandwidth?>
                    <p></p>


                    <b>Connection Type&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;</b><?php echo $row->connection_name?>
                    <p></p>

                    <b>End Date&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;</b><?php echo $row->end_date?>
                    <p></p>

                    <?php }?>
                    <div class="clear"></div>
                    <p></p>
                </div>
                <div id="table_customer_detail" style="display: none;">
            </div>

            <div style="display:block;" id="temp_cust_detail">
                <hr/>
                <div class="clear"></div>
                <p id="selectNodeLocation">
                    <b>Node Location&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;   </b>
                    <select id="NodeLocation"  width="25%" onclick="show_SSIDPerLocation(this.value)"   >
                        <option value="0">Select Node Location</option>
                        <?php
                        foreach ($locations as $row){ ?>
                            <option style="padding-bottom: 1Px;padding-top: 1Px;"  value="<?php echo $row->location_id;?>"> <?php echo $row->location; ?> </option>
                            <?php } ?>
                    </select>
                <span id="selectSSID">
                    <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Node SSID&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;   </b>
                    <select id="NodeSSID"  width="25%" onchange="showNodeIPButton()">
                        <option value="0">Select Node SSID</option>

                    </select>
                </span>
                    <span> <input class="button" id="node_ip_available" type="button" value="View Available Node IPs" style="display:none;margin-left: 50px; height: 40px; font-variant:small-caps; " onclick="get_NodeIPDetails_ForSSID()"/>
 </span>
                </p>
                <div id="table_nodeip" style="display:none;">
                </div>

                <hr/>
                <div class="clear"></div>

                <p id="selectCategoryIP">
                    <b>Service Category&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;   </b>
                    <select id="CategoryIP"  width="25%" onclick="show_SubcatPerCat(this.value)"   >
                        <option value="0">Select Service Category</option>
                        <?php           //display the categories ->except Node Category
                        foreach ($categories as $row){ if($row->category_id != 1){?>
                            <option style="padding-bottom: 1Px;padding-top: 1Px;"  value="<?php echo $row->category_id;?>"> <?php echo $row->category_name; ?> </option>
                            <?php } }?>
                    </select>
                <span id="selectSubCategoryIP">
                    <b>&nbsp;&nbsp;&nbsp;Sub Category&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;   </b>
                    <select id="SubCategoryIP"  width="25%" onchange="showCategoryIPButton()">
                        <option value="0">Select Node SSID</option>

                    </select>
                </span>
                    <span> <input class="button" id="service_ip_available" type="button" value="View Available Service IPs" style="display:none;margin-left: 50px; height: 40px; font-variant:small-caps; " onclick="get_CategoryIPDetails_ForSSID()"/>
 </span>
                </p>
                <div id="table_service_ip" style="display:block;">
                </div>

                <hr/>
                <div class="clear"></div>
                <b><span>Add Private IP </span> &nbsp;&nbsp;<input type="checkbox" name="checkbox_pvtip" id="checkbox_pvtip" onclick="display_addPvtIP()" style=""/></b>
                <div class="clear"></div>
                <p id ="add_privateip" style="display:none;">
                    <b>Private IP:</b>   <input class="text-input Small-input" type="text" id="txtPvtIP" maxlength="15" size="15" />
                    <b>&nbsp;&nbsp;CIDR &nbsp; :</b>  <input class="text-input Small-input" type="text" id="txtCIDR" maxlength="2" size="2"  />
      <span> <input class="button" id="add_private_ip" type="button" value="Add Private IPs" style="display:block;margin-left: 50px; height: 40px; font-variant:small-caps; " onclick="add_PrivateIP_to_Customer()"/>
                </p>

                <div id="table_private_ip" style="display: none;"></div>
                <hr/>
            </div>
            </fieldset>
            <div class="clear"></div><!-- End .clear -->
        </form>

        <div class="clear"></div><!-- End .clear -->

    </div>

    <script type="text/javascript">
        $('#2').addClass('current');
    </script>