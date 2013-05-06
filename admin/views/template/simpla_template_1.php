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



		<!-- Internet Explorer Fixes Stylesheet -->

		<!--[if lte IE 7]>-->
			<link rel="stylesheet" href="<?php echo base_url(); ?>admin_resources/css/ie.css" type="text/css" media="screen" />
		<!--<![endif]-->

		<!--                       Javascripts                       -->

		<!-- jQuery -->
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/jquery-1.4.2.min.js"></script>

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
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/login.js"></script>

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
    </script>
    
</head>

<body><div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->

    <div id="sidebar"><div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->

        <h1 id="sidebar-title"><a href="#">IP Management System</a></h1>

        <!-- Logo (221px wide) -->
        <a href="<?php echo site_url();?>/login_controller"><img id="logo" src="<?php echo base_url(); ?>admin_resources/images/logo.png" alt="IP Management System" /></a>

        <!-- Sidebar Profile links -->
   

        


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
        <p id="page-intro">What would you like to do?</p>

        <div class="clear"></div> <!-- End .clear -->

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
