<!doctype html>

<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="//cdn.ckeditor.com/4.9.2/full/ckeditor.js"></script>

        <title>News Articles</title>
        <style>
            .margintop
            {margin-top: 20px}

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
        <script>

        </script>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">News Articles</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="add.php">Add <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">View All <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sortarticles.php">Sort Articles <span class="sr-only">(current)</span></a>
                    </li>

                </ul>

                <?php
                session_start();
                if (isset($_SESSION['username'])) {
                    ?>
                    <button onclick="location.href = '../admin/actions/logoutaction.php';" class="btn btn-primary my-2 my-sm-0" type="submit">Logout</button>
                    <?php
                } else {
                    header("location: ../admin/home.php");
                }



                include '../classes/Articles.php';
                $articles = new Articles();
                ?>
            </div>
        </nav>