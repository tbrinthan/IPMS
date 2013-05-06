
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
            {
                get_CustomerDetails($('#custName').val());
            }
        if($('#LinkService').val() != 0){
                get_LinkServiceDetails($('#LinkService').val());    
        }
            
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

        <form  action="#" method="post" id="addcustomerform" >
            <fieldset>

                <div>
                  <label style="float: left;">Customer Name&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp; </label>
                  
                  <select id="custName" name="custName" onchange="get_CustomerDetails(this.value)" class="chzn-select" data-placeholder="Select Customer Name" style="width: 50%;" >
                        <option value="0"></option>
                        <?php
//                        foreach ($customers as $row){
                        foreach ($crm_customers as $row){
//                            if($row->end_date == NULL && $row->status==(NULL || 0)){
                                if($row->id == $custid) {?>
                                    <option  value="<?php echo $row->id;?>" selected="selected"><?php echo $row->name; ?></option>
                                    <?php }
                                else {?>
                                    <option  value="<?php echo $row->id;?>" ><?php echo $row->name; ?></option>
                                    <?php }
//                                    } 
                                    }?>
                    </select>
 
              </div> 
                <input class="button" id="service_ip_available" type="button" value="View All Details" style="display:block;float: right; height: 40px; font-variant:small-caps; " onclick="view_CustomerDetails()"/>
 
                <p id="temp1"></p>
                <p id="temp2">  
                </p>
                <input class="button" id="edit_cust" type="button" value="Edit Customer" style="display:none; height: 40px; font-variant:small-caps; margin-top: 10px; " onclick="open_Edit_Customer()"/>              
                <input type="hidden" id="linkid" value="<?php echo $linkid;?>"/>
                
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