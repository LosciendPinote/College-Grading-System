<?php


require("../Query/read.php");

if (isset($_SESSION['user_id'])) {
    require("../connection/connect.php");
    $instructor_user = $_SESSION['user_id'];

    $query = ("SELECT * FROM `tbl_instructor` WHERE instructor_id = ? ");
    $result = $db_con->prepare($query);
    $result->execute([
        $instructor_user
    ]);
    $user = $result->fetch();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Instrutor UI</title>
    <link rel="stylesheet" href="../css/instructor-ui.css" />
    <link rel="stylesheet" href="../css/settings.css">
    <link rel="stylesheet" href="../css/bootstrap.css" />
    <link rel="stylesheet" href="../css/themify-icons.css" />
    <script src="../app/jquery.min.js"></script>
</head>

<body>
    <section class="section instructor-dashboard">
        <div class="fluid-container">
            <div class="row height-100vh">
                <div class="col-md-2 instructor--nav">

                    <?php require("sidebar.php") ?>

                </div>
                <div class="col-md-9 padd">

                    <div class="container has--color">
                        <div class="inner-settings">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="settings--wrap">
                                        <div class="welcome-dashboard--settings">
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 has_flex settings">
                                    <div class="course-wrap">
                                        <div class="settings--text course__text">
                                            <h5>Course Settings:</h5>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-10">
                                    <div class="settings__course">
                                        <form action="../Instructor" method="post">
                                            <div class="setup__wrap">
                                                <div class="setup__field for__courses">
                                                    <div class="has__selection academic__year">
                                                        <input type="text" class="courseValue" name="course-acad" id="" value="Academic Year" readonly>
                                                        <div class="dropdown__arrow">
                                                            <img src="../img/instructor-dashboard/icons8-expand-arrow-24.png" alt="">
                                                        </div>
                                                        <div class="drop-down__items">
                                                            <div class="acad-year__list">
                                                                <?php foreach ($acad_val as $row) : ?>
                                                                    <div class="drop__items acad-years" value="<?php echo $row['ay_id'] ?>">
                                                                        <h5><?php echo $row['ay'] ?></h5>
                                                                    </div>
                                                                <?php endforeach ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="has__selection semister">
                                                        <input type="text" class="sem" name="course-sem" id="" value="Semester" readonly>
                                                        <div class="dropdown__arrow">
                                                            <img src="../img/instructor-dashboard/icons8-expand-arrow-24.png" alt="">
                                                        </div>
                                                        <div class="drop-down__items sem">
                                                            <div class="semister">
                                                                <div class="drop__items acad-years" value="<?php echo $row['ay_id'] ?>">
                                                                    <h5>1st</h5>
                                                                </div>
                                                                <div class="drop__items acad-years" value="<?php echo $row['ay_id'] ?>">
                                                                    <h5>2nd</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="btn--save">
                                                    <input class="btn" type="submit" name="savesettings" value="SAVE"></input>
                                                </div>
                                            </div>



                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>


    <script>
        jQuery(document).ready(function() {
            //Course Settings For Academic Year
            $(".has__selection").on("click", function() {

                $(this).find(".drop-down__items").toggleClass("active")

            })

            $(".acad-year__list .drop__items").on("click", function() {
                var getYearValue = $(this).find("h5").text()

                $(".academic__year .courseValue").val(getYearValue)



            })
            //Course Settings For Semester
            $(".semister .drop__items").on("click", function() {
                var getsemValue = $(this).find("h5").text()

                $(".sem").val(getsemValue)
            })

            //Send Save info to read.php
            $(".btn--save input").on("click", function(e) {
                e.preventDefault()
                var acad_year = $(this).closest(".settings__course").find(".has__selection.academic__year input").val()
                var semester = $(this).closest(".settings__course").find(".has__selection.semister input").val()
                var set_value = 1;
                $.ajax({
                    url: "../Query/read.php",
                    type: "POST",
                    data: {
                        'settings_acad': acad_year,
                        'settings_semester': semester,
                        'set_value': set_value
                    },
                    success: function(data) {
                        alert("Successfull")
                        location.href = "index.php"
                    }
                })

            })


        });
    </script>
</body>

</html>