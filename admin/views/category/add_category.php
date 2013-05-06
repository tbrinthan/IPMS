<div class="content-box" xmlns="http://www.w3.org/1999/html"><!-- Start Content Box -->
    <div class="content-box-header">
        <h3><?php echo $title; ?></h3>
        <ul class="content-box-tabs">
            <li><a href="#tab1"  class="default-tab">Add Category</a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2">Add Node Location</a></li>
            <li><a href="#tab3">Add Node-Type</a></li>
        </ul>

        <div class="clear"></div>
    </div> <!-- End .content-box-header -->

    <div class="content-box-content" >
        <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->

            <form action="#" method="post" id="categoryform" >
            <fieldset>
             <p>
                 <label>Category</label>
                 <select id="category" name="category" class="small-input" onclick="showHideCategory(this.value)" >
                        <option value="0">Add New/ Select</option>
                        <?php
                            $category = $this->category_model->getCategory();
                            foreach($category as $rowcat){ ?>
                        <option value="<?php echo $rowcat->category_id;?>"><?php echo $rowcat->category_name;}?></option>
                 </select>

             </p>

             <p id="newcategory">
                 <label>Category *</label>
                 <input class="text-input medium-input" type="text" id="txtCategory" name="txtCategory" onfocus="checkOption()" />
                 <div id="error_category"></div>
             </p>

            <p id="newsubcategory" >
                <label>Sub Category /  [SSID] *</label>
                <input class="text-input medium-input" type="text" id="txtSubCategory" name="txtSubCategory" onfocus="checkOption()" />
            <div id="error_subcategory"></div>
            </p>

            <p id="newlocation" >
                <label>Location *</label>
                <select id="txtLocation" name="location" class="small-input" onfocus="checkOption()">
                <option value="0">Select a Location</option>
                <?php
                foreach($location_details as $rowloc){ ?>
                        <option value="<?php echo $rowloc->location_id;?>"><?php echo $rowloc->location;}?></option>
                </select>

<!--                <input class="text-input medium-input" type="text" id="txtLocation" name="txtLocation"  onfocus="checkOption()" />-->
            <div id="error_location"></div>
            </p>


                <p id="error_add_category">

                </p>
                <p id="categorysubmit">
                    <input class="button" id="submit1" type="button" value="Add Category" onclick="add_category()" />
                </p>

            </fieldset>
            <div class="clear"></div><!-- End .clear -->
        </form>
    </div>
        <div class="tab-content  " id="tab2"> <!-- This is the target div. id must match the href of this div's tab -->

            <div class="content-box " xmlns="http://www.w3.org/1999/html" ><!-- Start Content Box -->
                <div class="content-box-header">
                    <h3><?php echo "Add Node Location"; ?></h3>

                    <div class="clear"></div>
                </div> <!-- End .content-box-header -->

                <div class="content-box-content" >
                    <!--Tab containing the Adding IP Pool form-->

                        <form action="#" method="post" id="locationnodeform" >
                            <fieldset>

                                <p id="location node">
                                    <label>Node Location :</label>
                                    <input class="text-input medium-input" type="text" id="txtLocationNode" maxlength="15"  />
                                </p>
                                <div id="error_locationNode"></div>

                                </p>
                                <p id="location_node_submit">
                                    <input class="button" style="height: 30Px;padding-bottom: 10Px;" id="submitLocation" type="submit" value="Add Location" onclick="add_NodeLocation()" />
                                </p>

                            </fieldset>
                            <div class="clear"></div><!-- End .clear -->
                        </form>


                    <p></p>
                    <div class="notification attention png_bg">
                        <a href="#" class="close"><img src="<?php echo base_url(); ?>admin_resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close"  /></a>
                        <div>
                            <?php echo "Add Locations which will be assigned with Node SSIDs."."<br>"; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-box ">

                <div class="content-box-header"> <!-- Add the class "closed" to the Content box header to have it closed by default -->

                    <h3>Added Locations</h3>

                </div> <!-- End .content-box-header -->

                <div class="content-box-content">
                    <!--            Tab containing the View Location Details-->
                    <table>
                        <thead>
                        <tr>
                            <th>Location ID</th>
                            <th>Location</th>
                            <th> Modify</th>
                        </tr>

                        </thead>

                        <tbody>
                        <?php
                        foreach($location_details as $row){?>
                        <tr id="<?php echo $row->location_id?>">
                            <td style="text-align: center;"><?php echo $row->location_id; ?></td>
                            <td><?php echo $row->location;?></td>
                            <td>
                                <!-- Icons -->
                                <a style="cursor: pointer;"title="View More"  onclick="open_SSID_ForLocation(<?php echo $row->location_id;?>)"   ><img src="<?php echo base_url(); ?>admin_resources/images/icons/information.png" alt="View Details"  /></a>
                                <span><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;"?> </span>
                                <a style="cursor:pointer;" title="Delete IP Pool" onclick="delete_Location(<?php echo $row->location_id;?>,<?php echo $row->location_id;?>)">
                                    <img src="<?php echo base_url(); ?>admin_resources/images/icons/cross.png" alt="Delete" /></a>
                            </td>
                        </tr>
                            <?php }?>

                        </tbody>

                    </table>

                    <p></p>


                    <div class="notification information png_bg">
                        <a href="#" class="close"><img src="<?php echo base_url(); ?>admin_resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close"  /></a>
                        <div>
                            <?php echo "*** IP Pool can only be deleted, if Sub Primary Pool IPs are not assigned to any categories ***"; ?>
                        </div>
                    </div>
                </div>
                <div class="clear"></div><!-- End .clear -->
            </div>

            </div>
        <div class="tab-content  " id="tab3"> <!-- This is the target div. id must match the href of this div's tab -->

            <div class="content-box column-left" xmlns="http://www.w3.org/1999/html" ><!-- Start Content Box -->
                <div class="content-box-header">
                    <h3><?php echo "Add Node Type"; ?></h3>

                    <div class="clear"></div>
                </div> <!-- End .content-box-header -->

                <div class="content-box-content" >
                    <!--Tab containing the Adding IP Pool form-->

                    <form action="#" method="post" id="nodetypeform" >
                        <fieldset>

                            <p id="node type">
                                <label>Node Type :</label>
                                <input class="text-input medium-input" type="text" id="txtNodeType" maxlength="15"  />
                            </p>
                            <div id="error_nodetype"></div>

                            </p>
                            <p id="node_type_submit">
                                <input class="button" style="height: 30Px;padding-bottom: 10Px;" id="submitNodeType" type="submit" value="Add Node Type" onclick="add_NodeType()" />
                            </p>

                        </fieldset>
                        <div class="clear"></div><!-- End .clear -->
                    </form>


                    <p></p>
                    <div class="notification attention png_bg">
                        <a href="#" class="close"><img src="<?php echo base_url(); ?>admin_resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close"  /></a>
                        <div>
                            <?php echo "Add Node Types that will be used when IPs are assigned to customers."."<br>"; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-box column-right">

                <div class="content-box-header"> <!-- Add the class "closed" to the Content box header to have it closed by default -->

                    <h3>View Node-Types</h3>

                </div> <!-- End .content-box-header -->

                <div class="content-box-content">
                    <!--            Tab containing the View Location Details-->
                    <table>
                        <thead>
                        <tr>
                            <th>NodeType ID</th>
                            <th>Node-Type</th>
                            <th>Modify</th>
                        </tr>

                        </thead>

                        <tbody>
                        <?php
                        foreach($nodetype_details as $row){?>
                        <tr id="<?php echo "nodetype".$row->Type_id?>">
                            <td style="text-align: center;"><?php echo $row->Type_id; ?></td>
                            <td><?php echo $row->Type_name;?></td>
                            <td>
                                <a style="cursor:pointer;" title="Delete IP Pool" onclick="delete_NodeType(<?php echo $row->Type_id;?>,<?php echo $row->Type_id;?>)">
                                    <img src="<?php echo base_url(); ?>admin_resources/images/icons/cross.png" alt="Delete" /></a>
                            </td>
                        </tr>
                            <?php }?>

                        </tbody>

                    </table>

                    <p></p>


                </div>
                <div class="clear"></div><!-- End .clear -->
            </div>

        </div>















        </div>
    <div class="clear"></div><!-- End .clear -->

</div>


<script type="text/javascript">
    $('#3').addClass('current');
</script>