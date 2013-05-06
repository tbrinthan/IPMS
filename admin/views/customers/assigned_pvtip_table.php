<style type="text/css">
    #pvtTable tbody tr:nth-child(even) {background: #f3f3f3}
    #pvtTable tbody tr:nth-child(odd) {background: #FFF}
</style>

<div class="content-box" xmlns="http://www.w3.org/1999/html">
    <div class="content-box-header">
        <h3><?php echo $title;?></h3>
        <div class="clear"></div>
    </div>
    <div class="content-box-content">
        <table id="pvtTable">
            <thead>
            <tr>
                <th>ID</th>
                <th>IP Address</th>
                <th>Subnet</th>
                <th>Assigned on</th>
                <th>Delete</th>

            </tr>
            </thead>
            <tbody>
            <?php foreach ($assigned_pvtip_details as $row) { ?>
            <tr id="<?php echo "pvtip".$row->pvt_ip_id; ?>">
                <td><?php echo $row->pvt_ip_id;?></td>
                <td><b></b><?php echo $row->ip_addresses ;?></td></b>
                <td><?php echo $row->subnet; ?></td>
                <td><?php echo $row->from_date;?></td>
                <td>
                    <a style="cursor:pointer;" title="Delete PvtIP" onclick="delete_AssignedPrivateIP(<?php echo $row->pvt_ip_id ?>,<?php echo $row->pvt_ip_id?>)">
                        <img src="<?php echo base_url(); ?>admin_resources/images/icons/cross.png" alt="Delete" /></a>
                    </td>
            </tr>
                <?php
            }
    ?>
            </tbody>
        </table>
    </div>
</div>