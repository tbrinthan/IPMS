<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">


<head>

		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

			<title>IP Managment System</title>

		<!--                       CSS                       -->

		<!-- Reset Stylesheet -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>admin_resources/css/reset.css" type="text/css" media="screen" />

		<!-- Main Stylesheet -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>admin_resources/css/style.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>admin_resources/css/jquery-ui-1.8.13.custom.css" type="text/css" media="screen" />

    <!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>admin_resources/css/invalid.css" type="text/css" media="screen" />

<!--chosen-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>admin_resources/chosen/chosen.css" media="all" />

		<!-- Internet Explorer Fixes Stylesheet -->

		<!--[if lte IE 7]>-->
			<link rel="stylesheet" href="<?php echo base_url(); ?>admin_resources/css/ie.css" type="text/css" media="screen" />
		<!--<![endif]-->

		<!--                       Javascripts                       -->

		<!-- jQuery -->
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/jquery-1.7.2.min.js"></script>

    <!-- jQuery Configuration -->
		<script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/simpla.jquery.configuration.js"></script>

		<!-- Facebox jQuery Plugin -->
		<script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/facebox.js"></script>

		<!-- jQuery WYSIWYG Plugin -->
		<script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/jquery.wysiwyg.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/jquery.validate.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/jquery.alerts.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/jquery.date.js"></script>
    <!--    <script type="text/javascript" src="--><?php //echo base_url(); ?><!--admin_resources/scripts/jquery-ui-1.8.2.js"></script>-->
    <!--    <script type="text/javascript" src="--><?php //echo base_url(); ?><!--admin_resources/scripts/jquery.dataTables.min.js"></script>-->
    <!--    <script type="text/javascript" src="--><?php //echo base_url(); ?><!--admin_resources/scripts/jquery.dataTables.js"></script>-->


    <!-- jQuery Datepicker Plugin -->
<!--		<script type="text/javascript" src="--><?php //echo base_url(); ?><!--admin_resources/scripts/jquery.datePicker.js"></script>-->
<!--		<script type="text/javascript" src="--><?php //echo base_url(); ?><!--admin_resources/scripts/jquery.date.js"></script>-->
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/jquery.validate.js"></script>
    <!--[if IE]><script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/jquery.bgiframe.js"></script><![endif]-->
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/script.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/scripts.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/jquery-ui-1.8.13.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/category.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/ippool.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/ipblock.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/ipblock_view.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/customer.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/search.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/join_split.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/records.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/usage.js"></script>

    
    
 <!-- datatables -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>admin_resources/datatables/css/demo_table_jui.css" media="all" />
	<script src="<?php echo base_url(); ?>admin_resources/scripts/simpla_dt.js"></script>
	<script src="<?php echo base_url(); ?>admin_resources/datatables/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>admin_resources/datatables/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>admin_resources/datatables/js/dataTables.plugins.js"></script>
	<script src="<?php echo base_url(); ?>admin_resources/datatables/js/dataTables.plugins.js"></script>
	<script src="<?php echo base_url(); ?>admin_resources/datatables/extras/ColVis/media/js/ColVis.min.js"></script>
      
       <!--chosen-->
    <script src="<?php echo base_url(); ?>admin_resources/chosen/chosen.jquery.min.js"></script>
    
    <!--tooltips-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>admin_resources/qtip2/jquery.qtip.min.css" />
        <script src="<?php echo base_url(); ?>admin_resources/qtip2/jquery.qtip.min.js"></script>
    <!-- Internet Explorer .png-fix -->

		<!--[if IE 6]>-->
			<script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/DD_belatedPNG_0.0.7a.js"></script>
			<script type="text/javascript">
				DD_belatedPNG.fix('.png_bg, img, li');
			</script>
		<!--<![endif]-->

    <link rel="icon" type="image/ico" href="<?php echo base_url(); ?>admin_resources/images/icon/Network.ico"/>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>admin_resources/images/icons/Network.ico"/>
	
    <script type="text/javascript">
        var base_url = '<?php echo base_url();?>';
        var site_url = '<?php echo site_url();?>';
        $(document).ready(function(){
    if(!jQuery.browser.mobile){
                simpla_datatable.dt1();
                simpla_datatable.dt2();
                simpla_datatable.dt22();
                simpla_datatable.dt_customer1();
                simpla_datatable.dt_customer2();
                simpla_datatable.ct();
                simpla_datatable.dt_actions();
                simpla_datatable.dt_actions_fb();
                simpla_datatable.dte_1();
                simpla_datatable.dte_2();
            }else{
                simpla_datatable.mobile_dt();
            }
            
      $(".chzn-select").chosen({allow_single_deselect: true });
      simpla_tips.init();

});
        
    </script>
    
</head>

<body><div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->

    <div id="sidebar"><div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->

        <h1 id="sidebar-title"><a href="#">IP Management System</a></h1>

        <!-- Logo (221px wide) -->
        <a href="<?php echo site_url();?>/login_controller"><img id="logo" src="<?php echo base_url(); ?>admin_resources/images/logo.png" alt="IP Management System" /></a>

        <!-- Sidebar Profile links -->
        <div id="profile-links">
            Hello, <a href="#" title="Edit your profile"><?php echo $this->session->userdata('Name');?></a>&nbsp;||&nbsp;Your <a href="#" onclick="get_Notification()">Notifications</a><br />
            <br />
            <a href="<?php echo site_url();?>/login_controller/logout" title="Sign Out">Sign Out</a> | <a href="#" title="View the Site">View Site</a>
        </div>

        <ul id="main-nav">  <!-- Accordion Menu -->
            <li>
                <a id="6" class="nav-top-item no-submenu" href="<?php echo base_url();?>index.php/search_controller/MainSearch" <?php if(basename($_SERVER["PHP_SELF"])=='MainSearch'){}?>>Search</a>

            </li>
            <li>

                <a id="0" href="<?php echo base_url();?>index.php/login_controller/view_dashboard" class="nav-top-item no-submenu"> <!-- Add the class "no-submenu" to menu items with no sub menu -->
                    Dashboard
                </a>

            </li>
            <li>
                <a href="#" id="1" class="nav-top-item "> <!-- Add the class "no-submenu" to menu items with no sub menu -->
                    Users
                </a>
                <ul>
                    <li><a href="<?php echo base_url();?>index.php/user_controller/add_user" <?php if(basename($_SERVER["PHP_SELF"])=='add_user'){echo "class='current'";}?>>Create new user</a></li>
                    <li><a href="<?php echo base_url();?>index.php/user_controller/manage_user" <?php if(basename($_SERVER["PHP_SELF"])=='manage_user'){echo "class='current'";}?>>Manage Users</a></li> <!-- Add class "current" to sub menu items also -->
                </ul>
            </li>

            <li>
                <a href="#" id="2" class="nav-top-item "> <!-- Add the class "current" to current menu item -->
                    Customers
                </a>
                <ul>
                    <li><a href="<?php echo base_url();?>index.php/customer_controller/addNewCustomer"<?php if(basename($_SERVER["PHP_SELF"])=='addNewCustomer'){ echo "class='current'";}?>>Assign IPs to Customer</a></li>
                    <li><a href="<?php echo base_url();?>index.php/customer_controller/ViewCustomer"<?php if(basename($_SERVER["PHP_SELF"])=='ViewCustomer'){ echo "class='current'";}?>>View Customer Details</a></li>
                    <li><a href="<?php echo base_url();?>index.php/customer_controller/addTempCustomer"<?php if(basename($_SERVER["PHP_SELF"])=='addTempCustomer'){ echo "class='current'";}?>>Add Temporary Allocation</a></li>
                    <li><a href="<?php echo base_url();?>index.php/customer_controller/viewTempCustomer"<?php if(basename($_SERVER["PHP_SELF"])=='viewTempCustomer'){ echo "class='current'";}?>>View Temporary Allocation</a></li>
                </ul>
            </li>

            <li>
                <a href="#" id="3" class="nav-top-item">
                    IP Allocation
                </a>
                <ul>
                    <li><a href="<?php echo base_url();?>index.php/ip_controller/addIPPool"<?php if(basename($_SERVER["PHP_SELF"])=='addIPPool'){ echo "class='current'";}?>>Add / View IP Pool</a></li>
                    <li><a href="<?php echo base_url();?>index.php/category/addCategory"<?php if(basename($_SERVER["PHP_SELF"])=='addCategory'){ echo "class='current'";}?>>Add Category</a></li>
                    <li><a href="<?php echo base_url();?>index.php/category/modifyCategory"<?php if(basename($_SERVER["PHP_SELF"])=='modifyCategory'){ echo "class='current'";}?>>Modify Category</a> </li>
                    <li><a href="<?php echo base_url();?>index.php/ipblock_controller/add_ipblock"<?php if(basename($_SERVER["PHP_SELF"])=='add_ipblock'){ echo "class='current'";}?>>Assign IP Blocks</a></li>
                    <li><a href="<?php echo base_url();?>index.php/ipblock_controller/assigned_ipblocks"<?php if(basename($_SERVER["PHP_SELF"])=='assigned_ipblocks'){ echo "class='current'";}?>>View Assigned IP Blocks</a></li>
                    <li><a href="<?php echo base_url();?>index.php/join_split_controller/join_split_view"<?php if(basename($_SERVER["PHP_SELF"])=='join_split_view'){ echo "class='current'";}?>>Join / Split Network IPs</a></li>
                </ul>
            </li>

            <li>
                <a href="#" id="4" class="nav-top-item">
                    Records
                </a>
                <ul>
                    <li><a href="<?php echo base_url();?>index.php/records/customer_records"<?php if(basename($_SERVER["PHP_SELF"])=='customer_records'){ echo "class='current'";}?>>View Records</a></li>
                    <li><a a href="<?php echo base_url();?>index.php/usage_controller/node_usage"<?php if(basename($_SERVER["PHP_SELF"])=='node_usage'){ echo "class='current'";}?>>Node Usage</a></li>
                    <li><a a href="<?php echo base_url();?>index.php/usage_controller/block_usage"<?php if(basename($_SERVER["PHP_SELF"])=='block_usage'){ echo "class='current'";}?>>IP Block Usage</a></li>
                    <li><a a href="<?php echo base_url();?>index.php/usage_controller/pool_usage"<?php if(basename($_SERVER["PHP_SELF"])=='pool_usage'){ echo "class='current'";}?>>IP Pool Usage</a></li>
                </ul>
            </li>

        </ul> <!-- End #main-nav -->



    </div></div> <!-- End #sidebar -->

    <div id="main-content"> <!-- Main Content Section with everything -->

        <noscript> <!-- Show a notification if the user has disabled javascript -->
            <div class="notification error png_bg">
                <div>
                    Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
                    Download From <a href="http://www.exet.tk">exet.tk</a></div>
            </div>
        </noscript>

        <!-- Page Head -->
        <h2>Welcome <?php echo $this->session->userdata('Name'); ?></h2>
<!--        <p id="page-intro">What would you like to do?</p>-->
        <div>
        <ul class="shortcut-buttons-set">

            <li><a class="shortcut-button" href="<?php echo base_url();?>index.php/customer_controller/addNewCustomer"<?php if(basename($_SERVER["PHP_SELF"])=='addNewCustomer'){ echo "class='current'";}?> style="font-family: sans-serif;font-variant: small-caps;font-weight: bold;"><span>
                       <!--<img src="<?php // echo base_url();?>admin_resources/images/icons/pencil_48.png" alt="icon" /><br />-->
                       Assign Customers
                   </span></a></li>

                   <li><a class="shortcut-button" href="<?php echo base_url();?>index.php/ipblock_controller/add_ipblock"<?php if(basename($_SERVER["PHP_SELF"])=='add_ipblock'){ echo "class='current'";}?> style="font-family: sans-serif;font-variant: small-caps;font-weight: bold;"><span>
                       <!--<img src="<?php // echo base_url();?>admin_resources/images/icons/paper_content_pencil_48.png" alt="icon" /><br />-->
                       Assign IP Blocks
                   </span></a></li>

                   <li><a class="shortcut-button" href="<?php echo base_url();?>index.php/ipblock_controller/assigned_ipblocks"<?php if(basename($_SERVER["PHP_SELF"])=='assigned_ipblocks'){ echo "class='current'";}?> style="font-family: sans-serif;font-variant: small-caps;font-weight: bold;"><span>
                       <!--<img src="<?php // echo base_url();?>admin_resources/images/icons/image_add_48.png" alt="icon" /><br />-->
                       View IP Blocks
                   </span></a></li>

                   <li><a class="shortcut-button" href="<?php echo base_url();?>index.php/join_split_controller/join_split_view"<?php if(basename($_SERVER["PHP_SELF"])=='join_split_view'){ echo "class='current'";}?> style="font-family: sans-serif;font-variant: small-caps;font-weight: bold;"><span>
                       <!--<img src="<?php // echo base_url();?>admin_resources/images/icons/clock_48.png" alt="icon" /><br />-->
                      Join & Split Networks
                   </span></a></li>

                   <li><a class="shortcut-button" href="<?php echo base_url();?>index.php/usage_controller/pool_usage"<?php if(basename($_SERVER["PHP_SELF"])=='pool_usage'){ echo "class='current'";}?> style="font-family: sans-serif;font-variant: small-caps;font-weight: bold;"><span>
                       <!--<img src="<?php // echo base_url();?>admin_resources/images/icons/comment_48.png" alt="icon" /><br />-->
                       IP Pool Usage
                   </span></a></li>

        </ul> <!-- End .shortcut-buttons-set -->
        </div>
        <div class="clear"></div> <!-- End .clear 

			 <!-- End .content-box -->

             <?php echo $content;?>




			 <!-- End .content-box -->

			 <!-- End .content-box -->
			<div class="clear"></div>

















			<div id="footer">
				<small> <!-- Remove this notice or replace it with whatever you want -->
						&#169; Copyright 2011 CSSL JOBS | Powered by <a href="http://www.lankacom.net" target="_new">LCS</a> | <a href="#">Top</a>
				</small>
			</div><!-- End #footer -->

		</div> <!-- End #main-content -->
		
	</div></body>
  

</html>
