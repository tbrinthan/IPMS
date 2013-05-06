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
                <th>Links/Service</th>

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
                    <?php 
            if ($row->link != '0') {
                        echo "Links(" . $row->link . ") -- " . $row->ltown;
                    } else {
                        if (strtolower($row->identify) == "none" || $row->identify == "")
                            echo $row->service_name;
                        else
                            echo $row->service_name . "  " . $row->identify;
                    }
            ?>
                </td>
            </tr>
                <?php
            }
    ?>
            </tbody>
        </table>
    </div>
</div>