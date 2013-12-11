//states in the options...
var arr_states = ["AL", "AK", "AZ", "AR", "CA", "CO", "CT", "DE", "FL", "GA", "HI", "ID", "IL", "IN", "IA", "KS", "KY", "LA", "ME", "MD", "MA", "MI", "MN", "MS", "MO", "MT", "NE", "NV", "NH", "NJ", "NM", "NY", "NC", "ND", "OH", "OK", "OR", "PA", "RI", "SC", "SD", "TN", "TX", "UT", "VT", "VA", "WA", "WV", "WI", "WY"];
var states_selet = document.getElementById("states_sel");
for (var i = 0; i != arr_states.length; i++)
{
    var tmp_option = document.createElement("option");
    tmp_option.text = arr_states[i];
    tmp_option.value = arr_states[i];
    states_selet.add(tmp_option, null);
}

var rest_select = document.getElementById("rest_states_id");
if(rest_select != null)
{
    for (var i = 0; i != arr_states.length; i++)
    {
        var tmp_option = document.createElement("option");
        tmp_option.text = arr_states[i];
        tmp_option.value = arr_states[i];
        rest_select.add(tmp_option, null);
    }
}

function myEnableInputs()
{
    document.getElementById('click_to_edit').style.display = 'none';
    if(window.location.pathname.indexOf('owner') != -1)
    {
        var editform = document.forms['update_owner_info'];
    }
    else if(window.location.pathname.indexOf('cus') != -1)
    {
        var editform = document.forms['update_cus_info'];
    }
    for (var i = 0; i < editform.elements.length; i++)
    {
        var tmp_input = editform.elements[i];
        tmp_input.disabled = false;
    }
}

function myResetPersonalInfo() {
    
    var uname = document.getElementById('uname').textContent;
    var email = document.getElementById('email').textContent;
    var tel = document.getElementById('tel').textContent;
    var straddr = document.getElementById('straddr').textContent;
    var city = document.getElementById('city').textContent;
    var zcode = document.getElementById('zcode').textContent;
    var state = document.getElementById('state').textContent;
    var fname = '';
    var lname = '';
    
    if(window.location.pathname.indexOf('owner') != -1)
    {
        fname = document.getElementById('fname').textContent;
        lname = document.getElementById('lname').textContent;
        var editform = document.forms['update_owner_info'];
        editform.elements['fname'].value = fname;
        editform.elements['lname'].value = lname;
        
    }
    else if(window.location.pathname.indexOf('cus') != -1)
    {
        var editform = document.forms['update_cus_info'];
    }
    editform.elements['uname'].value = uname;
    editform.elements['email'].value = email;
    editform.elements['tel'].value = tel;
    editform.elements['straddr'].value = straddr;
    editform.elements['city'].value = city;
    editform.elements['zcode'].value = zcode;
    
    $('#states_sel').val(state);
}

myResetPersonalInfo();

function myPasswordValidate()
{
    var old_passwd = document.forms['reset_password'].elements['old_passwd'].value;
    var new_passwd = document.forms['reset_password'].elements['new_passwd'].value;
    var conf_passwd = document.forms['reset_password'].elements['conf_passwd'].value;
    
    
    if(old_passwd == '' || new_passwd == '' || conf_passwd == '')
    {
        document.getElementById('password_warning').innerHTML = 'No empty input(s) allowed!';
        return false;
    }
    else if(new_passwd != conf_passwd)
    {
        document.getElementById('password_warning').innerHTML = "Passwords do not match!";
        return false;
    }
    else if(new_passwd == old_passwd)
    {
        document.getElementById('password_warning').innerHTML = "Old & New passwords cannot be the same!";
        return false;
    }
    else
    {
        document.forms['reset_password'].submit();
    }
}

function myPasswdReset()
{
    location.reload();
}

function passwdWrong()
{
    document.getElementById("password_warning").innerHTML = "Old password is wrong!";
}

function passwsChanged()
{
    document.getElementById("password_warning").innerHTML = "Password successfully changed!";
    setInterval(function() {document.getElementById("password_warning").innerHTML = "<br>"}, 2000);
}

function myPInfoUpdate()
{
    var old_uname = document.getElementById('uname').textContent;
    var old_email = document.getElementById('email').textContent;
    var old_tel = document.getElementById('tel').textContent;
    var old_straddr = document.getElementById('straddr').textContent;
    var old_city = document.getElementById('city').textContent;
    var old_zcode = document.getElementById('zcode').textContent;
    //var old_fname = document.getElementById('fname').textContent;
    //var old_lname = document.getElementById('lname').textContent;
    var old_state = document.getElementById('state').textContent;
    var old_fname = '';
    var old_lname = '';
    var fname = '';
    var lname = '';
    
    if(window.location.pathname.indexOf('owner') != -1)
    {
        old_fname = document.getElementById('fname').textContent;
        old_lname = document.getElementById('lname').textContent;
        var myForm = document.forms['update_owner_info'];
        fname = myForm.elements['fname'].value;
        lname = myForm.elements['lname'].value;
        
    }
    else if(window.location.pathname.indexOf('cus') != -1)
    {
        var myForm = document.forms['update_cus_info'];
    }
    var uname = myForm.elements['uname'].value;
    var email = myForm.elements['email'].value;
    var tel = myForm.elements['tel'].value;
    var straddr = myForm.elements['straddr'].value;
    var city = myForm.elements['city'].value;
    var state = myForm.elements['state'].value;
    var zcode = myForm.elements['zcode'].value;
    
    if(uname == '' || email == '' || tel == '' || straddr == '' || city == '' || zcode == '')
    {
        document.getElementById('personal_info_warning').innerHTML = 'No empty input(s) allowed!';
        return false;
    }
    else if(window.location.pathname.indexOf('owner') != -1 && (fname == '' || lname == ''))
    {
        document.getElementById('personal_info_warning').innerHTML = 'No empty input(s) allowed!';
        return false;
    }
    else if(!myValidateUname('uname_id', 'personal_info_warning'))
    {
        return false;
    }
    else if(!myValidateEmail('email_id', 'personal_info_warning'))
    {
        return false;
    }
    else if(!myTagsValidate('straddr_id', 'personal_info_warning')
            ||!myTagsValidate('city_id', 'personal_info_warning'))
    {
        return false;
    }
    else if(window.location.pathname.indexOf('owner') != -1 
        && (!myTagsValidate('fname_id', 'personal_info_warning')||
           !myTagsValidate('lname_id', 'personal_info_warning')))
    {
        return false;
    }
    else if(!myZCodeValidate('zcode_id', 'personal_info_warning'))
    {
        return false;
    }
    else if(!myTelValidate('tel_id', 'personal_info_warning'))
    {
        return false;
    }
}

function myValidateEmail(id, warning_id)
{
    var email = document.getElementById(id).value;
    var email_regex = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
    if(email_regex.test(email) != true)
    {
        elem = document.getElementById(warning_id);
        elem.innerHTML = 'Please input a valid email address!';
        return false;
    }
    else
    {
        elem = document.getElementById(warning_id);
        elem.innerHTML = '<br>';
        return true;
    }
}

function myTagsValidate(id, warning_id)
{
    myelem = document.getElementById(id);
    var myInput = myelem.value;
    var stripInput = myInput.replace(/(<([^>]+)>)/ig,"");
    if (myInput != stripInput)
    {
        elem = document.getElementById(warning_id);
        elem.innerHTML = 'Inputs cannot contain HTML tags';
        return false;
    }
    else
    {
        elem = document.getElementById(warning_id);
        elem.innerHTML = '<br>';
        return true;
    }
}

function myTelValidate(id, warning_id)
{
    var tel = document.getElementById(id).value;
    if(isNaN(tel) == true || tel.length != 10)
    {
        elem = document.getElementById(warning_id);
        elem.innerHTML = 'Wrong tel number input!';
        return false;
    }
    else
    {
        elem = document.getElementById(warning_id);
        elem.innerHTML = '<br>';
        return true;
    }
}

function myZCodeValidate(id, warning_id)
{
    var zcode = document.getElementById(id).value;
    if(isNaN(zcode) == true || zcode.length != 5)
    {
        elem = document.getElementById(warning_id);
        elem.innerHTML = 'Wrong Zip Code input!';
        return false;
    }
    else
    {
        elem = document.getElementById(warning_id);
        elem.innerHTML = '<br>';
        return true;
    }
}

function myValidateUname(id, warning_id)
{
    var uname = document.getElementById(id).value;
    var uname_regex = /^[a-zA-Z0-9_-]{3,32}$/;
    if(uname_regex.test(uname) != true)
    {
        elem = document.getElementById(warning_id);
        elem.innerHTML = 'Username: 3-32 length, letters, numbers or \'-\' or \'_\'!';
        return false;
    }
    else 
    {
        elem = document.getElementById(warning_id);
        elem.innerHTML = '<br>';
        return true;
    }
}

function my_pinfo_changed()
{
    var elem = document.getElementById('personal_info_warning');
    elem.innerHTML = 'Successfully Changed!';
    setInterval(function(){document.getElementById('personal_info_warning').innerHTML = '<br>'}, 2000);
}

function open_restaurant()
{
    document.getElementById('no_rest_notice').style.display = 'none';
    document.getElementById('edit_restaurant').style.display = 'inline-block';
    document.getElementById('add_menu').style.display = 'inline-block';
}

function my_add_dish(id) 
{
    var tmp_obj = document.getElementById(id);
    var tmp_idnum = tmp_obj.id.replace('add_dish_button_id', '');
    
    var mytable = document.getElementById('dish_table_id'+tmp_idnum);
    var rowCount = mytable.rows.length;
    var row = mytable.insertRow(rowCount);
    var colCount = mytable.rows[0].cells.length;
    for(var i = 0; i < colCount; i++)
    {
        var newcell = row.insertCell(i);
        newcell.innerHTML = mytable.rows[0].cells[i].innerHTML;
    }
}

function my_remove_dish(id)
{
    var tmp_obj = document.getElementById(id);
    var tmp_idnum = tmp_obj.id.replace('remove_dish_button_id', '');
    
    var mytable = document.getElementById('dish_table_id'+tmp_idnum);
    var rowCount = mytable.rows.length;
    for(var i = 0; i < rowCount; i++)
    {
        var row = mytable.rows[i];
        var chkbox = row.cells[0].childNodes[0];
        if(chkbox != null && chkbox.checked == true)
        {
            if(rowCount <= 1)
            {
                document.getElementById('menu_warning').innerHTML = 'Cannot remove all rows!';
                //setInterval(function() {$('#menu_warning').html('<br>');}, 2000);
                break;
            }
            mytable.deleteRow(i);
            rowCount--;
            i--;
        }
    }
}

var cate_id_num = 0;

function my_add_category()
{
    cate_id_num++;
    var str_html_cate = document.getElementById('menu_category_id0').innerHTML;
    str_html_cate = str_html_cate.replace(/_id[0-9]+/g, '_id'+cate_id_num.toString());
    str_html_cate = str_html_cate.replace(/cate[0-9]+/g, 'cate'+cate_id_num.toString());
    str_html_cate = "<div class='menu_category' id='menu_category_id"+cate_id_num.toString()+"'>"+str_html_cate+"</div>";
    var new_div = document.createElement('div');
    new_div.innerHTML = str_html_cate;
    
    document.getElementById('menu_all_form').appendChild(new_div);
}

function my_remove_category()
{
    if(cate_id_num <= 0)
    {
        $('#menu_warning').html('Cannot remove all categories!');
        //setInterval(function(){ $('#menu_warning').html('<br>');}, 2000);
        return false;
    }
    else
    {
        var str_id = "menu_category_id"+cate_id_num.toString();
        var mydiv = document.getElementById(str_id);
        mydiv.parentNode.removeChild(mydiv);
        cate_id_num--;
    }
}

$('#menu_all_form').submit(function(event) {
    if($('#rest_name_id').val() == '' || $('#rest_straddr_id').val() == ''||$('#rest_city_id').val() == '' || $('#rest_tel_id').val() == ''||
      my_rest_edit_validate() == false)
    {
        event.preventDefault();
        $('#menu_warning').html('Please finish restaurant info first!');
    }
    for(var i = 0; i <= cate_id_num; i++)
    {
        var myInput = $('#cate_name_id'+i.toString()).val();
        var myDesInput = $('#cate_description_id'+i.toString()).val();
        var stripInput = myInput.replace(/(<([^>]+)>)/ig,"");
        var strpDesInput = myDesInput.replace(/(<([^>]+)>)/ig,"");
        if($('#cate_name_id'+i.toString()).val() == '')
        {
            event.preventDefault();
            $('#menu_warning').html('category name cannot be empty!');
        }
        else if(myInput != stripInput)
        {
            event.preventDefault();
            $('#menu_warning').html('cannot contain HTML tags');
        }
        else if(myDesInput != strpDesInput)
        {
            event.preventDefault();
            $('#menu_warning').html('cannot contain HTML tags');
        }
    }
    for(var i = 0; i <= cate_id_num; i++)
    {
        var dish_name = 'cate'+i.toString()+'_dish_name[]';
        var dish_price = 'cate'+i.toString()+'_dish_price[]';
        var dish_num = document.forms['menu_all_form'].elements[dish_name].length;
        
        var regex_price = /^\d{0,5}(\.\d{1,2})?$/;
        
        if(dish_num != null)
        {
            for(var j = 0; j < dish_num; j++)
            {
                var myInput = document.forms['menu_all_form'].elements[dish_name][j].value;
                var stripInput = myInput.replace(/(<([^>]+)>)/ig,"");
                var price = document.forms['menu_all_form'].elements[dish_price][j].value;
                if(document.forms['menu_all_form'].elements[dish_name][j].value == ''||
                  document.forms['menu_all_form'].elements[dish_price][j].value == '')
                {
                    event.preventDefault();
                    $('#menu_warning').html('dish name or price cannot be empty!');
                }
                else if(regex_price.test(price)==false)
                {
                    event.preventDefault();
                    $('#menu_warning').html('wrong price input!');
                }
                else if(myInput != stripInput)
                {
                    event.preventDefault();
                    $('#menu_warning').html('cannot contain HTML tags');
                }
            }
        }
        else
        {
            var myInput = document.forms['menu_all_form'].elements[dish_name].value;
            var stripInput = myInput.replace(/(<([^>]+)>)/ig,"");
            var price = document.forms['menu_all_form'].elements[dish_price].value;
            if(document.forms['menu_all_form'].elements[dish_name].value == ''||
                  document.forms['menu_all_form'].elements[dish_price].value == '')
            {
                event.preventDefault();
                $('#menu_warning').html('dish name or price cannot be empty!');
            }
            else if(regex_price.test(price)==false)
            {
                event.preventDefault();
                $('#menu_warning').html('wrong price input!');
            }
            else if(myInput != stripInput)
            {
                event.preventDefault();
                $('#menu_warning').html('cannot contain HTML tags');
            }
            
        }
    }
    
});

$('#img_upload_form').submit(function (event){
    if($('#rest_name_id').val() == '' || $('#rest_straddr_id').val() == ''||$('#rest_city_id').val() == '' || $('#rest_tel_id').val() == '' || my_rest_edit_validate() == false)
    {
        event.preventDefault();
        $('#rest_img_warning').html('Please finish restaurant info first!');
    }
});

function my_rest_edit_validate()
{
    if($('#rest_name_id').val() == '' || $('#rest_straddr_id').val() == ''||$('#rest_city_id').val() == '' || $('#rest_tel_id').val() == '' || $('#rest_zcode_id').val() == '')
    {
        document.getElementById('rest_warning').innerHTML = 'no empty input(s) allowed except description';
        return false;
    }
    else if(myTagsValidate('rest_name_id', 'rest_warning') == false ||
           myTagsValidate('rest_straddr_id', 'rest_warning') == false ||
           myTagsValidate('rest_city_id', 'rest_warning') == false ||
           myTagsValidate('rest_description_id', 'rest_warning') == false)
    {
        document.getElementById('rest_warning').innerHTML = 'cannot contain HTML tags';
        return false;
    }
    else if(myZCodeValidate('rest_zcode_id', 'rest_warning') == false)
    {
        return false;
    }
    else if(myTelValidate('rest_tel_id', 'rest_warning') == false)
    {
        document.getElementById('rest_warning').innerHTML = 'wrong telephone input!';
        return false;
    }
}

function update_rest_info()
{
    document.getElementById('rest_name_id').value = $('#rest_info_name').text();
    document.getElementById('rest_straddr_id').value = $('#rest_info_straddr').text();
    document.getElementById('rest_city_id').value = $('#rest_info_city').text();
    document.getElementById('rest_zcode_id').value = $('#rest_info_zcode').text();
    document.getElementById('rest_tel_id').value = $('#rest_info_tel').text();
    document.getElementById('rest_description_id').value = $('#rest_info_description').text();
    document.getElementById('rest_icon_url_id').value = $('#rest_info_icon_url').text();
    var tmp_state = $('#rest_info_state').text();
    $('#rest_states_id').val(tmp_state);
}

function my_update_allmenus()
{
    var cate_length = parseInt($('#old_cate_num').text());
    if(cate_length > 1)
    {
        for(var i = 0; i < cate_length - 1; i++)
        {
            my_add_category();
        }
    }
    for (var i = 0; i < cate_length; i++)
    {
        var add_dish_buttom_id = 'add_dish_button_id'+i.toString();
        var dish_length = parseInt(document.getElementById('dish_length_id'+i.toString()).innerHTML);
        var old_cate_name = document.getElementById('old_cate_name_id'+i.toString()).innerHTML;
        var old_description = document.getElementById('old_description_id'+i.toString()).innerHTML;
        $('#cate_name_id'+i.toString()).val(old_cate_name);
        $('#cate_description_id'+i.toString()).val(old_description);
        if(dish_length > 1)
        {
            for (var j = 0; j < dish_length - 1; j++)
            {
                my_add_dish(add_dish_buttom_id);
            }
            for(var j = 0; j < dish_length; j++)
            {
                var old_dish_name = document.getElementById('old_dish_name_id_'+i.toString()+'_'+j.toString()).innerHTML;
                var old_dish_price = document.getElementById('old_dish_price_id_'+i.toString()+'_'+j.toString()).innerHTML;
                var myform = document.forms['menu_all_form'];
                myform.elements['cate'+i.toString()+'_dish_name[]'][j].value = old_dish_name;
                myform.elements['cate'+i.toString()+'_dish_price[]'][j].value = old_dish_price;
            }
        }
        else if(dish_length == 1)
        {
            var old_dish_name = document.getElementById('old_dish_name_id_'+i.toString()+'_0').innerHTML;
            var old_dish_price = document.getElementById('old_dish_price_id_'+i.toString()+'_0').innerHTML;
            var myform = document.forms['menu_all_form'];
            myform.elements['cate'+i.toString()+'_dish_name[]'].value = old_dish_name;
            myform.elements['cate'+i.toString()+'_dish_price[]'].value = old_dish_price;
        }
    }
}

$('#search_form_id').submit(function (event) {
    if($('#search_form_id input[type="text"]').val().length == 0)
    {
        event.preventDefault();
    }
});