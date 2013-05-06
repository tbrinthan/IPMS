<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

        <title>IP Management System</title>

        <link rel="stylesheet" href="<?php echo base_url(); ?>admin_resources/css/reset.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>admin_resources/css/style.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>admin_resources/css/invalid.css" type="text/css" media="screen" />
        <!--[if lte IE 7]>
                <link rel="stylesheet" href="resources/css/ie.css" type="text/css" media="screen" />
        <![endif]-->

        <script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/jquery-1.3.2.min.js"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/simpla.jquery.configuration.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/login.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>admin_resources/scripts/jquery.wysiwyg.js"></script>

        <!--[if IE 6]>
                <script type="text/javascript" src="resources/scripts/DD_belatedPNG_0.0.7a.js"></script>
                <script type="text/javascript">
                        DD_belatedPNG.fix('.png_bg, img, li');
                </script>
        <![endif]-->

        <script>
            var base_url = '<?php echo base_url(); ?>';
            var site_url = '<?php echo site_url(); ?>';
        </script>
    </head>

    <body id="login">
        
        <div id="login-wrapper" class="png_bg">
            <div id="login-top">
                
                <h1>IP Management System</h1>
                <!-- Logo (221px width) -->
                <img id="logo" src="<?php echo base_url(); ?>admin_resources/images/logo.png" alt="IPMS logo" />
            </div> <!-- End #logn-top -->
                
            <div id="login-content">
                <?php
                $attributes = array('id' => 'form1');
                //   echo form_open('login_controller/view_home', $attributes);
                ?>
                <form name="login" method="post">
                    <?php echo '<div id="login_msg" class="notification information png_bg">
                        <div > Click Sign in...!!!
                        </div>'
                    ?>
                    <p id="message"/>
            </div>
                
            <div id="userpwd" style="display: block;">
                <p>
                    <label>Username</label>
                    <input class="text-input" type="text" name="username" id="username"/>
                </p>
                <div class="clear"></div>
                <p>
                    <label>Password</label>
                    <input class= "text-input" type="password" id="password" name="password" />
                </p>
                    
                    
                <div style="padding-top:50px; ">    
                    <p>&nbsp;&nbsp;Forgot your password or username ? &nbsp;&nbsp;&nbsp;<a style="cursor:pointer;"onclick="viewForgetPWForm();">Click Here</a></p>
                    <p style="padding-top: 10px;" id="remember-password">
                        Remember me&nbsp;&nbsp;&nbsp<input type="checkbox" />
                        <input class="button" type="submit" value="Sign In" onclick="adminlogin()" />
                    </p>
                </div>
            </div>
            <div id="forgetPWform" style="display:none;" >
                <div style="padding-bottom: 30px;">
                    <label>Email</label>
                    <input class="text-input" type="text" name="email" id="email"/>
                </div>
                <div style="padding-top:20px;">
                    <table >
                        <tr  >
                            <td >
                                <input style="margin-left: 90px; height: 30px; width: 80px; font-variant:small-caps; "   type="button" class="button" value="Reset"  onclick="resetPasswordmail();" />
                            </td>
                            
                            <td>
                                <input style="margin-left: 30px;height: 30px; width: 80px; font-variant:small-caps; "   type="button" class="button" value="Back"   onclick="history.go(0);" />
                            </td>
                        </tr>
                       
                        
                    </table>
                    
                    <div class="clear"></div>
                    
            </div>
            </div>
                
                                                  

                  </form>

    </div> <!-- End #login-wrapper -->

    </body>


</html>
