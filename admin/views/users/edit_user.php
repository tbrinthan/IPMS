<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        <h3><?php echo $title; ?></h3>

        <div class="clear"></div>
    </div> <!-- End .content-box-header -->

    <div class="content-box-content">
        <div id="error_add_user"></div>
        <form action="#" method="post">
            <fieldset>

                <p>
                    <label>User Type</label>

                    <select id="cmbUserType" name="cmbUserType" class="small-input" >
                        <option value="">Please Select</option>
                        <?php

                        foreach ($user_types->result() as $row){ ?>


                            <option <?php if($row->group_id==$group_id){echo 'selected="selected"';}?>value="<?php echo trim($row->group_id);?>"><?php echo trim($row->group_name); ?></option>
                            <?php } ?>


                    </select>
                </p>

                <p>
                    <label>Full Name</label>
                    <input class="text-input medium-input" type="text" id="txtfName" name="fxtuName" value="<?php echo $fullname ?>"/>
                </p>


                <p>
                    <label>User Name</label>
                    <input class="text-input medium-input" type="text" id="txtuName" name="txtuName" value="<?php echo $username ?>" />
                </p>

                <p>
                    <label>Email</label>
                    <input class="text-input medium-input" type="text" id="txtEmail" name="txtEmail" value="<?php echo $email ?>" />
                    <input type="hidden" id="user_id" value='<?php echo $user_id?>'>

                </p>



                <p><div id="add_user_msg"></div></p>

                <p>
                    <input class="button" type="button" value="Save" onclick="edit_user();" />
                    <input class="button" type="button" value="Back" onclick="history.go(-1)" />
                </p>

            </fieldset>
            <div class="clear"></div><!-- End .clear -->
        </form>
    </div>
</div>

<script type="text/javascript">
    $('#1').addClass('current');
</script>
