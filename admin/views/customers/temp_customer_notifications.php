<style type="text/css">
    #nodeTable tbody tr:nth-child(even) {background: #f3f3f3}
    #nodeTable tbody tr:nth-child(odd) {background: #FFF}
</style>
<script type="text/javascript">


    $(document).bind('beforeReveal.facebox', function() {

        var padding = parseInt($('#facebox .body').css('padding-left'))
            + parseInt($('#facebox .body').css('padding-right'))
            + parseInt($('#facebox .tl').width())
            + parseInt($('#facebox .tr').width());

        var offset = 20;

        $('#facebox').css('left', '0px');
        $('#facebox .body').width( ($(window).width()/2 - padding - offset) + 'px' );
//        $('#facebox .body').height( ($(window).width()/2 - padding - offset) + 'px' );

    });
</script>

<div id="notifications"> <!-- Messages are shown when a link with these attributes are clicked: href="#messages" rel="modal"  -->

    <div class="content-box" xmlns="http://www.w3.org/1999/html"><!-- Start Content Box -->
        <div class="content-box-header">
            <h3>..:: Notifications ::..
            [ <?php echo date('Y-m-d');?> ]</h3>

            <div class="clear"></div>
        </div> <!-- End .content-box-header -->

        <div class="content-box-content">
            <table id="nodeTable">
                <thead>
                <tr>
                    <th style="text-align: center;">ID&nbsp;</th>
                    <th>Temp Allocation </th>
                    <th style="text-align: center;">Connection Type</th>
                    <th>Bandwidth</th>
                    <th>Address</th>
                    <th>Assigned on</th>
                    <th>Termination Date</th>

                </tr>
                </thead>
                <tbody>
                <?php foreach ($temp_allocation as $row) { ?>
                <tr id="<?php echo "temp_customer_".$row->customer_id; ?>">
                    <td style="text-align: center;"><?php echo $row->customer_id;?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td><b><?php echo  "<a style=\"cursor:pointer;\" id=\"chooseCustomer\" onclick=\"get_TempCustDetail(".$row->customer_id.")\" >".$row->customer_name."</a>";?></td></b>
                    <td style="text-align: center;"><?php echo $row->connection_name; ?>&nbsp;&nbsp;</td>
                    <td><?php echo $row->bandwidth; ?>&nbsp;&nbsp;</td>
                    <td><?php echo $row->address; ?>&nbsp;&nbsp;</td>
                    <td><?php echo $row->from_date;?></td>
                    <td><?php echo $row->end_date;?></td>
                </tr>
                    <?php
                }
//    ?>
                </tbody>
            </table>

        </div>

    </div>


    <a href="#" class="remove-link" style="float: right;" title="Remove ">Notification Panel Displays the Expiring Temporary Allocations.</a>








</div> <!-- End #messages -->