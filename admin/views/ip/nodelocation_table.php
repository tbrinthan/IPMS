<script type="text/javascript">
    $('.check-all').click(
        function(){
            $(this).parent().parent().parent().parent().find("input[type='checkbox']").attr('checked', $(this).is(':checked'));
        }
    );

</script>
<div id="container">
    <table id="dt2" class="display">
        <p style="margin-top: 40px;text-align: center;font-weight: bold;font-size: 1.2em"><?=$title?></p>

                <thead style="font-variant: small-caps ;">
                <tr>
                    <th style="text-align: center"><input class="check-all" type="checkbox" /></th>
                    <th style="text-align: center">Location</th>
                    <th style="text-align: center">SSID</th>
                    <th style="text-align: center">IP Address</th>
                    <th style="text-align: center">Subnet</th>
                    <th style="text-align: center">Status</th>
                    <th style="text-align: center">Action</th>

                </tr>

                </thead>
                <tbody>

                <?php
//                echo $test;
                $nodedetail=$this->ipblock_model->get_locationip_new();

                foreach($nodedetail->result() as $row){?>
                <tr id=<?=$row->ip_id?>>
                    <td style="text-align: center"><input type="checkbox"/></td>
                    <td style="text-align: center"><?=$row->location?></td>
                    <td style="text-align: center"><?=$row->ssid?></td>
                    <td style="text-align: center" ><?=$row->ip_addresses?></td>
                    <td style="text-align: center" ><?=$row->subnet?></td>
                    <td style="text-align: center"><?php if($this->ipblock_model->check_nodedetail($row->ip_id)){?>
                        <img src = "<?php echo base_url();?>admin_resources/images/icons/notavailable.png" title="Can't Delete" /><?php }
                    else{?>  <img src = "<?php echo base_url();?>admin_resources/images/icons/available.png" title="Deletable" /><?php }
                        ?>
                    </td>
                    <td style="text-align: center;margin-left: auto;margin-right: auto;">
                        <a style="cursor: pointer;"title="Details"  onclick="openNodeDetails(<?=$row->ip_id;?>)"   ><img src="<?php echo base_url(); ?>admin_resources/images/icons/information.png" alt="View Details"  /></a>
<!--                <a style="cursor: pointer;"title="Edit"  onclick="editNodeDetails(<?=$row->ip_id;?>)"   ><img src="<?php echo base_url(); ?>admin_resources/images/icons/pencil.png" alt="Edit"  /></a>-->
            <?php if($this->ipblock_model->check_nodedetail($row->ip_id)){?>
                <a style="cursor:pointer;" title="Delete" onclick="alert('Cannot Delete Customer Assigned!')"><img src="<?php echo base_url(); ?>admin_resources/images/icons/cross.png" alt="Delete" /></a><?php }
            else{?> <a style="cursor:pointer;" title="Delete" onclick="deleteNodeDetails(<?=$row->ip_id?>,<?=$row->ip_id?>)"><img src="<?php echo base_url(); ?>admin_resources/images/icons/cross.png" alt="Delete" /></a><?php }
                ?>
                    </td>

                </tr>
                    <?php }?>


                </tbody>

            </table>
    <?php echo $page_link ?>
</div>


<style type="text/css">
    #container tbody tr:nth-child(even) {background: #f3f3f3}
    #container tbody tr:nth-child(odd) {background: #FFF}
</style>