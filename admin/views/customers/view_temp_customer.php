
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
        if($('#custName').val() != 0)
       get_CustomerDetails($('#custName').val());
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
                Select from Drop Down box to Obtain the Details of the Customers.
            </div>
        </div>

        <form  action="#" method="post" id="viewtempcustomerform" >
            <fieldset>
                <p id="selectCustomer">
                    <b>Customer Name&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;   </b>
                    <select id="custName" name="custName" width="25%" onchange="get_CustomerDetails(this.value)" >
                        <option value="0">Select Customer Name</option>
                        <?php
                        foreach ($customers as $row){
                            if($row->end_date != NULL && ($row->status==(NULL || 0))){
                                if($row->customer_id == $select_value) {?>
                                     <option  value="<?php echo $row->customer_id;?>" selected="selected"><?php echo $row->customer_name; ?></option>
                                 <?php }
                            else {?>
                                  <option  value="<?php echo $row->customer_id;?>" ><?php echo $row->customer_name; ?></option>
                       <?php }} }?>
                    </select>
                </p>
                <p id="temp1"></p>

                <p id="custID" style="display:none;"><b> Customer ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp; </b><b>
                    <span id="display_custID"></span></b>
                </p>
                <p id="custEndDate" style="display:none;"><b>
                End Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;
                    <span id="display_EndDate"></span></b>
                </p>
                <p id="custConnection" style="display:none;"><b> Connection Type&nbsp;&nbsp;: &nbsp;&nbsp; </b>
                    <b> <span id="display_custCon"></span>
                </p></b>
                <p id="custBW" style="display:none;"><b> BandWidth&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp; </b>
                    <b> <span id="display_custBW"></span>
                </p></b>
                <p id="custAddress" style="display:none;"><b> Address&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp; </b>
                    <b> <span id="display_custAddress"></span><br><br><br>

                        <input class="button" id="remove_temp_cust" type="button" value="Remove Temp Customer" style="display:block; height: 40px; font-variant:small-caps;float:left;margin-right: 50px " onclick="remove_Temp_Customer()"/>
                        <input class="button" id="edit_temp_cust" type="button" value="Edit Temp Customer" style="display:block; height: 40px; font-variant:small-caps; " onclick="edit_Temp_Customer()"/>

                </p></b>

                <hr/>

                <div id="table_nodeip" style="display:none;">
                </div>

                <hr/>
                <div class="clear"></div>


                <div id="table_service_ip" style="display:none;">
                </div>

                <hr/>
                <div class="clear"></div>


                <div id="table_private_ip" style="display: none;"></div>
                <hr/>
            </fieldset>
            <div class="clear"></div><!-- End .clear -->
        </form>

        <div class="clear"></div><!-- End .clear -->

    </div>

    <script type="text/javascript">
        $('#2').addClass('current');
    </script>