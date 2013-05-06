<script type="text/javascript">
    $('.check-all').click(
        function(){
            $(this).parent().parent().parent().parent().find("input[type='checkbox']").attr('checked', $(this).is(':checked'));
        }
    );
</script>

<div class="content-box"><!-- Start Content Box -->

    <div class="content-box-header">

        <h3><?=$title?></h3>

    </div> <!-- End .content-box-header -->

    <div class="content-box-content">

        <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
            <table>

                <thead>
                <tr>
                    <th><input class="check-all" type="checkbox" /></th>
                    <th>Parent IP_block</th>
                    <th>IP_block</th>
                    <th>Subnet</th>

                </tr>

                </thead>

                <tbody>
                <?php
                $blocks = $this->ipblock_model->get_nodeblocks();
                foreach ($blocks->result() as $row) {

                    echo '<tr id=' . $row->sub_pool_id . '><td><input type="checkbox" name="checkbox[]" id="checkbox" value="'.$row->sub_pool_id.'"/><td>' . $row->pool_values . '</td><td>' . $row->sub_pool_values . '</td><td>' . $row->subnet . '</td></tr>';

                }
                ?>
                </tbody>
            </table>
            <p id="button">
            <input type="submit" class="button" value="Add" style="float: right;" onclick="node_blocks()"/>
            </p>

        </div> <!-- End #tab1 -->

    </div> <!-- End .content-box-content -->

</div>

<script type="text/javascript">
    $('#3').addClass('current');
</script>


