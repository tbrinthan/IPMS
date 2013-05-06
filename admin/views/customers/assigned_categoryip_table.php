<style type="text/css">
    #catTable tbody tr:nth-child(even) {background: #f3f3f3}
    #catTable tbody tr:nth-child(odd) {background: #FFF}
</style>
<div class="content-box" xmlns="http://www.w3.org/1999/html">
    <div class="content-box-header">
        <h3><?php echo $title;?></h3>
        <div class="clear"></div>
    </div>
    <div class="content-box-content">
        <table id="catTable">
            <thead>
            <tr>
                <th>ID</th>
                <th>IP Address</th>
                <th>Subnet</th>
                <th>Service Category</th>
                <th>SubCategory</th>
                <th>Assigned on</th>
                <th>Delete</th>

            </tr>
            </thead>
            <tbody>
            <?php foreach ($assigned_categoryip_details as $row) { ?>
            <tr id="<?php echo "categoryip".$row->ip_id; ?>">
                <td><?php echo $row->ip_id;?></td>
                <td><b></b><?php echo $row->ip_addresses ;?></td></b>
                <td><?php echo $row->subnet; ?></td>
                <td><?php echo $row->category_name;?></td>
                <td><?php echo $row->ssid;?></td>
                <td><?php echo $row->from_date;?></td>
                <td>
                    <?php if($row->from_date == date("Y-m-d")){?>
                    <a style="cursor:pointer;" title="Delete CategoryIP" onclick="delete_AssignedCategoryIP(<?php echo $row->ip_id ;?>,<?php echo $row->ip_id;?>)">
                        <img src="<?php echo base_url(); ?>admin_resources/images/icons/cross.png" alt="Delete" /></a>
                    <?php } else{?>
                    <a style="cursor:pointer;" title="Delete CategoryIP" onclick="delete_AlreadyAssignedCategoryIP(<?php echo $row->ip_id; ?>,<?php echo $row->ip_id;?>)">
                        <img src="<?php echo base_url(); ?>admin_resources/images/icons/cross.png" alt="Delete" /></a>

                    <?php }?></td>
                </td>
            </tr>
                <?php
            }
    ?>
            </tbody>
        </table>
    </div>
</div>