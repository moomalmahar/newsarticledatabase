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

</style>
<?php
include_once 'layout/header.php';

$id = 0;
if (isset($_GET['article']) && $_GET['article'] != '') {
$id = $articles->escape_string($_GET['article']);
$result = $articles->readAll('articles','*','isActive = 1 and articleID =' . $id);
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

 include 'layout/footer.php';
