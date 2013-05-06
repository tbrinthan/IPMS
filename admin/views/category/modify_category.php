<script type="text/javascript">
    simpla_datatable.dt2();
    simpla_datatable.dt_actions_fb();
</script>

<div class="content-box" xmlns="http://www.w3.org/1999/html"><!-- Start Content Box -->
    <div class="content-box-header">

        <h3><?php echo $title?></h3>

        <ul class="content-box-tabs">
            <li><a href="#tab1" >Information - Categories</a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2" class="default-tab">Information - SSID</a></li>
        </ul>

        <div class="clear"></div>

    </div> <!-- End .content-box-header -->

    <div class="content-box-content">

        <div class="tab-content" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->

            <div class="notification attention png_bg">
                <a href="#" class="close"><img src="<?php echo base_url(); ?>admin_resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div>
                Beware while deleting the Categories. It can be only deleted once the Subcategories are deleted.
                </div>
            </div>

            <table class="display">

                <thead>
                <tr>
                    <th>Category ID</th>
                    <th>Category</th>
                    <th>Modify</th>
                </tr>

                </thead>

                <tfoot>

                </tfoot>

                <tbody>
                <?php
                    $category   = $this->category_model->getCategory();
                     foreach($category as $row){?>
                <tr id="<?php echo $row->category_id?>">
                    <td><?php echo $row->category_id;?></td>
                    <td><?php echo $row->category_name;?></td>
                    <td>
                        <!-- Icons -->
                        <a style="cursor: pointer;"title="Edit Category" href="<?php echo base_url()?>index.php/category/editCategory/<?php echo $row->category_id?>" ><img src="<?php echo base_url(); ?>admin_resources/images/icons/pencil.png" alt="Edit" /></a>
                        <span><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;"?> </span>
                        <a style="cursor:pointer;" title="Delete Category" onclick="delete_Category(<?php echo $row->category_id ?>,<?php echo $row->category_id?>)">
                        <img src="<?php echo base_url(); ?>admin_resources/images/icons/cross.png" alt="Delete" /></a>
                    </td>
                </tr>
                <?php }?>
<!--                <div id="dialog-confirm" title="Delete Category?">-->
<!--                    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>These items will be permanently deleted and cannot be recovered. Are you sure?</p>-->
<!--                </div>-->

                </tbody>

            </table>
            <div class="clear"></div><!-- End .clear -->

        </div> <!-- End #tab1 -->
        <div class="tab-content default-tab" id="tab2"> <!-- This is the target div. id must match the href of this div's tab -->

            <div class="notification attention png_bg">
                <a href="#" class="close"><img src="<?php echo base_url(); ?>admin_resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div>
                    Beware while deleting the Categories. It can be only deleted once the Subcategories are deleted.
                </div>
            </div>

            <table id="dt2" class="display">

                <thead>
                <tr>
                    <th>Category</th>
                    <th>SSID</th>
                    <th>Location</th>
                    <th>Modify</th>
                </tr>

                </thead>

                <tfoot>
                </tfoot>

                <tbody>
                <?php
//                    $subcategory=$this->category_model->getSubCategory();
                    foreach($subcategory as $rowsub){
                ?>
                <tr id="<?php  echo $rowsub->sub_category_id ?>">
                    <td><?php  echo $rowsub->category_name ?> </td>
                    <td><?php echo $rowsub->ssid ?></td>
                    <td><?php echo $rowsub->location ?></td>
                    <td>
                        <!-- Icons -->
                        <a style="cursor: pointer;"title="Edit Sub Category" href="<?php echo base_url()?>index.php/category/editSubCategory/<?php echo $rowsub->sub_category_id?>"  ><img src="<?php echo base_url(); ?>admin_resources/images/icons/pencil.png" alt="Edit" /></a>
                        <span><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;"?> </span>
                        <a style="cursor:pointer;" title="Delete Sub Category" onclick="delete_SubCategory(<?php echo $rowsub->sub_category_id ?>,<?php echo $rowsub->category_id?>)">
                            <img src="<?php echo base_url(); ?>admin_resources/images/icons/cross.png" alt="Delete" /></a>
                    </td>
                </tr>
<?php }?>

                </tbody>

            </table>
            <div class="clear"></div><!-- End .clear -->
        <?php echo $this->pagination->create_links();?>
        </div> <!-- End #tab1 -->
</div>
</div>
<script type="text/javascript">
    $('#3').addClass('current');
</script>