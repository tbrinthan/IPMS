//var site_url = "http://localhost/IPMS_ver_1/index.php/";


function add_user() {
    //alert(jQuery.trim($('#txtfName').val()));
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    var address = jQuery.trim($('#txtEmail').val());

    $("#error_add_user").html("<div class='input-notification error png_bg'>Validating...</div>");

    //    check whether fields are empty
    if (jQuery.trim($('#txtfName').val())== '' ||jQuery.trim($('#txtuName').val())=='' || jQuery.trim($('#txtEmail').val()) == '' || jQuery.trim($('#txtPassword').val()) == '' || jQuery.trim($('#txtCPassword').val()) == '') {
        $("#error_add_user").html("<div class='input-notification error png_bg'>Please Fill All Mandatory Fields...</div>");
    }

    //    email address validation
    else if (jQuery.trim($('#txtEmail').val()) != '' && reg.test(address) == false) {
        $("#error_add_user").html("<div class='input-notification error png_bg'>Invalid Email Address</div>");
    }

    //    check password length
    else if ((jQuery.trim($('#txtPassword').val())).length < 6)
    {
        $("#error_add_user").html("<div class='input-notification error png_bg'>Password Must Have atleast 6 characters.</div>");
    }

    //    check password confirmation
    else if (jQuery.trim($('#txtPassword').val()) != jQuery.trim($('#txtCPassword').val()))
    {
        $("#error_add_user").html("<div class='input-notification error png_bg'>Password And Confirm Password Does Not Match</div>");
    }

    //    if all are validated
    else {
        //   alert($('#cmbUserType').val()+"   "+$('#txtfName').val()+"   "+ $('#txtuName').val()+"   "+ $('#txtEmail').val()+"  "+ $('#txtCPassword').val());
        $("#error_add_user").html("<div class='input-notification error png_bg'>Validating...</div>");
        $.ajax
        (
        {
            type: "POST",
            url: site_url + "/user_controller/save_user",
            data: "u_type=" + $('#cmbUserType').val() + "&f_name=" + $('#txtfName').val() + "&u_name=" + $('#txtuName').val() + "&email=" + $('#txtEmail').val() + "&pwd=" + $('#txtCPassword').val(),
            success: function (msg) {
                //                       alert(msg);
                if(msg==1){
                    $("#error_add_user").html("<div class='input-notification success png_bg'>Successfully Added....!!!</div>");
                    alert("New User added!");
                }
                if(msg==2){
                    $("#error_add_user").html("<div class='input-notification error png_bg'>Username is not available.</div>");
                //                        alert("Username exists");
                        
                }
                if(msg==0){
                    $("#error_add_user").html("<div class='input-notification error png_bg'>Email address is already exists.</div>");
                //                                            alert("Email exists");
                }
            },
            error: function(msg){
                alert(msg);
            }
        }
        );
       
    setTimeout("location.href = site_url+'/user_controller/add_user/';", 200);

    }

}



function edit_user() {

    //alert($('#txtEmail').val()+$('#txtuName').val()+$('#txtfName').val()+$('#cmbUserType').val());
    $('#add_user_msg').html('<span class="input-notification error png_bg">Validating...</span>');
    //alert($('#cmbCompany').val());
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    var address = jQuery.trim($('#txtEmail').val());

    if (jQuery.trim($('#txtfName').val()) == '' || jQuery.trim($('#txtuName').val()) == '' || jQuery.trim($('#txtEmail').val()) == '' ) {
        $("#add_user_msg").html('<span class="input-notification error png_bg">Please Fill All Mandatory Fields...</span>');
    }
    else if (jQuery.trim($('#txtEmail').val()) != '' && reg.test(address) == false) {
        $("#error_add_user").html("<div class='notification error png_bg'><div id='login_msg'><b>Invalid Email Address</b></div></div>");
    }
    else {


        $.ajax
        (
        {
            type: "POST",
            url: site_url + "/user_controller/update_user",
            data: "u_type=" + $('#cmbUserType').val() + "&f_name=" + $('#txtfName').val() + "&u_name=" + $('#txtuName').val() + "&email=" + $('#txtEmail').val() + "&user_id=" + $('#user_id').val(),
            success: function(msg){
                //                    alert(1);
                $('#add_user_msg').html('<span class="input-notification success png_bg">Successfully added.</span>');
                setTimeout("location.href = site_url+'/user_controller/manage_user/';", 100);

            },
            error: function(msg){
                alert(msg);
            }
        }

        );
    }
}


function deleteUser(id,trid){

    // alert(trid);
    var   post_url  = site_url+"/user_controller/delete_user/" ;
    var dataURL = "user_id=" +id;

    var answer=confirm("Are you sure want to delete this user?",'Please Confirm');
    if(answer){
        $.ajax({
            type: "POST",
            url: post_url,
            data: dataURL,
            success: function(msg){
                //                   alert(msg);
                //                    $(#trid).fadeOut();
                document.getElementById(trid).style.display='none';
            }
        });

    }

    else{
    }
}


function myPopup() {
    window.open( "http://www.google.com/" )
}

	
	
	
	
	
	
	