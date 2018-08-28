<?php
//adding a new article
include_once 'layout/header.php';
?>

<div class="container-fluid margintop">

    <div class="row" >
        <div class="col-lg-12" >
            <h2>Add new article</h2>
            <form id="addform"    >
                <br>
                <input class="form-control" name='title' id='title' type='text' placeholder="Title"  />
                <br>
                <textarea class="form-control" id='editor1' name="editor1"></textarea>
                <script>
                    CKEDITOR.replace('editor1');
                </script>
                <br>
            </form>
            <div class="right" >
                <button onclick="submitform()" type="button" class="btn btn-success btn-sm">Add</button>
                <button type="button" onclick="reset()" class="btn btn-primary btn-sm">Clear</button>
            </div>
        </div>
    </div>

</div>

<?php
include 'layout/footer.php';
?>


<script>
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
        console.log(data);
        var title = document.getElementById('title').value;
        quer = 'editor1=' + encodeURIComponent(data) + '&title=' + title;

        jQuery.ajax({
            url: 'actions/addarticlesaction.php',
            type: 'POST',
            data: quer,
            success: function (results) {
                if ($.trim(results) === String('added'))
                {
                    swal("Article added!", "Cool beans.", "success");
                } else
                {
                    console.log(results);
                    swal("Error!", "Try again please.", "error");
                }
            }

        });
    }
</script>