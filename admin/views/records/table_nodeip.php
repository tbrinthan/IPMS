
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
        <th>Type</th>
        <th>Location</th>
        <th>SSID</th>
        <th>IP Address</th>
        <th>Subnet</th>
        <th>Assigned On</th>
        <th>Removed On</th>
        <th>Remarks</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $node_table = $this->records_model->get_customer_node();
    foreach ($node_table as $row) {
        ?>
    <tr id="<?php echo $row->node_detail_id; ?>">
        <td><?php echo $row->type_name; ?></td>
        <td><?php echo $row->location; ?></td>
        <td><?php echo $row->ssid; ?></td>
        <td><?php echo $row->ip_addresses; ?></td>
        <td style="text-align: center"><?php echo $row->parent_subnet; ?></td>
        <td><?php echo $row->from_date; ?></td>
        <td><?php if(($row->to_date)!=null){echo $row->to_date;}else echo "In Use"; ?></td>
        <td><?php echo $row->remarks; ?></td>

    </tr>
        <?php }?>
    </tbody>
</table>
        </div>
        </div>


