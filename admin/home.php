<!doctype html>
<?php
session_start();
if (isset($_SESSION['username'])) {
    header("location: index.php");
}
?>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


        <title>News Articles</title>
        <style>
            .margintop
            {margin-top: 20px}
        </style>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">News Articles</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">

                </ul>

            </div>
        </nav>


        <div  class="container-fluid">
            <div class="row">

                <div style="margin-left: 20px;margin-top: 5%"  class="col-lg-4">

                    <div id="loginerror" hidden class="alert alert-dismissible alert-primary">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Oh snap! </strong> Email and Password did not match.
                    </div>


                    <form method="post" action="actions/loginaction.php" id="loginfrm">
                        <fieldset>
                            <legend>Login Here</legend>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input required="" type="email" class="form-control" name="email" 
                                       aria-describedby="emailHelp" placeholder="Enter email">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input required="" type="password" class="form-control" name="password" 
                                       placeholder="Password">
                            </div>

                            <button type="submit" class="btn btn-success">Submit</button>
                        </fieldset>
                    </form>
                </div>

                <div class="col-lg-3">

                </div>
                <div style="margin-left: 20px;margin-top: 5%" class="col-lg-4">
                    <form action="actions/registeraction.php" method="post" id="registerform">
                        <fieldset>
                            <legend>Register Here</legend>
                            <div class="form-group">
                                <label for="exampleInputEmail1">First Name</label>
                                <input  required="" type="text" pattern="^[a-zA-Z]+$" 
                                        title="Letters only please." class="form-control" 
                                        name="fname" aria-describedby="emailHelp" placeholder="First Name">


                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Last Name</label>
                                <input required="" type="text" pattern="^[a-zA-Z]+$" 
                                       title="Letters only please." class="form-control" 
                                       name="lname" aria-describedby="emailHelp" placeholder="Last Name">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input required="" type="email" class="form-control" 
                                       name="email" aria-describedby="emailexists" 
                                       placeholder="Enter email">
                                <small id="emailexists" style="color: #D9230F" class="form-text"></small>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input required="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                                       title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" 
                                       type="password" class="form-control" name="password1" id="password1" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Confirm Password</label>
                                <input onchange='check_pass();' required="" type="password"
                                       class="form-control" id="password2" placeholder="Confirm Password">
                                <small id="passwordsdontmatch" hidden="" style="color: #D9230F" class="form-text">Passwords don't match.</small>
                            </div>

                            <button id="regsubmit" disabled type="submit" class="btn btn-success">Submit</button>
                        </fieldset>
                    </form>
                </div>
            </div>
            <!--  row ends          -->
        </div>
        <?php include 'layout/footer.php'; ?>
        <script>

            var loginfrm = $('#loginfrm');
            loginfrm.submit(function (e) {
                e.preventDefault();
                $.ajax({
                    type: loginfrm.attr('method'),
                    url: loginfrm.attr('action'),
                    data: loginfrm.serialize(),
                    success: function (results) {
                        if ($.trim(results) === String('Done'))
                        {
                            window.location = "index.php";
                        } else
                        {
                            document.getElementById('loginerror').hidden = false;
                        }
                    }
                });
            });



            var frm = $('#registerform');
            frm.submit(function (e) {
                e.preventDefault();
                $.ajax({
                    type: frm.attr('method'),
                    url: frm.attr('action'),
                    data: frm.serialize(),
                    success: function (results) {
                        if ($.trim(results) === String('registered'))
                        {
                            swal("Admin registered!", "You may now login.", "success");
                        } else
                        {
                            jQuery("#emailexists").html(results);
                        }
                    }
                });
            });



            function check_pass() {
                if (document.getElementById('password1').value ===
                        document.getElementById('password2').value) {
                    document.getElementById('passwordsdontmatch').hidden = true;
                    document.getElementById('regsubmit').disabled = false;
                } else {
                    document.getElementById('passwordsdontmatch').hidden = false;
                    document.getElementById('regsubmit').disabled = true;
                }

            }
        </script>

