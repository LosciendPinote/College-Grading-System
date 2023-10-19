<!DOCTYPE html>

<html lang="en">

<?php

require("back-admin.php");

// Session userID originated from back-admin.php line 28

if (isset($_SESSION['admin-user'])) {

    header("Location: admin.php");
}



?>



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <title>Admin Login</title>

    <link rel="stylesheet" href="../css/bootstrap.css" />
    <link rel="stylesheet" href="../css/admin-responsive.css">
    <link rel="stylesheet" href="../css/admin.css">

</head>



<body>

    <div id="page">
        <div class="hide--page">
            <div class="loader">
                <div class="load-text">
                    <div class="loaded-text"><h5>N</h5></div>
                    <div class="loading-text"><h5>O SERVICE</h5></div>
                </div>
            </div>
            <main>
            </main>
        </div>
        <section class="admin--login">

            <div class="container shadow has__border--rad--17">

                <div class="row">

                    <div class="col-md-6">

                        <div class="login--wrapper">

                            <div class="inner__login">

                                <div class="header">

                                    <div class="login--title">

                                        <h1>Admin Access</h1>

                                    </div>

                                </div>

                                <div class="login--wrap">



                                    <div class="login--fields">

                                        <div class="upper--login">

                                            <div class="login--text">

                                                <h5>Login</h5>

                                            </div>

                                            <div class="login--robot">

                                                <img src="../img/admin-img/robot-login.png" alt="">

                                            </div>

                                        </div>

                                        <form action="" method="post">

                                            <div class="email__enter">

                                                <input type="text" name="admin__user" placeholder="Enter username">

                                            </div>

                                            <div class="password__enter">

                                                <input type="password" name="admin__password" placeholder="Enter Password">

                                            </div>

                                            <div class="cta--login">

                                                <input type="submit" name="admin__login" value="Sign In">

                                            </div>

                                        </form>

                                    </div>

                                </div>

                                <div class="footer--recieved">

                                    <div class="allright__recieved">

                                        <h5>@2022 Losciend All rights reserved</h5>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="graphics--wrapper has__border--rad--17">

                            <div class="graphics__inner">

                                <div class="objects--graphics has__border--rad--17">

                                    <div class="gp--objects up--graphics__1 graphics__1">

                                        <img src="../img/admin-img/object-top-left.png" alt="">

                                    </div>



                                    <div class="gp--objects bot--graphics__1 graphics__1">

                                        <img src="../img/admin-img/object_top_right.png" alt="">

                                    </div>

                                    <div class="gp--objects bot--graphics__2">

                                        <img src="../img/admin-img/bg_object_top.png" alt="">

                                    </div>

                                    <div class="gp--objects bot--graphics__sm">

                                        <img src="../img/admin-img/sm_object_bot.png" alt="">

                                    </div>

                                    <div class="gp--objects bg--line__gp">

                                    </div>



                                    <div class="welcome--graphics">

                                        <div class="welcome--bg__object">

                                            <img src="../img/admin-img/hero_bg.png.png" alt="">

                                        </div>

                                    </div>

                                </div>



                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </div>

</body>



</html>