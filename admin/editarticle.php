<style>
    .right{
        text-align:right
    }
</style>
<?php
include 'layout/header.php';
$id = 0;
// check if article query string is there or not
//if it exists then show the editor else redirect to index page.
if (isset($_GET['article']) && $_GET['article'] != '') {
    $id = $articles->escape_string($_GET['article']);
    ?>
    <div class="container-fluid margintop">

        <div class="row" >
            <div class="col-lg-12" >
                <h2>Add new article</h2>
                <form id="editform" action='actions/editarticleaction.php' method="post"  >
                    <br>

                    <input class="form-control" name='title' id='title' type='text' placeholder="Title"  />
                    <br>
                    <textarea class="form-control" id='editor1' name="editor1"></textarea>
                    <script>
                        CKEDITOR.replace('editor1');
                    </script>
                    <br>
                    <div class="right" >
                        <button onclick="submitform()" type="button" class="btn btn-success btn-sm">Update</button>
                        <button type="button" onclick="reset()" class="btn btn-primary btn-sm">Clear</button>
                    </div>
                </form>

            </div>
        </div>

    </div>

    <?php
} else {
    ?>
    <script>
        swal("Article not found.")
                .then((value) => {
                    location.href = 'index.php';
                });

    </script>
    <?php
}

$gettitle = '';
$gettext = '';
$result = $articles->readAll('articles', 'title,articleText', 'articleId =' . $id, '', '');
foreach ($result as $key => $res) {
    $gettitle = $articles->escape_string($res['title']);
    $gettext = $articles->escape_string($res['articleText']);
}
?>


<?php include 'layout/footer.php'; ?>
<script>
    CKEDITOR.instances['editor1'].setData('<?php echo $gettext; ?>');
    document.getElementById('title').value = "<?php echo $gettitle; ?>";


    function reset() {
        swal({
            text: "Changes won't be saved!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
                .then((willDelete) => {
                    if (willDelete) {
                        CKEDITOR.instances['editor1'].setData('');
                        document.getElementById('title').value = "";
                    } else {

                    }
                });
    }

    function submitform() {
        var data = CKEDITOR.instances.editor1.getData();
        var articleid = "<?php echo $id; ?>";
        var title = document.getElementById('title').value;
        quer = 'id=' + articleid + '&editor1=' + encodeURIComponent(data) + '&title=' + title;
        
        jQuery.ajax({
            url: 'actions/editarticleaction.php',
            type: 'POST',
            data: quer,
            success: function (results) {
                        if ($.trim(results) === String('edited'))
                        {
                           swal("Article edited!", "Cool beans.", "success");
                        } else
                        {
                            console.log(results);
                            swal("Error!", "Try again please.", "error");
                        }
                    }

        });
    }




</script>


