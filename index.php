<!DOCTYPE html>
<html lang="en">

<?php require_once("./Query/create.php");

if (isset($_SESSION['user_id'])) {
    header("Location: Instructor");
}
if (isset($_SESSION['userStudent'])) {
    header("Location: Student");
}


?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selection</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/selection.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/mobile-responsive.css">
    <script src="app/jquery.min.js"></script>

</head>

<body>
    <div class="container-fluid body-container">
        <div class="container inner-container">
            <div class="bacgkround-bg">

            </div>
            <header>
                <div class="container main-container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="logo-wrapper">
                                <div class="logo">
                                    <img src="img/logo__donjose.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <section class="main-selection">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="inner-col instructor">
                                <div class="authentication-ui instructor-ui">
                                    <div class="bg-circle pos-relative">
                                       
                                    </div>
                                    <div class="ui--name instructor-name is-size">
                                        <h3>Instructor</h3>
                                    </div>
                                    <div class="authentication-bg ">
                                        <div class="container log">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="auth-text login-text">
                                                        <p>Login</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="cta-auth login-btn color">
                                                        <a href="#">Enter</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row displaynone">
                                                <div class="col-md-6">
                                                    <div class="auth-text register-text">
                                                        <p>Register</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="cta-auth register-btn color">
                                                        <a href="instructor-register.php">Enter</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container log-user user">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="login--heading">
                                                        <h5>Login</h5>
                                                    </div>
                                                    <div class="login--form">
                                                        <form action="index.php" method="post">
                                                            <div class="username--field"><input type="text" name="username_instructor" id="" placeholder="Username">
                                                            </div>
                                                            <div class="password--field"><input type="password" name="password_instructor" placeholder="Password">
                                                            </div>
                                                            <div class="login__submit">
                                                                <input type="submit" name="login_instructor" value="LOGIN">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="close-icon">
                                            <i class="ti-close"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="inner-col student">
                                <div class="authentication-ui student-ui">
                                    <div class="bg-circle student__circle pos-relative">
                                        
                                    </div>
                                    <div class="ui--name student-name is-size">
                                        <h3>Student</h3>
                                    </div>
                                    <div class="authentication-bg student">
                                        <div class="container log">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="auth-text login-text">
                                                        <p>Login</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="cta-auth login-btn color">
                                                        <a href="#">Enter</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row displaynone">
                                                <div class="col-md-6">
                                                    <div class="auth-text register-text">
                                                        <p>Register</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="cta-auth register-btn color">
                                                        <a href="./Student/student-register.php">Enter</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="container log-user user">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="login--heading">
                                                        <h5>Login</h5>
                                                    </div>
                                                    <div class="login--form">
                                                        <form action="index.php" method="post">
                                                            <div class="username--field">
                                                                <input type="text" name="student_username" placeholder="Username">
                                                            </div>
                                                            <div class="password--field">
                                                                <input type="password" name="student_password" placeholder="Password">
                                                            </div>
                                                            <div class="login__submit">
                                                                <input type="submit" name="login_student" value="LOGIN">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="close-icon">
                                            <i class="ti-close"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>


    <script>
        jQuery(document).ready(function() {

            $(".authentication-ui").on({
                mouseenter: function() {
                    $(".auth-text").removeClass("active")
                    $(this).find(".auth-text").addClass("active")
                    $(".cta-auth").removeClass("active")
                    $(this).find(".cta-auth").addClass("active")
                },
                mouseleave: function() {
                    $(".auth-text").removeClass("active")
                    $(".cta-auth").removeClass("active")
                }


            });


            $(".cta-auth a").on({
                mouseenter: function() {
                    $(this).closest(".authentication-bg").find(".auth-text").css("color", "#FFDC27")
                },
                mouseleave: function() {

                }


            })

            $(".cta-auth.login-btn a").on("click", function() {
                event.preventDefault()
                $(".authentication-bg ").removeClass("cta_Active")
                $(this).closest(".authentication-bg").addClass("cta_Active")

                $(".container.log").removeClass("auth")
                $(this).closest(".authentication-bg ").find(".container.log").addClass("auth")

                $(".close-icon").removeClass("active")
                $(this).closest(".authentication-ui").find(".close-icon").addClass("active")

                $(this).closest(".authentication-bg").find(".container.log-user").addClass("active")
            });

            $(".close-icon").on("click", function() {
                $(this).removeClass("active")
                $(this).closest(".authentication-bg").removeClass("cta_Active")
                $(this).closest(".authentication-bg").find(".container.log-user").removeClass("active")
                $(".container.log").removeClass("auth")
                $(".auth-text").removeClass("active")
                $(".cta-auth").removeClass("active")
            })



        });
    </script>
</body>

</html>