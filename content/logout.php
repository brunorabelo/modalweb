<?php

require_once "../models/UserModel.php";
session_start();

unset($_SESSION['loggedin']);
unset($_SESSION['user']);
header("location: index.php");
exit;
?>