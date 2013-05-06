<style type="text/css">
    #nodeTable tbody tr:nth-child(even) {background: #f3f3f3}
    #nodeTable tbody tr:nth-child(odd) {background: #FFF}
</style>
<div class="content-box" xmlns="http://www.w3.org/1999/html">
      <div class="content-box-header">
       <h3><?php echo $title;?></h3>
       <div class="clear"></div>
   </div>
       <div class="content-box-content">
<table id="nodeTable">
    <thead>
    <tr>
        <th>ID</th>
        <th>IP Address</th>
        <th>Subnet</th>
        <th>Type</th>
        <th>Node Location</th>
        <th>Assigned on</th>
        <th>Links/Service</th>

    </tr>
    </thead>
    <tbody>
    <?php foreach ($assigned_nodeip_details as $row) { ?>
    <tr id="<?php echo "node".$row->node_detail_id; ?>">
        <td><?php echo $row->node_detail_id;?></td>
        <td><b></b><?php echo $row->ip_addresses ;?></td></b>
        <td><?php echo $row->parent_subnet; ?></td>
        <td><?php echo $row->Type_name; ?></td>
        <td><?php echo $row->location." - ".$row->ssid;?></td>
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