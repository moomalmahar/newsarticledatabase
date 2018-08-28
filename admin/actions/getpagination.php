<?php
//the whole logic begind the pagination

include '../../classes/Articles.php';
$articles = new Articles();
$perpage = 9;
if (isset($_POST["page"])) {
    $page = intval($_POST["page"]);
} else {
    $page = 1;
}


$result = $articles->readAll('articles', 'Count(*) as Total', 'isActive = 1');


foreach ($result as $key => $res) {


    $total = $res['Total'];
}

$totalPages = ceil($total / $perpage);

if ($page <= 1) {

    echo '<button type="button" disabled class="btn btn-secondary">Prev</button>';
} else {

    $j = $page - 1;
    echo "<button type='button' onclick='getarticles($j)' class='btn btn-secondary'>Prev</button>";
}

for ($i = 1; $i <= $totalPages; $i++) {

    if ($i <> $page) {

         echo "<button type='button' onclick='getarticles($i)' class='btn btn-secondary'>$i</button>";
        
    } else {

        echo "<button type='button' disabled class='btn btn-secondary'>$i</button>";
    }
}

if ($page == $totalPages) {

    echo "<button type='button' disabled class='btn btn-secondary'>Next</button>";
  
} else {

    $j = $page + 1;
echo "<button type='button' onclick='getarticles($j)' class='btn btn-secondary'>Next</button>";
    
}
                  