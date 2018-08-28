<?php
// just a simple logout
session_start();

// Unset all of the session variables

// Destroy the session.
session_destroy();
 
// Redirect to login page
header("location: ../home.php");