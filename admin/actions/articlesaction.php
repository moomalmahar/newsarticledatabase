<?php
//here is the method to get all the articles for an admin
//the toggle for activate and deactivate
//and the page number

include_once '../../classes/Articles.php';
$articles = null;

function showAll($orderby, $page) {
    $articles = new Articles();
    $perpage = 9;
    $calc = $perpage * $page;
    $start = $calc - $perpage;
    $result = $articles->readAll('articles', '*', '', $orderby, $start . ', ' . $perpage);

    foreach ($result as $key => $res) {
        echo "<div class='col-lg-4 hdiv' style='margin-bottom:20px' >
                                <div class='card'>
                                    <div class='card-body'>
                                        <h4 class='card-title'>" . $articles->get_snippet($res['title'], 5) . " ..." . "</h4>
                                        <h6 class='card-subtitle mb-2 text-muted'>" . $res['createdAt'] . "</h6>
                                        <p class='card-text'>" . strip_tags($articles->get_snippet($res['articleText'], 50)) . " ..." . "</p>
                                            <div class='inside'>";
        echo "<a style='margin-right:3px' href='editarticle.php?article=" . $res['articleId'] . "' class='btn btn-success btn-sm'>Edit</a>";
        echo "<a style='margin-right:3px' href='article.php?article=" . $res['articleId'] . "' class='btn btn-info btn-sm'>View</a>";
        if ($res['isActive'] == 1) {
            echo "<button  onclick='deactivate(" . $res['articleId'] . ")' value='d' class='btn btn-primary btn-sm'>Deactivate</button>";
        } else {
            echo "<button  onclick='activate(" . $res['articleId'] . ")' value='a' class='btn btn-danger btn-sm'>Activate</button>";
        } echo"                                        
                                            </div>
                                    </div>
                                </div>
                            </div>";
    }
}

if (isset($_POST["command"])) {
    if (isset($_POST["page"])) {
        $page = intval($_POST["page"]);
    } else {
        $page = 1;
    }

    if (isset($_POST["orderby"])) {
        $orderby = $_POST["orderby"];
    } else {
        $orderby = 'createdAt desc';
    }
    $articles = new Articles();

    if ($_POST["command"] == 'sortarticles') {
        showAll($orderby, $page);
    } else if ($_POST["command"] == 'deactivate') {

        $id = $articles->escape_string($_POST['id']);
        $sql = 'update articles set isActive = 0 where articleID =' . $id;
        $result = $articles->execute($sql);
        if ($result) {
            showAll($orderby, $page);
        }
    } else if ($_POST["command"] == 'activate') {

        $id = $articles->escape_string($_POST['id']);
        $sql = 'update articles set isActive = 1 where articleID =' . $id;
        $result = $articles->execute($sql);
        if ($result) {

            showAll($orderby, $page);
        }
    }
} 
?>