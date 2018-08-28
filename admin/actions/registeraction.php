<?php
// a new admin is registered
// username and email are saved as they are
// the password is hashed
include_once '../../classes/Articles.php';
$articles = new Articles();

$fname = $articles->escape_string($_POST['fname']);
$lname = $articles->escape_string($_POST['lname']);
$email = $articles->escape_string($_POST['email']);
$password = password_hash($_POST['password1'], PASSWORD_DEFAULT);


$sql = "Insert into admin (firstName,lastName,email,password) values ('$fname','$lname','$email','$password')";

$result = $articles->execute($sql);

if ($result) {
   echo "registered";
} else {
    echo "Email already exists. Please sign in instead.";
}
