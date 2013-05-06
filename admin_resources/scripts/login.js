//var site_url = "http://localhost/IPMS_ver_1/index.php/";
function adminlogin() {
    //alert(1);

    $('#login_msg').html('<span class="input-notification information png_bg">Validating...</span>');

    var username = $('#username').val();
    var password = $('#password').val();
    //  $('#login_msg').html('<span class="input-notification error png_bg">validating...</span>');
    $.ajax({
        type: "POST",
        url: site_url + "/login_controller/login_in",
        data: "username=" + username + "&password=" + password,
        async: false,
        success: function (msg) {
            //  alert(msg);
            if (msg == 1) {
                $('#login_msg').html('<span class="input-notification success png_bg">Login successful...</span>');
                setTimeout("location.href = site_url+'/login_controller/view_home/';", 1000);
            } else {
                $('#login_msg').html('<span class="input-notification error png_bg">Invalid login details...</span>');

            }
        }

    });
}

function validkey(e) {
    var keynum;
    var keychar;
    var numcheck;
    if (window.event) // IE
    {
        keynum = e.keyCode;
    }
    else if (e.which) // Netscape/Firefox/Opera
    {
        keynum = e.which;
    }
    if (keynum == 13) {
        adminlogin();
    }
}

function viewForgetPWForm(){

//alert('hello');
    $('#userpwd').hide();
    $('#forgetPWform').fadeIn('slow');
}

function resetPasswordmail(){

    var email = jQuery.trim($('#email').val());
//    alert(email);
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    if(jQuery.trim($('#email').val())== ''){
      $("#message").html("<div class='input-notification error png_bg' style='font-weight:bold;'>Fill the email field!</div>");
    }
    else if (jQuery.trim($('#email').val()) != '' && reg.test(email) == false) {
        $("#message").html("<div class='input-notification error png_bg' style='font-weight:bold;'>Invalid Email Address</div>");
    }
    else{
        $.ajax
        (
            {

                type: "POST",
                url: site_url + "/login_controller/reset_password_email",
                data: "email=" + email,
                success: function (msg) {
                    if(msg==1){
                     $('#message').html("<div class='input-notification success png_bg' style='font-weight:bold;'>Please check your mail and reset the password!</div>");

                    }
                    else if(msg==0){
                     $('#message').html("<div class='input-notification error png_bg' style='font-weight:bold;'>Your email is not registered!</div>");
                } else alert(msg);
//alert(msg);
                }

            }
        );
    }
    
}

function resetPassword(){
    if (jQuery.trim($('#new_resetpwd').val())== '' ||jQuery.trim($('#confirm_resetpwd').val())=='' ) {
        $("#error_pwd").html("<div class='input-notification error png_bg'>Please Fill All Mandatory Fields</div>");
    }
    else if ((jQuery.trim($('#new_resetpwd').val())).length < 6)
    {
        $("#error_pwd").html("<div class='input-notification error png_bg'>Password Must Have atleast 6 characters.</div>");
    }
    //    check password confirmation
    else if (jQuery.trim($('#new_resetpwd').val()) != jQuery.trim($('#confirm_resetpwd').val()))
    {
        $("#error_pwd").html("<div class='input-notification error png_bg'>Password And Confirm Password Does Not Match</div>");
    }else{
        
        $("#error_pwd").html("<div class='input-notification error png_bg'>Validating...</div>");
        $.post(site_url+'/login_controller/reset_pwd',$('#resetpwd').serialize(),
        function(msg){
       if(msg==1)
        $("#error_pwd").html("<div class='input-notification success png_bg'>Successfully Resetted....! Please Login!</div>");

        });        
    setTimeout("location.href = site_url+'/login_controller/';",600);
    }
    
}