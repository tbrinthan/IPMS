<div class="content-box"><!-- Start Content Box -->

<div class="content-box-header">

    <h3>Dash Board</h3>

    <ul class="content-box-tabs">
        <li><a href="#tab1" class="default-tab">Home</a></li> <!-- href must be unique and match the id of target div -->
        <li><a href="#tab2">Help</a></li>
        <li><a href="#tab3">About</a></li>

    </ul>

    <div class="clear"></div>

</div> <!-- End .content-box-header -->

<div class="content-box-content">

<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->

    <div class="notification attention png_bg">
        <a href="#" class="close"><img src="<?php echo base_url();?>admin_resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
        <div>
            This is a Content Box. You can put whatever you want in it. By the way, you can close this notification with the top-right cross.
        </div>
    </div>

    <h3>Welcome to IP Management System</h3>

    <p>This is IP Management System designed to maintain
    IP allocations.</p>

</div> <!-- End #tab1 -->


<div class="tab-content" id="tab2">

   This tab is Supposed to Provide information about the Project "IP Management System".

</div> <!-- End #tab2-->

<div class="tab-content" id="tab3">
    <img src="<?php echo base_url();?>admin_resources/images/b.jpg" width="300px" />
    <p>

    </p>
This Tab will HOpefully provide the Help  Required.
</div> <!-- End #tab3 -->
</div> <!-- End .content-box-content -->

</div>
<script type="text/javascript">
    $('#0').addClass('current');
</script>