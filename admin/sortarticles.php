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
include 'layout/header.php';
$result = $articles->readAll('articles', '*', '', 'articleOrder', '');
?>
<div class="container-fluid margintop">

    <div class="row" >
        <div class='col-lg-1' ></div>
        <div class='col-lg-10' >

            <ul id="sortable-rows" class="list-group">
                <?php
                foreach ($result as $key => $res) {
                    ?>
                    <li id='<?php echo $res["articleId"]; ?>' class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo $res["title"]; ?>
                        
                    </li>

                    <?php
                }
                ?>
            </ul>

        </div>
        

    </div>
</div>

<?php include 'layout/footer.php'; ?>
<script>
    $(function () {
        $("#sortable-rows").sortable({
            placeholder: "ui-state-highlight",
            update: function (event, ui) {
                updateDisplayOrder();
            }
        });
    });

    function updateDisplayOrder() {
        var orders = new Array();
        $('ul#sortable-rows li').each(function () {
            orders.push($(this).attr("id"));
        });
        
        var dataString = 'sort_order=' + orders;
        console.log(dataString);
        $.ajax({
            type: "GET",
            url: "actions/sortaction.php",
            data: dataString,
            cache: true,
            success: function (data) {
            }
        });
    }


</script>

