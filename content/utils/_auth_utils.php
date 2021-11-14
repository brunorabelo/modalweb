<?php


function isLoggedIn()
{

    if (!isset($_SESSION)) {
        session_start();
    }
    return isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true;
}

function isAdmin()
{
    return isLoggedIn() && $_SESSION['user']->is_admin;
}

function checkAuthorization($owner_email)
{

    if (!isLoggedIn())
        return false;
    $user = $_SESSION['user'];

    if (isAdmin() || $user->email == $owner_email)
        return true;
    return false;
}


?>