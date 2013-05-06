<html>
<head>

    <script type="text/javascript">
        simpla_datatable.dt2();
        simpla_datatable.dt_actions_fb();
        
</script>

</head>

<div class="content-box"><!-- Start Content Box -->

    <div class="content-box-header" style="height: 50px">

        <h3><?=$title?></h3>

    </div> <!-- End .content-box-header -->

    <div class="content-box-content">
        <div id="container" >
            
            <div id="node_blocks" style="display: block;">

                <h3 style="margin-top: 10px;text-align: center;font-weight: bolder;font-size: 1.2em"> Node IP block Usage</h3>

                <hr>
                <form id="node_form"  class="records">
                    <table id="dt2" class="display">
                    <thead>
                    <tr>
                        
                        <th style="font-size: 12px">ID</th>
                        <th style="font-size: 12px">START IP</th>
                        <th style="font-size: 12px">LENGTH</th>
                        <th style="font-size: 12px">SSID</th>
                        <th style="font-size: 12px">DATE</th>
                        <th style="font-size: 12px">USAGE</th>
                        <th style="font-size: 12px">ASSIGNMENT STATUS</th>
                    </tr>
                    </thead>
                    
                    <tfoot>

                </tfoot>

                <tbody>
                <?php
                    
                     foreach($nodeips as $row){?>
                    <tr id="<?php echo $row->ip_id?>">
                    <td><?php echo $row->ip_id;?></td>
                    <td><?php echo $row->ip_addresses;?></td>
                    <td><?php echo $row->subnet;?></td>
                    <?php if(($row->ssid)==null) echo "<td>N/A</td>";else echo "<td>".$row->ssid."</td>" ?>
                    <td><?php echo $row->from_date;?></td>
                    
                        <!-- Icons -->
                        <?php if(($row->from_date)==null)
echo '<td>0% usage</td>';else echo "<td>".$temp[$row->ip_id]."% usage</td>"?>
                    
                    <?php if(($row->from_date)==null)
echo '<td>Locations Not Assigned</td>';else echo '<td><div class="ui-progressbar ui-widget-content" style="height:20px;"><div class="ui-progressbar-value ui-widget-header ui-corner-left" style="height:100%;width:'.$temp[$row->ip_id].'%; overflow:hidden"></div></div></td>'?>

                </tr>
                <?php }?>

                </tbody>
                </table>

                </form>

            </div>

            <div class="clear"></div>
      </div>

    </div> <!-- End .content-box-content -->

</div>


<script type="text/javascript">
    $('#4').addClass('current');
</script>

</html>




