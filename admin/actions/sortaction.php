<?php
// this is for the manual drag and drop sorting of articles

include_once '../../classes/Articles.php';
    $articles = new Articles();
 if (isset($_GET["sort_order"])) {

    $id_ary = explode(",", $_GET["sort_order"]);
    for ($i = 0; $i < count($id_ary); $i++) {
        $sql = "UPDATE articles SET articleOrder='" . $i . "' WHERE articleId=" . $id_ary[$i];
        $result = $articles->execute($sql);
     
    }
}