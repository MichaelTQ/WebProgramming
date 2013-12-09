<?php
if(isset($_SESSION['uname']))
{
    if(isset($_SESSION['page']) and $_SESSION['page'] == 'results')
    {
        if(isset($_SESSION['privilege']) and $_SESSION['privilege'] == 'customer')
        {
            echo "<span id = 'username_upright'><a href = '../user_edit/cus_edit.php'>".$_SESSION['uname']
                ."</a> <a href = '../user_db/logout.php'>Logout</a></span>";
        }
        else if(isset($_SESSION['privilege']) and $_SESSION['privilege'] == 'owner')
        {
            echo "<span id = 'username_upright'><a href = '../user_edit/owner_edit.php'>".$_SESSION['uname']
                ."</a> <a href = '../user_db/logout.php'>Logout</a></span>";
        }
        else if(isset($_SESSION['privilege']) and $_SESSION['privilege'] == 'admin')
        {
            echo "<span id = 'username_upright'>".$_SESSION['uname']
                ." <a href = '../user_db/logout.php'>Logout</a></span>";
        }
    }
    else if (isset($_SESSION['page']) and $_SESSION['page'] == 'index')
    {
        if(isset($_SESSION['privilege']) and $_SESSION['privilege'] == 'customer')
        {
            echo "<span id = 'username_upright'><a href = './user_edit/cus_edit.php'>".$_SESSION['uname']
                ."</a> <a href = './user_db/logout.php'>Logout</a></span>";
        }
        else if(isset($_SESSION['privilege']) and $_SESSION['privilege'] == 'owner')
        {
            echo "<span id = 'username_upright'><a href = './user_edit/owner_edit.php'>".$_SESSION['uname']
                ."</a> <a href = './user_db/logout.php'>Logout</a></span>";
        }
        else if(isset($_SESSION['privilege']) and $_SESSION['privilege'] == 'admin')
        {
            echo "<span id = 'username_upright'>".$_SESSION['uname']
                ." <a href = './user_db/logout.php'>Logout</a></span>";
        }
    }
    else if (isset($_SESSION['page']) and $_SESSION['page'] == 'owner_edit')
    {
        echo "<span id = 'username_upright'>".$_SESSION['uname']
            ." <a href = '../user_db/logout.php'>Logout</a></span>";
    }
    else if (isset($_SESSION['page']) and $_SESSION['page'] == 'cus_edit')
    {
        echo "<span id = 'username_upright'>".$_SESSION['uname']
            ." <a href = '../user_db/logout.php'>Logout</a></span>";
    } 
}
else
{
    echo "<span id = 'username_upright'>guest! "
                    ."<a href = \"#sign_up\" onclick = \"signup_popup()\">Sign Up</a> "
                    ."<a href = \"#login\" onclick = \"login_popup()\">Log In</a></span>";
}

?>