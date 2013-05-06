<style type="text/css">
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


    <div class="content-box column-left" xmlns="http://www.w3.org/1999/html" ><!-- Start Content Box -->
    <div class="content-box-header">
        <h3><?php echo $title; ?></h3>

        <div class="clear"></div>
    </div> <!-- End .content-box-header -->

    <div class="content-box-content" >
<!--Tab containing the Adding IP Pool form-->
        <div class="tab-content default-tab" id="tab1">

            <form action="#" method="post" id="ippoolform" >
            <fieldset>

                <p id="ipaddress">
                    <label>IP address [IPv4] :</label>
                    <input class="text-input Small-input" type="text" id="txtIPaddress" maxlength="15"  />
                <div id="error_ipaddress"></div>
                </p>
                <p id="subnetmask" >
                    <label>CIDR :</label>
                  <?php echo  "<span id=\"big\">". "/&nbsp"."</span>";?><input class="text-input Small-input" type="text" id="txtSubnetMask" maxlength="2" size="2"/>
                <div id="error_subnetmask"></div>
                </p>


                <p id="error_add_ip_pool">

                </p>
                <p id="ip_pool_submit">
                    <input class="button" id="submit1" type="button" value="Add IP Pool" onclick="addIPPool()" />
                </p>

            </fieldset>
            <div class="clear"></div><!-- End .clear -->
        </form>
    </div>

    <p></p>
    <div class="notification attention png_bg">
        <a href="#" class="close"><img src="<?php echo base_url(); ?>admin_resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close"  /></a>
        <div>
            <?php echo "These are the Major IP Pools which can be assigned further to other categories."."<br>"; ?>
        </div>
    </div>
    </div>
    </div>
<!--        <div class="tab-content" id="tab2">-->
        <div class="content-box column-right">

            <div class="content-box-header"> <!-- Add the class "closed" to the Content box header to have it closed by default -->

                <h3>View Added IP Pool</h3>

            </div> <!-- End .content-box-header -->

            <div class="content-box-content">
            <!--            Tab containing the View IP Pool details-->



            <table>

                <thead>
                <tr>
                    <th>Pool ID</th>
                    <th>IP Pool [IPv4 Address]</th>
                    <th>CIDR Value</th>
                    <th> Modify</th>
                </tr>

                </thead>

                <tbody>
                <?php
                foreach($ip_pools as $row){?>
                <tr id="<?php echo $row->pool_id?>">
                    <td style="text-align: center;"><?php echo $row->pool_id; ?></td>
                    <td><?php echo $row->pool_values;?></td>
                    <td style="text-align: center;"><?php echo $row->subnet;?></td>
                    <td>
                        <!-- Icons -->
                        <a style="cursor: pointer;"title="View More"  onclick="open_PoolDetails(<?php echo $row->pool_id;?>)"   ><img src="<?php echo base_url(); ?>admin_resources/images/icons/information.png" alt="View Details"  /></a>
                        <span><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;"?> </span>
                        <a style="cursor:pointer;" title="Delete IP Pool" onclick="delete_IPPool(<?php echo $row->pool_id;?>,<?php echo $row->pool_id;?>)">
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


<script type="text/javascript">
    $('#3').addClass('current');
</script>