function signup_popup()
{
    document.getElementById('signup_all').style.display = 'inline-block';
    document.getElementById('fade').style.display = 'inline-block';
}

function signup_hide()
{
    var elem = document.getElementById('login_warning');
    elem.style.opacity = "0";
    document.getElementById('signup_all').style.display = 'none';
    document.getElementById('fade').style.display = 'none';
    document.getElementById('login').style.display = 'none';
    if (document.getElementById('pic_preview') != null)
    {
        document.getElementById('pic_preview').style.display = "none";
    }
    document.getElementById('login_success').style.display = 'none';
    document.getElementById('cus_signup_warning').style.opacity = '0';
    document.getElementById('owner_signup_warning').style.opacity = '0';
}

function login_popup()
{
    document.getElementById('login').style.display = "inline-block";
    document.getElementById('fade').style.display = 'inline-block';
}

function myValidation()
{
    var myForm = document.getElementById('index_search_form');
    if (myForm.getElementsByTagName('input')[0].value == '')
    {
        return false;
    }
}

function signup_cus_validate()
{
    var passwd = document.forms['cus_signup_form'].elements['cus_signup_psw'].value;
    var passconf = document.forms['cus_signup_form'].elements['cus_confirm_psw'].value;
    var uname = document.forms['cus_signup_form'].elements['cus_signup_uname'].value;
    var email = document.forms['cus_signup_form'].elements['cus_signup_email'].value;
    if(passwd == '' || passconf == '' || uname == '' || email == '')
    {
        elem = document.getElementById('cus_signup_warning');
        elem.style.opacity = '1';
        elem.innerHTML = 'Empty input(s) not allowed!';
        return false;
    }
    if(passwd != passconf)
    {
        elem = document.getElementById('cus_signup_warning');
        elem.style.opacity = '1';
        elem.innerHTML = 'Passwords do not match!';
        return false;
    }
    var uname_regex = /^[a-zA-Z0-9_-]{3,32}$/;
    if(uname_regex.test(uname) != true)
    {
        elem = document.getElementById('cus_signup_warning');
        elem.style.opacity = '1';
        elem.innerHTML = 'Username: 3-32 length, letters, numbers or \'-\' or \'_\'!';
        return false;
    }
    var email_regex = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
    if(email_regex.test(email) != true)
    {
        elem = document.getElementById('cus_signup_warning');
        elem.style.opacity = '1';
        elem.innerHTML = 'Please input a valid email address!';
        return false;
    }
}

function myValidateUname(id)
{
    var uname = document.getElementById(id).value;
    var uname_regex = /^[a-zA-Z0-9_-]{3,32}$/;
    if(uname_regex.test(uname) != true)
    {
        if(id == 'cus_uname_id')
        {
            elem = document.getElementById('cus_signup_warning');
            elem.style.opacity = '1';
            elem.innerHTML = 'Username: 3-32 length, letters, numbers or \'-\' or \'_\'!';
        }
        else if (id == 'owner_uname_id')
        {
            elem = document.getElementById('owner_signup_warning');
            elem.style.opacity = '1';
            elem.innerHTML = 'Username: 3-32 length, letters, numbers or \'-\' or \'_\'!';
        }
    }
    else 
    {
        if(id == 'cus_uname_id')
        {
            elem = document.getElementById('cus_signup_warning');
            elem.style.opacity = '0';
        }
        else if (id == 'owner_uname_id')
        {
            elem = document.getElementById('owner_signup_warning');
            elem.style.opacity = '0';
        }
    }
}

function myValidateEmail(id)
{
    var email = document.getElementById(id).value;
    var email_regex = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
    if(email_regex.test(email) != true)
    {
        if(id == 'cus_email_id')
        {
            elem = document.getElementById('cus_signup_warning');
            elem.style.opacity = '1';
            elem.innerHTML = 'Please input a valid email address!';
        }
        else if (id == 'owner_email_id')
        {
            elem = document.getElementById('owner_signup_warning');
            elem.style.opacity = '1';
            elem.innerHTML = 'Please input a valid email address!';
        }
        
    }
    else
    {
        if(id == 'cus_email_id')
        {
            elem = document.getElementById('cus_signup_warning');
            elem.style.opacity = '0';
        }
        else if (id == 'owner_email_id')
        {
            elem = document.getElementById('owner_signup_warning');
            elem.style.opacity = '0';
        }
    }
}

function signup_owner_validate()
{
    var myform = document.forms['owner_signup_form'];
    var uname = myform.elements['owner_signup_uname'].value;
    var email = myform.elements['owner_signup_email'].value;
    var fname = myform.elements['owner_signup_fname'].value;
    var lname = myform.elements['owner_signup_lname'].value;
    var tel = myform.elements['owner_signup_phone'].value;
    var straddr = myform.elements['owner_signup_straddr'].value;
    var city = myform.elements['owner_signup_city'].value;
    var zcode = myform.elements['owner_signup_zcode'].value;
    var passwd = myform.elements['owner_signup_psw'].value;
    var passconf = myform.elements['owner_comfirm_psw'].value;
    if(uname == '' || email == '' || passwd == '' || passconf == '' || 
      fname == '' || lname == '' || tel == '' || straddr == '' || city == '' || zcode == '')
    {
        owner_signup_errormessage('Empty input(s) not allowed!')
        return false;
    }
    var uname_regex = /^[a-zA-Z0-9_-]{3,32}$/;
    if(uname_regex.test(uname) != true)
    {
        elem = document.getElementById('owner_signup_warning');
        elem.style.opacity = '1';
        elem.innerHTML = 'Username: 3-32 length, letters, numbers or \'-\' or \'_\'!';
        return false;
    }
    var email_regex = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
    if(email_regex.test(email) != true)
    {
        elem = document.getElementById('owner_signup_warning');
        elem.style.opacity = '1';
        elem.innerHTML = 'Please input a valid email address!';
        return false;
    }
    if(passwd != passconf)
    {
        owner_signup_errormessage('Passwords do not match!');
        return false;
    }
    if(myTagsValidate('owner_fname_id') == false||
    myTagsValidate('owner_lname_id') == false||
    myTelValidate('owner_tel_id') == false||
    myTagsValidate('owner_staddr_id') == false||
    myTagsValidate('owner_city_id') == false||
    myZCodeValidate('owner_zcode_id') == false)
    {
        return false;
    }
}

function myTagsValidate(id)
{
    myelem = document.getElementById(id);
    var myInput = myelem.value;
    var stripInput = myInput.replace(/(<([^>]+)>)/ig,"");
    if (myInput != stripInput)
    {
        elem = document.getElementById('owner_signup_warning');
        elem.style.opacity = '1';
        elem.innerHTML = 'Inputs cannot contain HTML tags';
        return false;
    }
    else
    {
        elem = document.getElementById('owner_signup_warning');
        elem.style.opacity = '0';
        return true;
    }
}

function myTelValidate(id)
{
    var tel = document.getElementById(id).value;
    if(isNaN(tel) == true || tel.length != 10)
    {
        elem = document.getElementById('owner_signup_warning');
        elem.style.opacity = '1';
        elem.innerHTML = 'Wrong tel number input!';
        return false;
    }
    else
    {
        elem = document.getElementById('owner_signup_warning');
        elem.style.opacity = '0';
        return true;
    }
}

function myZCodeValidate(id)
{
    var zcode = document.getElementById(id).value;
    if(isNaN(zcode) == true || zcode.length != 5)
    {
        elem = document.getElementById('owner_signup_warning');
        elem.style.opacity = '1';
        elem.innerHTML = 'Wrong Zip Code input!';
        return false;
    }
    else
    {
        elem = document.getElementById('owner_signup_warning');
        elem.style.opacity = '0';
        return true;
    }
}


function owner_signup_errormessage(tmpstr)
{
    elem = document.getElementById('owner_signup_warning');
    elem.style.opacity = '1';
    elem.innerHTML = tmpstr;
}

function login_validate()
{
    var uname_email = document.forms['login_form'].elements['login_uname_email'].value;
    var passwd = document.forms['login_form'].elements['login_psw'].value;
    if (uname_email == null || uname_email == '' 
        ||passwd == '' || passwd == null)
    {
        var elem = document.getElementById('login_warning');
        elem.style.opacity = "1";
        elem.innerHTML = 'User name or Password cannot be empty!';
        return false;
    }
    
    if (uname_email != uname_email.replace(/(<([^>]+)>)/ig,""))
    {
        var elem = document.getElementById('login_warning');
        elem.style.opacity = "1";
        elem.innerHTML = 'User name or email cannot contain HTML tags!';
        return false;
    }
    
}

function login_success(user_name)
{
    var message_div = document.getElementById('login_success');
    message_div.style.display = 'inline-block';
    document.getElementById('fade').style.display = 'inline-block';
//    if(document.URL.indexOf('index') != -1)
//    {
//        document.getElementById('username_upright').innerHTML = user_name + 
//            " <a href = ./user_db/logout.php>Logout</a>";
//    }
//    else if(document.URL.indexOf('restaurant_list') != -1)
//    {
//        document.getElementById('username_upright').innerHTML = user_name + 
//            " <a href = ../user_db/logout.php>Logout</a>";
//    }
    
    var count=3;
    var counter=setInterval(myTimer, 1000); //1000 will  run it every 1 second
    window.setTimeout(myReload, 3000);
    function myReload()
    {
        location.reload();
    }
    function myTimer()
    {
      count=count-1;
      if (count <= 0)
      {
         clearInterval(counter);
         //counter ended, do something here
          signup_hide();
         return;
      }
      //Do code for showing the number of seconds here
        document.getElementById('my_timer').innerHTML = count+'...';
    }
}

function signup_success(user_name)
{
    var message_div = document.getElementById('login_success');
    message_div.innerHTML = '<p>Signup Success!</p><span id = \'my_timer\'>3...</span>';
    message_div.style.display = 'inline-block';
    document.getElementById('fade').style.display = 'inline-block';
    if(document.URL.indexOf('index') != -1)
    {
        document.getElementById('username_upright').innerHTML = user_name + 
            " <a href = ./index.php>Logout</a>";
    }
    else if(document.URL.indexOf('restaurant_list') != -1)
    {
        document.getElementById('username_upright').innerHTML = user_name + 
            " <a href = ../index.php>Logout</a>";
    }
    
    var count=3;
    var counter=setInterval(myTimer, 1000); //1000 will  run it every 1 second
    function myTimer()
    {
      count=count-1;
      if (count <= 0)
      {
         clearInterval(counter);
         //counter ended, do something here
          signup_hide();
         return;
      }
      //Do code for showing the number of seconds here
        document.getElementById('my_timer').innerHTML = count+'...';
    }
}

function login_fail()
{
    var elem = document.getElementById('login_warning');
    elem.style.opacity = "1";
    elem.innerHTML = 'Invalid username or password!';
}

function cus_signup_error(tmpstr)
{
    signup_popup();
    elem = document.getElementById('cus_signup_warning');
    elem.style.opacity = '1';
    elem.innerHTML = tmpstr;
}

function owner_signup_error(tmpstr)
{
    signup_popup();
    document.getElementById('signup_tab2').className = 'selected';
    document.getElementById('signup_tab1').className = null;
    document.getElementById("cus_form").style.display = "none";
    document.getElementById("owners_form").style.display = "inline-block";
    document.getElementById("signup_all").style.height = "350px";
    document.getElementById("signup_all").style.width = "450px";
    document.getElementById("signup_all").style.marginLeft = "-230px";
    elem = document.getElementById('owner_signup_warning');
    elem.style.opacity = '1';
    elem.innerHTML = tmpstr;
}