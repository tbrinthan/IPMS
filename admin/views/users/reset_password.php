
 
<style type="text/css">
.content-box-header1 {
                background: #e5e5e5 url('../images/bg-content-box.gif') top left repeat-x;
                margin-top: 1px;
                height: 40px;
                }

.content-box-header1 h3 {
                padding: 12px 15px 10px;
                float: left;
                }
</style>
<div class="content-box" xmlns="http://www.w3.org/1999/html"><!-- Start Content Box -->

            <div class="content-box-header1">

                <h3><?php echo $title?></h3>
                
                <div class="clear"></div>

            </div> <!-- End .content-box-header -->

            <div class="content-box-content">

                <!-- End #tab1 -->

                <form action="" method="post" name="resetpwd" id="resetpwd">
                    <fieldset>
                        <p>
                            <label> New Password </label><input class="text-input small-input" type="password" id="new_resetpwd" name="new_resetpwd"/> </br>
                            <span id="pwd_check"></span> 
                        </p>

                        <p>
                            <label> Confirm Password </label><input class="text-input small-input" type="password" id="confirm_resetpwd" name="confirm_resetpwd" /> </br>
                                <span id="cpwd_check"></span>
                        </p>
                        
                        <p id="error_pwd"></p>

                    </fieldset>
                    <input type="hidden" name="token" id="token" value="<?php echo $token?>"/>

                    <input type="button" class="button" value="Change" onclick="resetPassword();"/>

                    <span id="user_pw_change_msg"></span>

                </form>


            </div> <!-- End .content-box-content -->

        </div> <!-- End .content-box -->
<script type="text/javascript">
$(document).ready(function(){

            $('#new_resetpwd').change(function(){
                var pwd=$('#new_resetpwd').val();
                if(pwd.length<6){
                    $("#pwd_check").html('<font color="red">Password should have atleast <strong>6</strong> characters.</font>');
                }else{
                    $("#pwd_check").html('');

                }
            });
            $('#confirm_resetpwd').change(function(){
                var pwd=$('#new_resetpwd').val();
                var cpwd=$('#confirm_resetpwd').val();
                if(cpwd!=pwd){
                    $("#cpwd_check").html('<font color="red">Password and Confirm password did not match!</font>');
                }else{
                    $("#cpwd_check").html('');
                }
            });

        });
 
</script>