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
            
            <div id="ip_blocks" style="display: block;">

                <h3 style="margin-top: 10px;text-align: center;font-weight: bolder;font-size: 1.2em">IP block Usage</h3>

                <hr>
                                <form id="ipblock_form"  class="records">
                    <table id="dt2" class="display">
                    <thead>
                    <tr>
                        
                        <th style="font-size: 12px">ID</th>
                        <th style="font-size: 12px">START IP</th>
                        <th style="font-size: 12px">LENGTH</th>
                        <th style="font-size: 12px">USAGE</th>
                        <th style="font-size: 12px">ASSIGNMENT STATUS</th>
                    </tr>
                    </thead>
                    
                    <tfoot>

                </tfoot>

                <tbody>
                <?php
                    
                     foreach($ipblocks as $row){?>
                    <tr id="<?php echo $row->parent_id?>">
                    <td><?php echo $row->parent_id;?></td>
                    <td><?php echo $row->sub_pool_values;?></td>
                    <td><?php echo $row->subnet;?></td>
                    <?php $this->usage_model->setParentid($row->parent_id);if(!($this->usage_model->check_assigned_blocks())) echo "<td>Not Allocated</td>"; else echo "<td>".$temp[$row->parent_id]."% usage</td>";?>
                    <?php $this->usage_model->setParentid($row->parent_id);if(!($this->usage_model->check_assigned_blocks())) echo "<td>Not Used</td>";
                    else echo '<td><div class="ui-progressbar ui-widget-content" style="height:20px;"><div class="ui-progressbar-value ui-widget-header ui-corner-left" style="height:100%;width:'.$temp[$row->parent_id].'%; overflow:hidden"></div></div></td>';?>
                    

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




