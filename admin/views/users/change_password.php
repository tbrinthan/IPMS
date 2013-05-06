<div class="content-box"><!-- Start Content Box -->

    <div class="content-box-header">

        <h3><?php echo $title?></h3>



        <div class="clear"></div>

    </div> <!-- End .content-box-header -->

    <div class="content-box-content">

            <div  id="ajaxld">

                <form name="changepwd">

                    <p>
                        <label>Old Password</label>
                        <input class="text-input small-input" type="password" id="old_password" />  <!-- Classes for input-notification: success, error, information, attention -->
                        <!--<br /><small>A small description of the field</small>-->
                    </p>

                    <p>
                        <label>New Password</label>
                        <input class="text-input small-input" type="password" id="new_password" />  <!-- Classes for input-notification: success, error, information, attention -->
                        <!--<br /><small>A small description of the field</small>-->
                    </p>

                    <p>
                        <label>Confirm new Password</label>              
                        <input class="text-input small-input" type="password" id="c_new_password" />
                    </p>
                </form>
                <p id="chpw_msg"></p>

                <p>
                    <input class="button" type="submit" value="Change" onclick="" />
                </p>

            </div>
    <!-- End #tab2 -->        

    </div> <!-- End .content-box-content -->

</div> <!-- End .content-box -->
