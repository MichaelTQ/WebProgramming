function signup_popup()
{
    document.getElementById('signup_all').style.display = 'inline-block';
    document.getElementById('fade').style.display = 'inline-block';
}

function signup_hide()
{
    document.getElementById('signup_all').style.display = 'none';
    document.getElementById('fade').style.display = 'none';
    document.getElementById('login').style.display = 'none';
}

function login_popup()
{
    document.getElementById('login').style.display = "inline-block"
    document.getElementById('fade').style.display = 'inline-block';
}