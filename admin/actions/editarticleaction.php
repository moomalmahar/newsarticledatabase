<?php
//the edit method for articles

include_once '../../classes/Articles.php';
$articles = new Articles();
$title = $articles->escape_string($_POST['title']);
$text = $articles->escape_string($_POST['editor1']);
$id = $_POST['id'];
$sql = "UPDATE articles SET title = '" . $title . "' , articleText = '" . $text . "' where articleId =" . $id;
$result = $articles->execute($sql);
if ($result) {
    echo "edited";
   
} else {
    echo "Error";
}
