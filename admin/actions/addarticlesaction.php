<?php
// the article is added 
// the username is the saved session 
session_start();
include_once '../../classes/Articles.php';
$articles = new Articles();
$title = $articles->escape_string($_POST['title']);
    $text = $articles->escape_string($_POST['editor1']);
    $author = $_SESSION['username'];
    $sql = "INSERT INTO articles(title,articleText,createdBy)VALUES('" . $title . "','" . $text . "','" . $author . "');";
    $result = $articles->execute($sql);
    if ($result) {
     echo "added";
    } else {
         echo "failed";
    }