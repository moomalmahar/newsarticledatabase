<?php
// method for login for an admin
// a hashed password is matched 
session_start();
include_once '../../classes/Articles.php';
$articles = new Articles();
$email = $articles->escape_string($_POST['email']);
$password = $articles->escape_string($_POST['password']);
$result = $articles->readAll('admin', 'count(*) as count, firstName,lastName, password', "email = '$email'", 'email');
foreach ($result as $key => $res) {
    if (intval($res['count']) == 1 && password_verify($password, $res['password'])) {
      $_SESSION['username'] = $res['firstName'] . " " . $res['lastName'];
            echo "Done";
    } else {
        echo "Not";
    }
}
