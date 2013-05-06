<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>IP Address</th>
        <th>Parent_Subnet</th>
        <th>Type</th>
        <th>Customer</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($node_ip_details as $row) { ?>
    <tr id="<?php echo $row->node_detail_id; ?>">
        <td><?php echo $row->ip_id;?></td>
        <td><?php echo $row->ip_addresses ;?></td>
        <td  style="text-align: center"><?php echo $row->parent_subnet; ?></td>
        <td><?php if($row->Type_name != NULL) echo $row->Type_name; else echo "Free";?> </td>
        <td><?php if($row->customer_name != NULL) echo $row->customer_name;else echo "Free";?> </td>
        <td  style="text-align: center"><?php if($row->type_id != NULL || $row->customer_id != NULL){
            echo "<img src = \""?><?php echo base_url();?><?php echo "admin_resources/images/icons/notavailable.png\" alt=\"Not Available\"  />"; }
        else{
            echo "<img src = \""?><?php echo base_url();?><?php echo "admin_resources/images/icons/available.png\" alt=\"Available\"  />"; }
            ?></td>
    </tr>
        <?php
    }
    ?>
    </tbody>
</table>