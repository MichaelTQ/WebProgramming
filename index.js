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

function owner_validate()
{
    
}

function cus_validate()
{
    
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
    document.getElementById('username_upright').innerHTML = user_name + 
        " <a href = ./index.php>Logout</a>";
    
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