$('.cus_change_psw').click(function(){
    var tmp_id = $(this).parent().attr('id');
    var id = tmp_id.replace('change_cus_psw_', '');
    $(this).parent().html('<form method = "post" action = "admin_page.php"><input type = "password" name = "change_psw_cus" placeholder = "enter new password"><input type = "hidden" name = "id" value = '+id+'></form>');
});

$('.owner_change_psw').click(function(){
    var tmp_id = $(this).parent().attr('id');
    var id = tmp_id.replace('change_owner_psw_', '');
    $(this).parent().html('<form method = "post" action = "admin_page.php"><input type = "password" name = "change_psw_owner" placeholder = "enter new password"><input type = "hidden" name = "id" value = '+id+'></form>');
});