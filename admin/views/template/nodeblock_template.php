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

		<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>admin_resources/css/invalid.css" type="text/css" media="screen" />



		<!-- Internet Explorer Fixes Stylesheet -->

		<!--[if lte IE 7]>
			<link rel="stylesheet" href="<?php echo base_url(); ?>admin_resources/css/ie.css" type="text/css" media="screen" />
		<![endif]-->

		<!--                       Javascripts                       -->

		<!-- jQuery -->
		<script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/jquery-1.3.2.min.js"></script>

		<!-- jQuery Configuration -->
		<script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/simpla.jquery.configuration.js"></script>

		<!-- Facebox jQuery Plugin -->
		<script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/facebox.js"></script>

		<!-- jQuery WYSIWYG Plugin -->
		<script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/jquery.wysiwyg.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/jquery.validate.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/jquery.alerts.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/jquery.date.js"></script>


    <!-- jQuery Datepicker Plugin -->
		<script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/jquery.datePicker.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/jquery.date.js"></script>
		<!--[if IE]><script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/jquery.bgiframe.js"></script><![endif]-->
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/script.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/users.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/ippool.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/category.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/ipblock.js"></script>

    <!-- Internet Explorer .png-fix -->

		<!--[if IE 6]>
			<script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/DD_belatedPNG_0.0.7a.js"></script>
			<script type="text/javascript">
				DD_belatedPNG.fix('.png_bg, img, li');
			</script>
		<![endif]-->

	</head>

<body>

    <div id="main-content">
        <div class="clear"></div> <!-- End .clear -->

			 <!-- End .content-box -->

             <?php echo $content;?>




			 <!-- End .content-box -->

			 <!-- End .content-box -->
			<div class="clear"></div>


		</div> <!-- End #main-content -->
		
	</body>
  

</html>
