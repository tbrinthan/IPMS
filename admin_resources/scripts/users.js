//var site_url = "http://localhost/IPMS_ver_1/index.php/";


//function add_user() {
////alert(jQuery.trim($('#txtfName').val()));
//    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
//    var address = jQuery.trim($('#txtEmail').val());
//
//    $("#error_add_user").html("<div class='input-notification error png_bg'>Validating...</div>");
//
////    check whether fields are empty
//    if (jQuery.trim($('#txtfName').val())== '' ||jQuery.trim($('#txtuName').val())=='' || jQuery.trim($('#txtEmail').val()) == '' || jQuery.trim($('#txtPassword').val()) == '' || jQuery.trim($('#txtCPassword').val()) == '') {
//        $("#error_add_user").html("<div class='input-notification error png_bg'>Please Fill All Mandatory Fields...</div>");
//    }
//
//    if ($('#cmbUserType').val()== 0){
//        $("#error_add_user").html("<div class='input-notification error png_bg'> Please select the user type...</div>");
////    alert("select user type");
//    }
//
////    email address validation
//    else if (jQuery.trim($('#txtEmail').val()) != '' && reg.test(address) == false) {
//        $("#error_add_user").html("<div class='input-notification error png_bg'>Invalid Email Address</div>");
//    }
//
////    check username length
//    else if ((jQuery.trim($('#txtUname').val())).length < 4)
//    {
//        $("#error_add_user").html("<div class='input-notification error png_bg'>The username should have at least <strong>4</strong> characters.</div>");
//    }
////    check password length
//    else if ((jQuery.trim($('#txtPassword').val())).length < 6 || (jQuery.trim($('#txtPassword').val())).length > 15)
//    {
//        $("#error_add_user").html("<div class='input-notification error png_bg'>Password Must Have 6 To 15 Characters</div>");
//    }
//
////    check password confirmation
//    else if (jQuery.trim($('#txtPassword').val()) != jQuery.trim($('#txtCPassword').val()))
//    {
//        $("#error_add_user").html("<div class='input-notification error png_bg'>Password And Confirm Password Does Not Match</div>");
//    }
//
////    if all are validated
//    else {
//     //   alert($('#cmbUserType').val()+"   "+$('#txtfName').val()+"   "+ $('#txtuName').val()+"   "+ $('#txtEmail').val()+"  "+ $('#txtCPassword').val());
//        $("#error_add_user").html("<div class='input-notification error png_bg'>Validating...</div>");
//        $.ajax
//            (
//                {
//                    type: "POST",
//                    url: site_url + "/user_controller/save_user/",
//                    data: "u_type=" + $('#cmbUserType').val() + "&f_name=" + $('#txtfName').val() + "&u_name=" + $('#txtuName').val() + "&email=" + $('#txtEmail').val() + "&pwd=" + $('#txtCPassword').val(),
//                    async: false,
//                    success: function (msg) {
////                       alert(msg);
//                        if(msg==1){
//                            $("#error_add_user").html("<div class='input-notification success png_bg'>Successfully Added....!!!</div>");
//                            setTimeout("location.href = site_url+'/user_controller/add_user/';", 1000);
//                            alert("New User added!");
//
//                        }
//                        else{
//                            $("#error_add_user").html("<div class='input-notification error png_bg'>Email address is already exists.</div>");
////                        alert("Email exists");
//                        }
//                    }
//                }
//            );
//    }
//
//}
//
//
//
//function edit_user() {
//
////alert($('#txtEmail').val()+$('#txtuName').val()+$('#txtfName').val()+$('#cmbUserType').val());
//    $('#add_user_msg').html('<span class="input-notification error png_bg">Validating...</span>');
//    //alert($('#cmbCompany').val());
//    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
//    var address = jQuery.trim($('#txtEmail').val());
//
//    if (jQuery.trim($('#txtfName').val()) == '' || jQuery.trim($('#txtuName').val()) == '' || jQuery.trim($('#txtEmail').val()) == '' ) {
//        $("#add_user_msg").html('<span class="input-notification error png_bg">Please Fill All Mandatory Fields...</span>');
//    }
//    else if (jQuery.trim($('#txtEmail').val()) != '' && reg.test(address) == false) {
//        $("#error_add_user").html("<div class='notification error png_bg'><div id='login_msg'><b>Invalid Email Address</b></div></div>");
//    }
//    else {
//
//
//        $.ajax
//        (
//            {
//                type: "POST",
//                url: site_url + "/user_controller/update_user",
//                data: "u_type=" + $('#cmbUserType').val() + "&f_name=" + $('#txtfName').val() + "&u_name=" + $('#txtuName').val() + "&email=" + $('#txtEmail').val() + "&user_id=" + $('#user_id').val(),
//                success: function(msg){
////                    alert(1);
//                    $('#add_user_msg').html('<span class="input-notification success png_bg">Successfully updated.</span>');
//                    setTimeout("location.href = site_url+'/user_controller/manage_user/';", 100);
//
//                 },
//                error: function(msg){
//                    alert(msg);
//                }
//            }
//
//        );
//
//    }
//}
//
//
//function deleteUser(id,trid){
//
//   // alert(trid);
//    var   post_url  = site_url+"/user_controller/delete_user/" ;
//    var dataURL = "user_id=" +id;
//
//
////    jConfirm("Are you sure want to delete this User ?" , 'Please Confirm', function(result){
////        if (result) {
////            $.ajax({
////                type: "POST",
////                url: post_url,
////                data: dataURL,
////                success: function(msg){
//////                   alert(msg);
//////                    $(#trid).fadeOut();
////                    document.getElementById(trid).style.display='none';
////                }
////            });
////
////
////        }else{
////        }
////    });
//
//    var answer=confirm("Are you sure want to delete this user?",'Please Confirm');
//    if(answer){
//        $.ajax({
//                type: "POST",
//                url: post_url,
//                data: dataURL,
//                success: function(msg){
////                   alert(msg);
////                    $(#trid).fadeOut();
//                    document.getElementById(trid).style.display='none';
//                }
//            });
//
//    }
//
//    else{
//    }
//
//
////    jConfirm('Can you confirm this?', 'Confirmation Dialog', function(r) {
////       jAlert('Confirmed: ' + r, 'Confirmation Results');
////
////    });
//
//}

//function checkUsername(){
//    pic1 = new Image(16, 16);
//    pic1.src = site_url + "/admin_resources/images/loader.gif";
//
//
//            var usr = $("#txtUname").val();
//
//            if(usr.length >= 4)
//            {
//                $("#status").html('<img src="loader.gif" align="absmiddle">&nbsp;Checking availability...');
//
//                $.ajax({
//                    type: "POST",
//                    url: site_url+"/user_controller/check_username",
//                    data: "u_name="+ usr,
//                    success: function(msg){
//
//                        $("#status").ajaxComplete(function(event, request, settings){
//
//                            if(msg == 'OK')
//                            {
//
//                                $(this).html('&nbsp;<img src="admin_resources/tick.gif" align="absmiddle">');
//                            }
//                            else
//                            {
//
//                                $(this).html(msg);
//                            }
//
//                        });
//
//                    }
//
//                });
//
//            }
//            else
//            {
//                $("#status").html('<font color="red">The username should have at least <strong>4</strong> characters.</font>');
//
//            }
//
//}


function myPopup() {
//    window.open( "http://www.google.com/" )

    var checkedValues = [];
    var allCheckboxes = document.getElementsByName("checkbox[]");
    for(var i = 0; i < allCheckboxes.length; i++){
        if (allCheckboxes[i].checked)
            checkedValues.push(allCheckboxes[i].value);
    }
    alert(checkedValues);

}

$(document).ready(function(){
    $(document).on('change','#txtUname',function(){
            if(checkUsername()){alert('hello');}
        });

    
});

	
	
	
	
	
	
	