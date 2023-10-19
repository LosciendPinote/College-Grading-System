<!DOCTYPE html>
<html lang="en">
<?php
require("back-admin.php");

if (isset($_SESSION['admin-user'])) {
} else {
    header("Location: ../admin");
}

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Access</title>
    <link rel="stylesheet" href="../css/bootstrap.css" />
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div id="page--admin">
        <section class="admin--main">
            <div class="fluid-container">
                <div class="row admin">
                    <div class="col-md-2">
                        <div class="admin--sidebar">
                            <div class="inner__sidebar">
                                <div class="admin--info">
                                    <div class="admin--profile__default">
                                        <div class="inner--profile">
                                            <img src="../img/admin-img/admin--pf.png" alt="">
                                        </div>
                                    </div>
                                    <div class="admin__text">
                                        <h5>Admin Account</h5>
                                    </div>
                                </div>
                                <div class="cta--buttons">
                                    <div class="admin--select__acad">
                                        <div class="dropdown--head head__acad" acad="">
                                            <h5>Academic Year</h5>

                                        </div>
                                        <div class="select__dropdown-menu acad--dm">
                                            <!-- Show Academic Year from Database Academic Year originated in back-admin.php lin 40 -->
                                            <?php foreach ($get_acad as $row) : ?>
                                                <div class="acad__items" acad-val="<?php echo $row['ay'] ?>">
                                                    <h5><?php echo $row['ay'] ?> </h5>
                                                </div>
                                            <?php endforeach ?>


                                        </div>
                                    </div>
                                    <div class="admin--select__acad">
                                        <div class="dropdown--head head__sem" semester="">
                                            <h5>Semester</h5>
                                        </div>
                                        <div class="select__dropdown-menu semester--dm">

                                            <div class="acad__items first--sem" value="1st" stat="First Semester">
                                                <h5>First Semester</h5>
                                            </div>
                                            <div class="acad__items second--sem" value="2nd" stat="Second Semester">
                                                <h5>Second Semester</h5>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="admin--lock__btn">
                                        <div class="cta--gen cta--lock">
                                            <button>Lock Grades</button>
                                        </div>
                                    </div>
                                    <div class="admin--unlock__btn">
                                        <div class="cta--gen cta--unlock">
                                            <button>unlock Grades</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="admin--logout">
                                    <div class="admin--lock__btn">
                                        <div class="cta--gen cta--logout">
                                            <a href="admin-logout.php"><button>Logout</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="status--admin">
                            <div class="status--info">
                                <div class="inner__status">
                                    <div class="stats---wrap lock--stats">
                                        <div class="status__text">
                                            <h5>Status:</h5>
                                            <h5>Academic:</h5>
                                            <h5>Semester:</h5>
                                        </div>
                                        <div class="status__wrap">
                                            <div class="status__lock">
                                                <h5>Select</h5>
                                            </div>
                                            <div class="status__acad">
                                                <h5>Select Academic Year</h5>
                                            </div>
                                            <div class="status__sem">
                                                <h5>Select Semester</h5>
                                            </div>
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


    <script src="../app/jquery.min.js"></script>
    <script>
        jQuery(document).ready(function() {

            // dropping menu of acad and sem
            $(".dropdown--head").on("click", function() {

                var drop__down = $(this).closest(".admin--select__acad").find(".select__dropdown-menu")

                if (drop__down.hasClass("active")) {
                    drop__down.removeClass("active")

                } else {
                    $(".select__dropdown-menu").removeClass("active")
                    drop__down.addClass("active")

                }
            })


            $(".acad__items").on("click", function() {
                var acad_val = $(this).closest(".select__dropdown-menu.acad--dm .acad__items").attr("acad-val")
                var sem_text = $(this).closest(".select__dropdown-menu.semester--dm .acad__items").attr("value")
                var sem_val = $(this).closest(".select__dropdown-menu.semester--dm .acad__items").attr("stat")
                $(".status__acad h5").text(acad_val)
                $(".status__sem h5").text(sem_val)

                $(".dropdown--head.head__acad").attr("acad", acad_val)
                $(".dropdown--head.head__sem").attr("semester", sem_text)
                var acad_attr = $(".dropdown--head.head__acad").attr("acad")
                var sem_attr = $(".dropdown--head.head__sem").attr("semester")
                window.acad = acad_attr
                window.sem = sem_attr

                var check = 0;
                $.ajax({
                    url: "../ajax/admin.php",
                    type: "POST",
                    data: {
                        'check': check,
                        'acad_attr': acad_attr,
                        'sem_attr': sem_attr
                    },
                    success: function(data) {
                        $(".status__lock").html(data)
                    }

                })

            })
            //Button for Locking Grades
            $(".cta--lock button").on("click", function() {
                acad_attr = window.acad
                sem_attr = window.sem
                $.ajax({
                    url: "../ajax/admin.php",
                    type: "POST",
                    data: {
                        "acad_text": acad_attr,
                        "sem_text": sem_attr
                    },
                    success: function(data) {
                        $(".status__lock").html(data)
                    }
                })
            })

            //Button for Unlocking Grades
            $(".cta--unlock button").on("click", function() {
                acad_attr = window.acad;
                sem_attr = window.sem;

                $.ajax({
                    url: "../ajax/admin.php",
                    type: "POST",
                    data: {

                        "acad_unlock": acad_attr,
                        "sem_unlock": sem_attr
                    },
                    success: function(data) {
                        $(".status__lock").html(data)
                    }
                })
            })










        })
    </script>
</body>

</html>