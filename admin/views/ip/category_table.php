<script type="text/javascript">
    $('.check-all').click(
        function(){
            $(this).parent().parent().parent().parent().find("input[type='checkbox']").attr('checked', $(this).is(':checked'));
        }
    );
        simpla_datatable.dt2();
        simpla_datatable.dt_actions_fb();
</script>

<div id="container">
    
    
    <table id="dt2" class="display">
        <p style="margin-top: 40px;text-align: center;font-weight: bold;font-size: 1.2em"><?=$title?></p>

        <thead style="font-variant: small-caps ;">
        <tr>
            <th style="text-align: center">Ip id</th>
            <th style="text-align: center">Category</th>
            <th style="text-align: center">Sub category</th>
            <th style="text-align: center">IP Address</th>
            <th style="text-align: center">Subnet</th>
            <th style="text-align: center">Status</th>
            <th style="text-align: center">Action</th>

        </tr>

        </thead>
        <tbody>

        <?php
        $subcatdetail=$this->ipblock_model->get_subcategoryip_new();
        foreach($subcatdetail->result() as $row){?>
        <tr id=<?=$row->ip_id?>>
            <td style="text-align: center"><?=$row->ip_id?></td>
            <td style="text-align: center"><?=$row->category_name?></td>
            <td style="text-align: center"><?=$row->ssid?></td>
            <td style="text-align: center" ><?=$row->ip_addresses?></td>
            <td style="text-align: center" ><?=$row->subnet?></td>
            <td style="text-align: center"><?php if($row->customer_id && $row->to_date ==NULL){?>
                <img src = "<?php echo base_url();?>admin_resources/images/icons/notavailable.png" title="Not Available" /><?php }
            else{?>  <img src = "<?php echo base_url();?>admin_resources/images/icons/available.png" title="Available" /><?php }
                ?>
            </td>
            <td style="text-align: center">
                <a style="cursor: pointer;"title="Details"  onclick="openCategoryDetails(<?=$row->ip_id?>)"   ><img src="<?php echo base_url(); ?>admin_resources/images/icons/information.png" alt="View Details"  /></a>
<!--                <a style="cursor: pointer;"title="Edit"  onclick="editCategoryDetails()"   ><img src="<?php echo base_url(); ?>admin_resources/images/icons/pencil.png" alt="Edit"  /></a>-->
                <?php if($row->customer_id){?>
                <a style="cursor:pointer;" title="Delete" onclick="alert('Cannot Delete Customer Assigned!')"><img src="<?php echo base_url(); ?>admin_resources/images/icons/cross.png" alt="Delete" /></a><?php }
            else{?> <a style="cursor:pointer;" title="Delete" onclick="deleteCategoryDetails(<?=$row->ip_id?>)"><img src="<?php echo base_url(); ?>admin_resources/images/icons/cross.png" alt="Delete" /></a><?php }
                ?>
            </td>

        </tr>
            <?php }
        ?>


        </tbody>

    </table>
</div>


<style type="text/css">
    #container tbody tr:nth-child(even) {background: #f3f3f3}
    #container tbody tr:nth-child(odd) {background: #FFF}
</style>