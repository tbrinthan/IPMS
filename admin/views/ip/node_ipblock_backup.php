<head>
    <link rel="stylesheet" href="<?php echo base_url(); ?>admin_resources/css/style.css" type="text/css" media="screen" />
</head>


<h3><?php echo $title; ?></h3>

</div> <!-- End .content-box-header -->

<div>

    <fieldset>
        <table border="2">

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
                $blocks = $this->ipblock_model->get_primarysubpool();
                foreach ($blocks->result() as $row) {

                    echo '<tr id=' . $row->sub_pool_id . '><td><input type="checkbox"/><td>' . $row->pool_values . '</td><td>' . $row->sub_pool_values . '</td><td>' . $row->subnet . '</td></tr>';
                }
                ?>


            </tbody>

        </table>
    </fieldset>


    <script type="text/javascript">
        $('#3').addClass('current');
    </script>
