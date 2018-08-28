<?php
//the main page for the user
include 'layout/header.php';
?>


<input id="pagenumber" name="pagenumber" type="hidden" >
<div class="container-fluid margintop">
    <div class="row" >
        <div class="right col-lg-12" >
            <form>
                <div class="right" >
                    <select onchange="getarticles(1)" class="form-control" id='sorting' >
                        <option value="title asc">A - Z</option>
                        <option value="title desc">Z - A</option>
                        <option  value="createdAt asc">Date Asc</option>
                        <option  value="createdAt desc">Date Desc</option>
                        <option selected="" value="articleOrder">Manual Order</option>
                    </select>
                </div>
            </form>
        </div>

    </div>
    <div class="row">
        <div id="articles" name="articles" class="hdiv" ></div>
    </div>
    <div class="row">
        <div class=" col-lg-4" ></div>
        <div style="text-align: center; margin-bottom: 10px" class="col-lg-4" >
            <div id="pagination" name="pagination"  class="btn-group" role="group" aria-label="Basic example"></div>
        </div>
        <div class=" col-lg-4" ></div>
    </div>

</div>





<?php include 'layout/footer.php'; ?>
<script>
    
     function getpagination(quer) {
         jQuery.ajax({
            url: 'actions/getpagination.php',
            type: 'POST',
            data: quer,
            success: function (results) {
                jQuery("#pagination").html(results);
            }

        });
     }
    function getarticles(pgnumber) {
        var sorting = document.getElementById('sorting');
        var orderby = sorting.options[sorting.selectedIndex].value;
        document.getElementById('pagenumber').value = pgnumber;
        quer = 'page=' + pgnumber + '&command=sortarticles&orderby=' + orderby;
        console.log(pgnumber);
        jQuery.ajax({
            url: 'actions/articlesaction.php',
            type: 'POST',
            data: quer,
            success: function (results) {
                jQuery("#articles").html(results);
            }

        });
        
        getpagination(quer);
        
    }



    $(document).ready(function () {
        getarticles(1);
    });

    
    function deactivate(id) {
        var sorting = document.getElementById('sorting');
    var orderby = sorting.options[sorting.selectedIndex].value;
    var pagenumber = document.getElementById('pagenumber').value;
        console.log(pagenumber);
        var quer = 'page=' + pagenumber + '&id=' + id + '&command=deactivate&orderby=' + orderby;
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
                                
                                getarticles(pagenumber);
                            }
                        });
            }
        });
    }
    function activate(id) {
        var sorting = document.getElementById('sorting');
    var orderby = sorting.options[sorting.selectedIndex].value;
    var pagenumber = document.getElementById('pagenumber').value;
         console.log(pagenumber);
        var quer = 'page=' + pagenumber + '&id=' + id + '&command=activate&orderby=' + orderby;
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
                                getarticles(pagenumber);
                            }
                        });
            }
        });
    }
</script>