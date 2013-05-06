<style type="text/css" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html"
       xmlns="http://www.w3.org/1999/html">
    #big{
        font-size:24Px;
    }
</style>
<script type="text/javascript">
    $(function(){
        if($('#category').val() == 0 ){



        }
        else if($('#category').val() == 1 ){
            if( $('#subcatt_id').val() == 0){
                viewSubcategory($('#category').val());
                document.getElementById("checkbox1").checked=false;
                viewAssignedNodeblock();
            }
            else{
                viewSubcategory($('#category').val());
                document.getElementById("checkbox1").checked=true;
                view_checkbox($('#checkbox1').val());
                $('#subcategory').val($('#subcatt_id').val());
                viewAssignedIpblock();
            }
        }
        else{
            if( $('#subcatt_id').val() == 0){
                viewSubcategory($('#category').val());
//            document.getElementById("checkbox1").checked=false;
                viewAssignedIpblock();
            }
            else{
                viewSubcategory($('#category').val());
//            document.getElementById("checkbox1").checked=false;
//                view_checkbox($('#checkbox1').val());
                $('#subcategory').val($('#subcatt_id').val());
                viewAssignedIpblock();
            }
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
            <a href="#" class="close"><img src="<?php echo base_url(); ?>admin_resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
            <div>
                You should select a category first and then select the sub category.
            </div>
        </div>

        <form  action="" method="post" id="ipblockform" >
            <fieldset>
                <div style="float:left;" >
                    <b>Category:&nbsp;</b>
                    <select id="category" name="category" width="25%" onchange="viewSubcategory(this.value)" >
                        <option value="0">Select Category</option>
                        <?php foreach ($category->result() as $row) {
                        if($row->category_id == $catt_id) {?>
                            <option  value="<?php echo trim($row->category_id);?>" selected="selected"><?php echo trim($row->category_name); ?></option>
                            <?php }
                        else {?>
                            <option  value="<?php echo trim($row->category_id);?>" ><?php echo trim($row->category_name); ?></option>
                            <?php }?>
                        <?php } ?>
                    </select>
                </div>
                    <span id=check1 style="margin-left: 50px;display:none;float: left;" >

                        <input type="button" class="button"  id="node_button" name="button_a" value="View Assigned Node blocks" style="float: left;clear:none;" onclick="viewAssignedNodeblock()"/>

                        <input type="checkbox" id="checkbox1" value="1" onclick="view_checkbox(this.value)" style="margin-left:20px;clear: left;"   /><b>View by locations</b>
                    </span>

                    <div id="hide" style="padding-top: 40px;">

                        <div id="subcat" style="float:left">
                            <b>Select Subcategory: &nbsp;</b>
                            <select id="subcategory" name="subcategory" width="25%" >
                                <option value="" >Select a category first </option>
                            </select>
                        </div>

                        <span> <input class="button" id="ipblock_button" type="button" name="button_b" value="View Assigned IP blocks" style="margin-left: 50px;" onclick="viewAssignedIpblock()"/></span>
                    </div>



                    <p id="error_add_ipblock">

                    </p>

                </fieldset>
                <div class="clear"></div><!-- End .clear -->
            </form>


        <div id="nodeip_table"></div>

        <div id="nodelocation_table"></div>
        
        <div id="category_table"></div>


        <div id="test"></div>

        <input type="hidden" id="subcatt_id" value="<?php echo $subcatt_id;?>"/>
        <input type="hidden" id="catt_id" value="<?php echo $subcatt_id;?>"/>
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




