<style type="text/css" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html"
       xmlns="http://www.w3.org/1999/html">
    #big{
        font-size:24Px;
    }
</style>
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
</script>
<div class="content-box" xmlns="http://www.w3.org/1999/html"><!-- Start Content Box -->
    <div class="content-box-header">
        <h3><?php echo $title; ?></h3>
        <div class="clear"></div>
    </div> <!-- End .content-box-header -->

    <div class="content-box-content" >
        <!--Tab containing the Adding IP Pool form-->
        <div class="tab-content default-tab" id="tab1">

            <div class="notification attention png_bg">
                <a href="#" class="close"><img src="<?php echo base_url(); ?>admin_resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div>
                    You should select a category first and then select the sub category.
                </div>
            </div>

            <form  action="" method="post" id="ipblockform" >
                <fieldset>
                    <div style="float:left;" >
                        <b>Category:&nbsp;</b>
                        <select id="category" name="category" width="25%" onchange="getSubcategory(this.value)" >
                            <option value="0">Select Category</option>
                            <?php foreach ($category->result() as $row) { ?>
                                <option  value="<?php echo trim($row->category_id); ?>"><?php echo trim($row->category_name); ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <span id=check1 style="margin-left: 50px;display:none;float: left;" >

                        <input type="button" class="button"  id="node_button" name="button_a" value="View Available Node blocks" style="float: left;clear:none;" onclick="viewNodeblock()"/>

                        <input type="checkbox" id="checkbox1" value="1" onclick="checkbox(this.value)" style="margin-left:20px;clear: left;"   /><b>Add IP block to locations</b>
                    </span>

                    <div id="hide" style="padding-top: 40px;">

                        <div id="subcat" style="float:left; ">
                            <b>Select Subcategory: &nbsp;</b>
                            <select id="subcategory" name="subcategory" width="25%" >
                                <option value="" >Select a category first </option>
                            </select>
                        </div>

                        <span> <input class="button" id="ipblock_button" type="button" name="button_b" value="View Available IP blocks" style="margin-left: 50px;" onclick="viewIpblock()"/></span> 
                    </div>
                    <p></p>
                    <div id="ipaddress" style="margin-top: 30px; ">
                        <label>IP address [IPv4] CIDR:</label>

                        <textarea id="txtcidr" readonly="readonly" rows="5"  style="line-height: 1.4em"></textarea>
                        <div id="error_ipaddress"></div>
                    </div>


                    <div id="msg"></div>

                    <p id="error_add_ipblock">

                    </p>
                    <div id="ip_block_submit">
                        <input class="button" id="submit1" type="button" value="Asssign_block" onclick="addIpblock()" />
                    </div>

                </fieldset>
                <div class="clear"></div><!-- End .clear -->
            </form>
        </div>

    </div>

</div>

<script type="text/javascript">
    $('#3').addClass('current');
</script>

<style type="text/css">
    .append{
        float: left;
        clear: none;
    }

</style>

<script type="text/javascript">
    document.getElementById('ipblockform').reset();
</script>

<script type="text/javascript">
    function notification(){
        alert("Please select from available blocks");
        //            alert($('#subcategory').val());
    }

</script>




