<script type="text/javascript">
    $('.check-all').click(
        function(){
            $(this).parent().parent().parent().parent().find("input[type='checkbox']").attr('checked', $(this).is(':checked'));
        }
    );
        simpla_datatable.dt_customer2();
        simpla_datatable.dt_actions_fb();
</script>
<div class="content-box"><!-- Start Content Box -->

    <div class="content-box-header">

        <h3><?=$title?></h3>

    </div> <!-- End .content-box-header -->

    <div class="content-box-content">

        <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
            <table id="dt_customer2" class="display mobile_dt2 dt_act">

                <thead>
                <tr>
                    <th><input class="chSel_all" type="checkbox" /></th>
                    <th></th>
                    <th >IP Address</th>
                    <th>Subnet</th>
                    <th>Customer</th>
                    <th>Status</th>


                </tr>

                </thead>

                <tbody>
                <?php
                foreach ($category_ip_details as $row) { ?>
                <tr id="<?php echo $row->ip_id; ?>">
                    <?php if($row->name == NULL){?>
                    <td><input class="chb_col"type="checkbox" name="row_sel" id="checkbox" value="<?php echo $row->ip_id;?>"/><td> <?php }
                else {?>
                    <td></td>
                    <td></td>

                    <?php }?>
                    <td><?php echo $row->ip_addresses ;?></td>
                    <td  style="text-align: center;"><?php echo $row->subnet; ?></td>
                    <td><?php if($row->name != NULL) echo $row->name;else echo "Free";?> </td>
                    <td  style="text-align: center"><?php if($row->status==1 || $row->customer_id != NULL){
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
            <p></p>
            <p id="button">
                <input type="submit" class="button" value="Assign Service IP" style="float: right; height: 30Px;" align="middle" onclick="add_CategoryIP_to_Customer()"/>
            </p>
            <div class="clear"></div>

        </div> <!-- End #tab1 -->
    </div> <!-- End .content-box-content -->

</div>

<script type="text/javascript">
    $('#2').addClass('current');
</script>


