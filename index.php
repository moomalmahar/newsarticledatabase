<?php
// This page is the main page for viewing all the articles as an admin
include_once 'layout/header.php';
?>
<div class="container-fluid margintop">

    <div class="row">
        <div id="articles" name="articles" class="hdiv" >
            <?php
            if (isset($_GET["page"])) {
                $page = intval($_GET["page"]);
            } else {
                $page = 1;
            }
            $perpage = 9;
            $calc = $perpage * $page;
            $start = $calc - $perpage;
            $result = $articles->readAll('articles', '*', 'isActive = 1', 'articleOrder', $start . ', ' . $perpage);

            foreach ($result as $key => $res) {
                echo "<div class='col-lg-4 hdiv' style='margin-bottom:20px' >
                                <div class='card'>
                                    <div class='card-body'>
                                        <h4 class='card-title'>" . $articles->get_snippet($res['title'], 5) . " ..." . "</h4>
                                        <h6 class='card-subtitle mb-2 text-muted'>" . $res['createdAt'] . "</h6>
                                        <p class='card-text'>" . strip_tags($articles->get_snippet($res['articleText'], 50)) . " ..." . "</p>
                                            <div class='inside'>";
                echo "<a style='margin-right:3px' href='article.php?article=" . $res['articleId'] . "' class='btn btn-info btn-sm'>View</a>";
                echo"                                         
                                            </div>
                                    </div>
                                </div>
                            </div>";
            }
            ?>

        </div>
    </div>
    <div class="row">
        <div class=" col-lg-4" ></div>
        <div style="text-align: center; margin-bottom: 10px" class="col-lg-4" >
            <div id="pagination" name="pagination"  class="btn-group" role="group" aria-label="Basic example">
                <?php
                $resultpage = $articles->readAll('articles', 'Count(*) as Total', 'isActive = 1');


                foreach ($resultpage as $key => $res) {


                    $total = $res['Total'];
                }

                $totalPages = ceil($total / $perpage);

                if ($page <= 1) {

                    echo '<button type="button" disabled class="btn btn-secondary">Prev</button>';
                } else {

                    $j = $page - 1;
                    echo "<a  href='index.php?page=$j' class='btn btn-secondary'>Prev</a>";
                }

                for ($i = 1; $i <= $totalPages; $i++) {

                    if ($i <> $page) {

                        echo "<a  href='index.php?page=$i' class='btn btn-secondary'>$i</a>";
                    } else {

                        echo "<a  disabled class='btn btn-secondary'>$i</a>";
                    }
                }

                if ($page == $totalPages) {

                    echo "<button type='button' disabled class='btn btn-secondary'>Next</button>";
                } else {

                    $j = $page + 1;
                    echo "<a  href='index.php?page=$j' class='btn btn-secondary'>Next</a>";
                }
                ?>

            </div>
        </div>
        <div class=" col-lg-4" ></div>
    </div>

</div>




<style>
    .hdiv{
        display: flex;
        flex-flow: row;
        flex-wrap: wrap;
    }

    .inside {
        margin-bottom: 10px;
        position: absolute;
        bottom: 0;
    }
    .right{
        float: right;
        margin-bottom: 10px
    }
    .left{
        float: none;
        margin-bottom: 10px
    }

</style>
<?php
include 'layout/footer.php';
