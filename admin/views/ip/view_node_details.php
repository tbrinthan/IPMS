<script type="text/javascript">
    $('.check-all').click(
        function(){
            $(this).parent().parent().parent().parent().find("input[type='checkbox']").attr('checked', $(this).is(':checked'));
        }
    );
        $(document).ready(function(){
            simpla_datatable.dtnodedetail();
            simpla_datatable.dt_actions_fb();
        });
        
</script>


<div id="nodedetails" class="content-box" > <!-- Messages are shown when a link with these attributes are clicked: href="#messages" rel="modal"  -->
    <div class="content-box-content">
        <div class="content-box-header">
            <h3 style="text-align: center">Node Details </h3>
        </div>
        <div class="clear"></div>

        <table id="dtnodedetail" class="display mobile_dt2 dt_act" >

            <thead style="font-variant: small-caps ;">
            <tr>
                <th style="text-align: center">Parent Subnet</th>
                <th style="text-align: center">IP Addresses</th>
                <th style="text-align: center">Customer</th>
                <th style="text-align: center">Node Type</th>
                <th style="text-align: center">Date Assigned</th>
            </tr>

            </thead>
            <span></span>
            <tbody>
            <?php

            $nodedetails=$this->ipblock_model->get_nodedetails();
            foreach($nodedetails as $row){?>
            <tr>
                <td style="text-align: center;height: 30px;vertical-align: bottom;"><?=$row->parent_subnet;?></td>
                <td style="text-align: center;height: 30px;vertical-align: bottom;"><?=$row->ip_addresses;?></td>
                <td style="text-align: center;height: 30px;vertical-align: bottom;"><?php if($row->name!=null) echo $row->name;else echo "N/A";?></td>
                <td style="text-align: center;height: 30px;vertical-align: bottom;"><?php if($row->type_name!=null) echo $row->type_name;else echo "N/A";?></td>
                <td style="text-align: center;height: 30px;vertical-align: bottom;"><?php if($row->from_date!=null) echo $row->from_date;else echo "N/A";?></td>
            </tr>
                <?php }?>


            </tbody>



        </table>
        <p></p>
        <?php echo $page_link;?>
    </div> <!-- End #messages -->
</div>