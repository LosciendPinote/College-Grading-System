<!DOCTYPE html>

<?php
require("../Query/read.php");
if (isset($_SESSION['userStudent'])) {
    require("../connection/connect.php");
    $student_ID = $_SESSION['userStudent'];
    $query = "SELECT `stud_id`, `fname`, `mname`, `lname` FROM tbl_studentinfo WHERE stud_id=?";
    $result = $db_con->prepare($query);
    $result->execute([
        $student_ID
    ]);
    $getstudentID = $result->fetch(PDO::FETCH_ASSOC);
} else {
    header("Location: ../index.php");
}

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/student-dashboard.css">
    <link rel="stylesheet" href="../css/student-responsive.css">

    <link rel="stylesheet" href="../css/student-loading.css">

    <script src="../app/jquery.min.js"></script>
    <script src="../app/gsap-public/minified/gsap.min.js"></script>
</head>

<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="inner-col">
                        <div class="logo--info">
                            <div class="logo__img">
                                <img src="../img/student-dashboard/logo.png" alt="">
                            </div>
                            <div class="logo__name header--text--color">
                                <h4>GRADING SYSTEM</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mobile-none">
                    <div class="inner-col">
                        <div class="student-navigation header--text--color">
                            <nav>
                                <ul>
                                    <li><a href="#">Home</a></li>
                                    <li class="print--btn "><a href="Print-Record.php">Print</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="inner-col">
                        <div class="student-info">
                            <div class="student__img">
                            </div>
                            <div class="student__name--dashboard student__name--dashboard">

                                <h5><?php echo utf8_encode($getstudentID['fname'])  ?> <?php echo utf8_encode($getstudentID['lname'])  ?></h5>

                            </div>
                            <div class="logout">
                                <a href="../Query/logout.php"><img src="../img/student-dashboard/logout.png" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="student-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="selection--wrapper">
                        <div class="selection-status academic">
                            <div class="selection__view academic">
                                <input type="text" name="" id="Academic" placeholder="Academic Year" readonly>
                                <div class="selection__arrow">
                                    <img src="../img/student-dashboard/dropdown-arrow.svg" alt="">
                                </div>
                            </div>
                            <div class="selection__dropdown academic">
                                <div class="selection__items">
                                    <?php foreach ($acad_val as $row) : ?>
                                        <div class="select__item">
                                            <h5><?php echo $row['ay'] ?></h5>
                                        </div>

                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                        <div class="selection-status semester">
                            <div class="selection__view semester">
                                <input type="text" name="" id="Semester" semester="" placeholder="Semester" readonly>
                                <div class="selection__arrow">
                                    <img src="../img/student-dashboard/dropdown-arrow.svg" alt="">
                                </div>
                            </div>
                            <div class="selection__dropdown semester">
                                <div class="selection__items">
                                    <div class="select__item" semester="1st">
                                        <h5>1st Semester</h5>
                                    </div>
                                    <div class="select__item" semester="2nd">
                                        <h5>2nd Semester</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>

        </div>

        <div class="student--view-grades">

            <div class="container student--info">
                <div class="student--info-grades">
                    <table class="tbl__info-rades">
                        <tr class="info--heading">
                            <th>Courses</th>
                            <th>Course Code</th>
                            <th>Instructor</th>
                            <th>Remarks</th>
                            <th class="grades">Grades</th>
                        </tr>

                        <tr class="main--status display">

                            <td class="loading">
                                <div class="student--loading">
                                    <svg class="pl" viewBox="0 0 64 64" width="64px" height="64px" xmlns="http://www.w3.org/2000/svg">
                                        <defs>
                                            <linearGradient id="grad" x1="0" y1="0" x2="0" y2="1">
                                                <stop offset="0%" stop-color="#000" />
                                                <stop offset="100%" stop-color="#fff" />
                                            </linearGradient>
                                            <mask id="grad-mask">
                                                <rect x="0" y="0" width="64" height="64" fill="url(#grad)" />
                                            </mask>
                                        </defs>
                                        <circle class="pl__ring" cx="32" cy="32" r="26" fill="none" stroke="hsl(223,90%,55%)" stroke-width="12" stroke-dasharray="169.65 169.65" stroke-dashoffset="-127.24" stroke-linecap="round" transform="rotate(135)" />
                                        <g fill="hsl(223,90%,55%)">
                                            <circle class="pl__ball1" cx="32" cy="45" r="6" transform="rotate(14)" />
                                            <circle class="pl__ball2" cx="32" cy="48" r="3" transform="rotate(-21)" />
                                        </g>
                                        <g mask="url(#grad-mask)">
                                            <circle class="pl__ring" cx="32" cy="32" r="26" fill="none" stroke="hsl(283,90%,55%)" stroke-width="12" stroke-dasharray="169.65 169.65" stroke-dashoffset="-127.24" stroke-linecap="round" transform="rotate(135)" />
                                            <g fill="hsl(283,90%,55%)">
                                                <circle class="pl__ball1" cx="32" cy="45" r="6" transform="rotate(14)" />
                                                <circle class="pl__ball2" cx="32" cy="48" r="3" transform="rotate(-21)" />
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>
                        </tr>


                    </table>

                </div>

            </div>

        </div>
    </section>



    <script>
        jQuery(document).ready(function() {



            $(".selection-status").on("click", function() {

                var dropdown = $(this).find(".selection__dropdown")
                var selection = $(this).closest(".student-main").find(".selection__dropdown")
                if (dropdown.hasClass("active")) {
                    $(".selection__dropdown").removeClass("active")
                    gsap.fromTo(".selection__dropdown", {
                        y: 0,
                        opacity: 1,

                    }, {
                        y: -50,
                        opacity: 0,
                        duration: 0.5
                    })
                } else {
                    $(".selection__dropdown").removeClass("active")
                    dropdown.addClass("active")
                    dropdown.addClass("active1")
                    //ANIMATION
                    gsap.fromTo(".selection__dropdown", {
                        y: -50,
                        opacity: 0,
                        duration: 0.5
                    }, {
                        y: 0,
                        opacity: 1,
                        duration: 0.5
                    })

                }


            })

            $(".select__item").on("click", function() {

                var acadYear = $(this).text().trim()
                var semester = $(this).attr("semester")
                var default_Class = $(this).closest(".selection-status").find(".selection__view")
                var selectionInput = $(this).closest(".selection-status").find(".selection__view input")

                if (default_Class.hasClass("academic")) {
                    selectionInput.val(acadYear)
                } else {
                    selectionInput.val(acadYear)
                    selectionInput.attr("semester", semester)
                }

                var academicVal = $(".selection__view.academic input").val().trim()
                var semesterVal = $(".selection__view.semester input").attr("semester")
                console.log(academicVal)
                console.log(semesterVal)
                $.ajax({
                    type: "POST",
                    dataType: "html",
                    url: "../Query/student-reg.php",
                    data: {
                        "academicVal": academicVal,
                        "semesterVal": semesterVal
                    },
                    beforeSend: function() {
                        $(".student--loading").show()
                       $(".main--status.remove--bg.hide").show()
                       $(".main--status.main").hide()
                    },
                    success: function(data) {
                        $(".student--loading").hide()
                        
                        $(".tbl__info-rades").html(data)
                        $(".main--status.display").addClass("bruhhh")
                        //ANIMATION 
                        gsap.from(".main--status", {
                            duration: 2,
                            scale: 0.9,
                            opacity: 0,
                            stagger: 0.2,
                            ease: "elastic",
                            force3D: true
                        });

                        $(".main--status").on({
                            mouseenter: function() {
                                gsap.to($(this), {
                                    duration: 0.3,
                                    y: -5,
                                    ease: ""
                                });
                            },
                            mouseleave: function() {
                                gsap.to($(this), {
                                    duration: 0.3,
                                    y: 0,
                                    ease: ""
                                });
                            }
                        })
                    }

                })


            })
            //Prevent printing if the semester and acad. year
            $(".print--btn a").on("click", function(e) {
                var acadVal = $(this).closest("body").find(".selection__view.academic input").val()
                var semVal = $(this).closest("body").find(".selection__view.semester input").val()
                var gradesVal = $(this).closest("body").find(".show__grades.example h5").val()

                if (acadVal == "") {
                    e.preventDefault()
                    alert("Select the Academic Year")
                } else if (semVal == "") {
                    e.preventDefault()
                    alert("Select the Semester")
                } else if (gradesVal == "") {
                    e.preventDefault()
                    alert("Some Course is not yet graded")
                }




            })
            //ANIMATION 
            gsap.from("header", {
                duration: 1,
                delay: 0.2,
                y: 100,
                opacity: 0,


            });
            gsap.from(".selection-status.academic", {
                opacity: 0,
                delay: 0.5,
                x: -50

            })
            gsap.from(".selection-status.semester", {
                opacity: 0,
                delay: 0.5,
                x: 50

            })
            gsap.from(".main--status", {
                duration: 2,
                scale: 0.9,
                opacity: 0,
                delay: 1,
                ease: "elastic",
                force3D: true
            });
            gsap.from(".info--heading th", {
                duration: 1.1,
                opacity: 0,
                delay: 1,
                stagger: 0.3

            });



        })
    </script>
</body>

</html>