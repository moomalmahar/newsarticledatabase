
<?php
include 'layout/header.php';
$id = 0;
if (isset($_GET['article']) && $_GET['article'] != '') {
$id = $articles->escape_string($_GET['article']);
$result = $articles->readAll('articles', '*', 'articleID =' . $id);
?>
    <div class="container-fluid margintop">

    <div class="row" >
        <div class='col-lg-1' ></div>
        <div class='col-lg-10' >
            <div class="jumbotron">
                <?php
                
                foreach ($result as $key => $res) {
               echo ' <h4 class="display-4">'.$res['title'] .'</h4>
                    <hr class="my-4">
                   <p>'. $res['createdBy']. ' | '. $res['createdAt']. '</p>
                <p class="lead">'. $res['articleText']. '</p>';
                echo "<a style='margin-right:3px' href='editarticle.php?article=" . $res['articleId'] . "' class='btn btn-success btn-sm'>Edit</a>";
               if ($res['isActive'] == 1) {
                    echo "<button  onclick='deactivate(" . $res['articleId'] . ")'  class='btn btn-primary btn-sm'>Deactivate</button>";
                } else {
                    echo "<button  onclick='activate(" . $res['articleId'] . ")'  class='btn btn-danger btn-sm'>Activate</button>";
                }
                }?>
            </div>
        </div>
        <div class='col-lg-1' ></div>

    </div>
</div>
    
    
    <?php
}
else {
      ?>
    <script>
        swal("Article not found.")
                .then((value) => {
                    location.href = 'index.php';
                });
    
    
      
    </script>
    <?php
}

?>

<script>
      function deactivate(id) {
       
        var quer = 'id=' + id + '&command=deactivate' ;
        jQuery.ajax({
            url: 'actions/articlesaction.php',
            type: 'POST',
            data: quer,
            success: function () {
                swal({
                    title: "Article Deactivated!",
                    icon: "success",
                })
                        .then((ok) => {
                            if (ok) {
                                
                               location. reload(true);
                            }
                        });
            }
        });
    }
    function activate(id) {
        var quer = 'id=' + id + '&command=activate';
        jQuery.ajax({
            url: 'actions/articlesaction.php',
            type: 'POST',
            data: quer,
            success: function () {
                swal({
                    title: "Article Activated!",
                    icon: "success",
                })
                        .then((ok) => {
                            if (ok) {
                                location. reload(true);
                            }
                        });
            }
        });
    }
</script>


<?php include 'layout/footer.php';
?>