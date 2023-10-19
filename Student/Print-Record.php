<!DOCTYPE html>

<?php
require("../Query/student-reg.php");


if (isset($_SESSION['userStudent'])) {
    require("../connection/connect.php");

    $student_ID = $_SESSION['userStudent'];
    $query = "SELECT stud.fname,stud.mname,stud.lname, prog.program_name, enr.yearlvl 
    FROM tbl_enroll enr
    JOIN tbl_studentinfo stud ON enr.stud_id = stud.stud_id
    JOIN tbl_program prog ON enr.program_id = prog.program_id
    JOIN tbl_academicyear acad ON enr.ay_id = acad.ay_id WHERE stud.stud_id = ?";
    $result = $db_con->prepare($query);
    $result->execute([
        $student_ID
    ]);
    $getstudentID =  $result->fetch(PDO::FETCH_ASSOC);


    if ($getstudentID['fname'] == "") {
        header("Location: ../Student");
    }
}

if (isset($_SESSION['academicVal']) && isset($_SESSION['semesterVal'])) {
    // Reference From student-reg.php line 111 and 112
    $academicval =  $_SESSION['academicVal'];
    $semesterval =  $_SESSION['semesterVal'];
    $studentID = $_SESSION['userStudent'];
    $query = "SELECT DISTINCT crs.course_desc,crs.course_code, inst.fname,inst.mname,inst.lname, tbload.grade
            FROM (SELECT instructor_id, course_id FROM  tbl_instructor 
            JOIN tbl_instructorload ON tbl_instructorload.instructorID = tbl_instructor.instructor_id
            JOIN tbl_instructorloaddetails ON tbl_instructorloaddetails.ins_loadingID = tbl_instructorload.ins_loadingID
            JOIN tbl_academicyear ON tbl_academicyear.ay_id = tbl_instructorload.ay_id
            WHERE tbl_academicyear.ay = :academicval AND tbl_instructorload.sem = :semesterval) inscurload, tbl_load tbload
            JOIN tbl_enroll enr ON tbload.enroll_id = enr.enroll_id
            JOIN tbl_courses crs ON tbload.course_id = crs.course_id
            JOIN tbl_studentinfo studinfo ON enr.stud_id = studinfo.stud_id
            JOIN tbl_academicyear acad ON enr.ay_id = acad.ay_id
            JOIN tbl_instructorloaddetails instloadt ON crs.course_id = instloadt.course_id
            JOIN tbl_instructorload instload ON instload.ins_loadingID = instloadt.ins_loadingID
            JOIN tbl_instructor inst ON instload.instructorID = inst.instructor_id
            WHERE studinfo.stud_id = :studentID AND acad.ay = :academicval AND enr.sem = :semesterval
            AND inst.instructor_id = inscurload.instructor_id
            AND tbload.course_id = inscurload.course_id";
    $result = $db_con->prepare($query);
    $result->execute([
        'studentID' =>  $studentID,
        'academicval' =>  $academicval,
        'semesterval' =>   $semesterval
    ]);

    $Getinfogrades = $result->fetchAll(PDO::FETCH_ASSOC);
} else {
    header("Location: ../Student");
}



?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Record</title>
    <link rel="stylesheet" media="all" href="../css/print-record.css">
    <link rel="stylesheet" media="all" href="../css/bootstrap.css">


</head>

<body>
    <section class="main-record">




        <div class="container">
            <div class="print--btn-wrap">
                <div class="print">
                    <a href="#">Print</a>
                </div>
            </div>
            <div class="inner-container">

                <div class="row">
                    <div class="col-md-12">

                        <div class="print__record">
                            <div class="content--wrapper">
                                <img src="../img/logo__donjose.png" alt="">
                                <!-- <div class="logos--wrapper">

                                    <div class="school--logo">
                                        <div class="school__logo">
                                            <img src="../img/DJEMFCST 2.png" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="header--description">
                                    <div class="header__school school-name">
                                        <h3>DON JOSE ECLEO MEMORIAL FOUNDATION COLLEGE OF SCIENCE & TECHNOLOGY</h3>
                                    </div>
                                    <div class="header__school school-address">
                                        <h3>Justiniana Edera, San Jose, Dinagat Islands</h3>
                                    </div>
                                </div> -->

                            </div>
                            <div class="title__main">
                                <h2>CLASS <span>CARD</span></h2>
                            </div>
                            <div class="content--wrapper">

                                <div class="main--status">

                                    <div class="student--info text--color">
                                        <div class="align-cn student__name">
                                            <h5><?php echo $getstudentID['fname'] ?> <?php echo $getstudentID['mname'] ?> <?php echo $getstudentID['lname'] ?></h5>
                                        </div>
                                        <div class="align-cn student-under__name">
                                            <h5>STUDENT NAME</h5>
                                        </div>
                                        <div class="student--stats">
                                            <div class="student__course-title">
                                                <div class="student__heading student__course-heading">
                                                    <h4>Program:</h4>
                                                </div>
                                                <div class="student__content student_course">
                                                    <h5><?php echo $getstudentID['program_name'] ?> - <?php echo $getstudentID['yearlvl'] ?></h5>
                                                </div>
                                            </div>
                                            <div class="student__semester-title">
                                                <div class="student__heading student__semester-heading">
                                                    <h4>Sem.:</h4>
                                                </div>
                                                <div class="student__content student_semester">
                                                    <h5>
                                                        <?php
                                                        if (isset($_SESSION['semesterVal'])) {
                                                            echo  $_SESSION['semesterVal'];
                                                            echo (" Semester");
                                                        } else { ?>
                                                            No Data
                                                        <?php }
                                                        ?>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="student__ay-title">
                                                <div class="student__heading student__ay-heading">
                                                    <h4>AY:</h4>
                                                </div>
                                                <div class="student__content student_ay">
                                                    <h5><?php
                                                        if (isset($_SESSION['academicVal'])) {
                                                            echo  $_SESSION['academicVal'];
                                                        } else { ?>
                                                            No Data
                                                        <?php }
                                                        ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="content--wrapper grades--wrap">
                                        <div class="print--pages">
                                            <div class="big--watermark">
                                                <img src="../img/student-dashboard/watermark.png" alt="">
                                            </div>
                                            <div class="view--grades">

                                                <div class="view__grades">

                                                    <div class="student--info-grades">
                                                        <table class="tbl__info-rades">
                                                            <tr class="info--heading">
                                                                <th>Courses</th>
                                                                <th class="course__code">Course Code</th>
                                                                <th>Grades</th>
                                                                <th class="grades">Instructor</th>
                                                            </tr>
                                                            <?php if (isset($_SESSION['academicVal']) && isset($_SESSION['semesterVal'])) : ?>
                                                                <?php foreach ($Getinfogrades as $row) : ?>
                                                                    <tr class="main--status">
                                                                        <td><?php echo $row['course_desc'] ?></td>
                                                                        <td><?php echo $row['course_code'] ?></td>

                                                                        <?php if ($row['grade'] >= 75) : ?>
                                                                            <td>
                                                                                <div class="show--grades">
                                                                                    <div class="img--watermark">
                                                                                        <img src="../img/student-dashboard/logo.png" alt="">
                                                                                    </div>
                                                                                    <div class="show__grades">
                                                                                        <h5 id="grades">
                                                                                            <?php
                                                                                            if (round($row['grade'])  == round(100)) {
                                                                                                echo "1.0";
                                                                                            }
                                                                                            if (round($row['grade']) == 99) {
                                                                                                echo "1.1";
                                                                                            }
                                                                                            if (round($row['grade']) == 98) {
                                                                                                echo "1.2";
                                                                                            }
                                                                                            if (round($row['grade']) == 97) {
                                                                                                echo "1.3";
                                                                                            }
                                                                                            if (round($row['grade']) == 96) {
                                                                                                echo "1.4";
                                                                                            }
                                                                                            if (round($row['grade']) == 95) {
                                                                                                echo "1.5";
                                                                                            }
                                                                                            if (round($row['grade']) == 94) {
                                                                                                echo "1.6";
                                                                                            }
                                                                                            if (round($row['grade']) == 93) {
                                                                                                echo "1.7";
                                                                                            }
                                                                                            if (round($row['grade']) == 92) {
                                                                                                echo "1.8";
                                                                                            }
                                                                                            if (round($row['grade']) == 91) {
                                                                                                echo "1.9";
                                                                                            }
                                                                                            if (round($row['grade']) == 90) {
                                                                                                echo "2.0";
                                                                                            }
                                                                                            if (round($row['grade']) == 88 || round($row['grade']) == 89) {
                                                                                                echo "2.1";
                                                                                            }
                                                                                            if (round($row['grade']) == 86 || round($row['grade']) == 87) {
                                                                                                echo "2.2";
                                                                                            }
                                                                                            if (round($row['grade']) == 84 || round($row['grade']) == 85) {
                                                                                                echo "2.3";
                                                                                            }
                                                                                            if (round($row['grade']) == 82 || round($row['grade']) == 83) {
                                                                                                echo "2.4";
                                                                                            }
                                                                                            if (round($row['grade']) == 80 || round($row['grade']) == 81) {
                                                                                                echo "2.5";
                                                                                            }
                                                                                            if (round($row['grade']) == 79) {
                                                                                                echo "2.6";
                                                                                            }
                                                                                            if (round($row['grade']) == 78) {
                                                                                                echo "2.7";
                                                                                            }
                                                                                            if (round($row['grade']) == 77) {
                                                                                                echo "2.8";
                                                                                            }
                                                                                            if (round($row['grade']) == 76) {
                                                                                                echo "2.9";
                                                                                            }
                                                                                            if (round($row['grade']) == 75) {
                                                                                                echo "3.0";
                                                                                            }
                                                                                            ?>
                                                                                        </h5>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="instructor_name"><?php echo $row['fname'] ?> <?php echo $row['mname'] ?> <?php echo $row['lname'] ?></td>
                                                                        <?php else : ?>
                                                                            <td>
                                                                                <div class="show--grades">
                                                                                    <div class="img--watermark">
                                                                                        <img src="../img/student-dashboard/sm-watermark.png" alt="">
                                                                                    </div>
                                                                                    <div class="show__grades fail">
                                                                                        <h5><?php
                                                                                            if ($row['grade'] <= 74) {
                                                                                                echo "Failed";
                                                                                            }  ?></h5>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        <?php endif ?>
                                                                    </tr>
                                                                    <tr class="spacer"></tr>
                                                                <?php endforeach ?>
                                                            <?php endif ?>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="signature--wrapper">
                                            <div class="signature--name">
                                                <h5>SIGNATURE OVER PRINTED NAME</h5>
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

    <script src="../app/jquery.min.js"></script>
    <script src="../app/printThis.js"></script>
    <script src="../app/jquery.lock.js"></script>


    <script>
        jQuery(document).ready(function() {


            $(function heelo() {
                $("h5,td,h3,span,h4").lock({

                });
            })




            $(".print a").on("click", function(e) {
                var acadVal = $(this).closest("body").find(".selection__view.academic input").val()
                var semVal = $(this).closest("body").find(".selection__view.semester input").val()

                if (acadVal == "" || semVal == "") {
                    e.preventDefault()
                } else {
                    $(".container .inner-container").printThis({

                        importCSS: true, // import parent page css
                        importStyle: true, // import style tags
                        loadCSS: "../css/print-record.css", // path to additional css file - use an array [] for multiple
                        printDelay: 200, // variable print delay
                        canvas: true, // copy canvas content
                        base: "../Student/",
                        printDelay: 1000,

                    })
                }




            })

            $(document).on('keydown', function(e) {
                if ((e.ctrlKey || e.metaKey) && (e.key == "p" || e.charCode == 16 || e.charCode == 112 || e.keyCode == 80)) {
                    alert("Please use the Print PDF button below for a better rendering on the document");
                    e.cancelBubble = true;
                    e.preventDefault();

                    e.stopImmediatePropagation();
                }
            });

        })
    </script>
</body>

</html>