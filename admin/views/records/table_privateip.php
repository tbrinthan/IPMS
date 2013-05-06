
<style type="text/css">
    #privateTable tbody tr:nth-child(even) {background: #f3f3f3}
    #privateTable tbody tr:nth-child(odd) {background: #FFF}
</style>

<div class="content-box" xmlns="http://www.w3.org/1999/html">
    <div class="content-box-header">
        <h3><?php echo $title;?></h3>
        <div class="clear"></div>
    </div>

    <div class="content-box-content">

        <table id="privateTable">
    <thead>
    <tr>
        <th>Category</th>
        <th>IP Address</th>
        <th>Subnet</th>
        <th>Assigned On</th>
        <th>Removed On</th>
        <th>Remarks</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $private_table = $this->records_model->get_customer_private();
    foreach ($private_table as $row) {
        ?>
    <tr id="<?php echo $row->pvt_ip_id; ?>">
        <td><?php echo $row->category_name; ?></td>
        <td><?php echo $row->ip_addresses; ?></td>
        <td style="text-align: center"><?php echo $row->subnet; ?></td>
        <td><?php echo $row->from_date; ?></td>
        <td><?php if(($row->to_date)!=null){echo $row->to_date;}else echo "In Use"; ?></td>
        <td><?php echo $row->remarks; ?></td>
    </tr>
        <?php }?>
    </tbody>
</table>
        </div>
        </div>


