<script type="text/javascript">
    simpla_datatable.dt2();
    simpla_datatable.dt_actions_fb();
    
</script>

<div class="content-box"><!-- Start Content Box -->

<div class="content-box-header">

    <h3>User Details</h3>

</div> <!-- End .content-box-header -->

<div class="content-box-content">

<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->

    <table id="dt2" class="display">

        <thead>
        <tr>
            <th>Full Name</th>
            <th>User Name</th>
            <th>User Type</th>
            <th>Email</th>
            <th>Action</th>
        </tr>

        </thead>



        <tbody>


        <?php
        $users=$this->user_model->get_users();
        foreach ($users as $row)
        {

            echo '<tr id='.$row["user_id"].'><td>' .$row["fullname"].'</td><td>'. $row["username"]. '</td><td>' . $row["group_name"]. '</td><td>'.$row["email"].'</td>';

            echo '<td><a href="'.base_url().'index.php/user_controller/edit_user/'.$row["user_id"].'" title="Edit"><img src='.base_url().'admin_resources/images/icons/pencil.png alt="Edit" /></a>';
            echo "&nbsp;&nbsp;&nbsp;";
            echo '<a style="cursor:pointer;" title="Delete This User" onclick="deleteUser('.$row["user_id"].','.$row["user_id"].')"><img src='.base_url().'admin_resources/images/icons/cross.png alt="Delete" /></a>';
            echo "&nbsp;&nbsp;&nbsp;";
            echo '<a href="#" title="Change privileges"><img src='.base_url().'admin_resources/images/icons/hammer_screwdriver.png alt="Edit" /></a>';
            echo '</td></tr>';

        }
        
   
//
//        foreach ($result->result() as $row)
//        {
//
//            echo '<tr><td><input type="checkbox"/><td>' . $row->username. '</td><td>' . $row->group_name. '</td><td>'.$row->email.'</td>';
//            echo '<td><a href="#" title="Edit"><img src='.base_url().'admin_resources/images/icons/pencil.png alt="Edit" /></a>';
//            echo '<a href="#" title="Edit"><img src='.base_url().'admin_resources/images/icons/cross.png alt="Delete" /></a>';
//            echo '<a href="#" title="Edit"><img src='.base_url().'admin_resources/images/icons/hammer_screwdriver.png alt="Edit" /></a>';
//
//            echo '</td></tr>';
//
//        }

//          print_r($result);
        ?>


        </tbody>

    </table>

</div> <!-- End #tab1 -->

</div> <!-- End .content-box-content -->

</div>

<script type="text/javascript">
    $('#1').addClass('current');
</script>
