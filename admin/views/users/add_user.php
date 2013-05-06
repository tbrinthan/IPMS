<div class="content-box"><!-- Start Content Box -->

<div class="content-box-header">

    <h3><?php echo $title?></h3>


    <div class="clear"></div>

</div> <!-- End .content-box-header -->

<div class="content-box-content">


    <form action="#" method="post" id="userform">

        <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->


            <p>
                <label>User Type</label>

                <select id="cmbUserType" name="cmbUserType" class="small-input" >
                    <option value="0">Please Select</option>
                    <?php
                    foreach ($user_types->result() as $row){ ?>


                                <option  value="<?php echo trim($row->group_id);?>"><?php echo trim($row->group_name); ?></option>
                                <?php } ?>


                </select>

                <div id="error_utype"></div>
            </p>

            <p>
                <label>Full Name*</label>
                <input class="text-input medium-input " type="text" id="txtfName" name="txtfName" />
                <div id="error_fname"></div>
            </p>

            <p>
                <label>User Name*</label>
                <input class="text-input medium-input " type="text" id="txtuName" name="txtuName" />
                <span id="status"></span>
                <div id="error_uname"></div>
            </p>

            <p>
                <label>Password*</label>
                <input class="text-input medium-input " type="password" id="txtPassword" name="txtPassword" />
                <span id="pwdcheck"></span>
                <div id="error_password"></div>
            </p>

            <p>
                <label>Confirm Password*</label>
                <input class="text-input medium-input " type="password" id="txtCPassword" name="txtCPassword" />
                <div id="error_cpassword"></div>
            </p>

            <p>
                <label>Email*</label>
                <input class="text-input medium-input " type="text" id="txtEmail" name="txtEmail" />
                <div id="error_email"></div>
            </p>

            <p id="error_add_user">

            </p>
            <p id="submitusers">
                <input class="button" type="button" value="Add User" onclick="add_user()"/>
            </p>

        </fieldset>

        <div class="clear"></div><!-- End .clear -->

    </form>

</div> <!-- End .content-box-content -->

</div>

<script type="text/javascript">
    $('#1').addClass('current');
</script>


    <script type="text/javascript">

        pic1 = new Image(16, 16);
        pic1.src = "<?php echo base_url();?>admin_resources/images/loader.gif";

        $(document).ready(function(){

            $("#txtuName").change(function() {

                var usr = $("#txtuName").val();

                if(usr.length >= 4)
                {
                    $("#status").html('<img src="<?php echo base_url();?>admin_resources/images/loader.gif" align="absmiddle">&nbsp;Checking availability...');

                    $.ajax({
                        type: "POST",
                        url: site_url+"/user_controller/check_username",
                        data: "u_name="+ usr,
                        success: function(msg){

                            $("#status").ajaxComplete(function(event, request, settings){

                                if(msg == 'OK')
                                {

                                    $(this).html('&nbsp;<img src="<?php echo base_url();?>admin_resources/images/tick.gif" align="absmiddle">');
                                }
                                else
                                {

                                    $(this).html(msg);
                                }

                            });

                        }

                    });

                }
                else
                {
                    $("#status").html('<font color="red">The username should have at least <strong>4</strong> characters.</font>');

                }

            });
            
            $('#txtPassword').change(function(){
                var pwd=$('#txtPassword').val();
                if(pwd.length<6){
                    $("#pwdcheck").html('<font color="red">Password should have atleast <strong>6</strong> characters.</font>');
                }else{
                    $("#pwdcheck").html('');

                }
            });

        });

    </script>
