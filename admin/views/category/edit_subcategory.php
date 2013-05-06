<style type="text/css">

       #newcategory{
            font-size: 20Px;
            color:#a2b942;
            font-variant:small-caps;
        }
    #abc{
        color:red;
        font-variant:all-petite-caps;

    }


</style>

<div class="content-box" xmlns="http://www.w3.org/1999/html"><!-- Start Content Box -->
    <div class="content-box-header">
        <h3><?php echo $title; ?></h3>

        <div class="clear"></div>
    </div> <!-- End .content-box-header -->

    <div class="content-box-content" >
        <form action="#" method="post" id="categoryform">
            <fieldset>

                <p id="newcategory" >
                <label>Category : <span id="abc"><?php echo $category_name ?> </span></label>
                <div id="error_category"></div>
                </p>
                <p id="newsubcategory" >
                    <label>Sub Category [SSID] :</label>
                    <input class="text-input medium-input" type="text" id="txtSubCategory" name="txtSubCategory" value="<?php echo $ssid?>" onfocus="checkNode(<?php echo $category_id?>)"/>
                <div id="error_subcategory"></div>
                </p>

                <p id="newlocation"  >
                    <label>Location :</label>
                    <input class="text-input medium-input" type="text" id="txtLocation" name="txtLocation" value="<?php echo $location?>" onfocus="checkNode(<?php echo $category_id?>)" />
                <div id="error_location"></div>
                </p>



                <p id="error_add_category">

                </p>
                <p id="categoryedit">
                    <input class="button" id="submit1" type="button" value="Rename Category" onclick="update_subcategory(<?php echo $sub_category_id?>)" />
                    <input class="button" id="delete" type="button" value="Delete Category" onclick="delete_SubCategory(<?php echo $sub_category_id ?>,<?php echo $category_id?>)" />
                    <input class="button" id="back" type="button" value="Back" onclick="history.go(-1)" />

                </p>

            </fieldset>
            <div class="clear"></div><!-- End .clear -->
        </form>
    </div>
</div>

<script type="text/javascript">
    $('#3').addClass('current');
</script>