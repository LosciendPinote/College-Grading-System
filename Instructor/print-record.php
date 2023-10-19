<!DOCTYPE html>
<html lang="en">
<?php
session_start();
require("../connection/connect.php");
if (isset($_SESSION['user_id'])) {

    $instructor_user = $_SESSION['user_id'];

    $query = ("SELECT * FROM `tbl_instructor` WHERE instructor_id = ? ");
    $result = $db_con->prepare($query);
    $result->execute([
        $instructor_user
    ]);
    $user = $result->fetch();
}

if (isset($_SESSION['acad']) && isset($_SESSION['sem']) && isset($_SESSION['CourseID'])) {


    $courseID = $_SESSION['CourseID'];  //The Session originate from list-student.php
    $academic_year = $_SESSION['acad']; //The Session originate from read.php


    $query = "SELECT ay.ay, cs.course_desc, prog.program_name, enr.yearlvl, studinfo.fname,
    studinfo.lname, LEFT(studinfo.mname,'1') as mname, studinfo.stud_id,enr.enroll_id,tbload.entry,tbload.grade
       FROM tbl_courses cs
       JOIN tbl_load tbload ON tbload.course_id = cs.course_id
       JOIN tbl_enroll enr ON tbload.enroll_id = enr.enroll_id
       JOIN tbl_program prog ON enr.program_id = prog.program_id
       JOIN tbl_academicyear ay ON enr.ay_id = ay.ay_id
       JOIN tbl_studentinfo studinfo ON enr.stud_id = studinfo.stud_id
       
       WHERE cs.course_id = ? AND ay.ay = ?  ORDER BY `studinfo`.`lname` ASC";
    $result = $db_con->prepare($query);
    $result->execute([
        $courseID, $academic_year
    ]);

    $get_info = $result->fetch(PDO::FETCH_ASSOC);
}

if (isset($_SESSION['acad']) && isset($_SESSION['sem']) && isset($_SESSION['CourseID'])) {


    $courseID = $_SESSION['CourseID'];  //The Session originate from list-student.php
    $academic_year = $_SESSION['acad']; //The Session originate from read.php


    $query = "SELECT ay.ay, cs.course_desc, prog.program_name, enr.yearlvl, studinfo.fname,
    studinfo.lname, LEFT(studinfo.mname,'1') as mname, studinfo.stud_id,enr.enroll_id,tbload.entry,tbload.grade
       FROM tbl_courses cs
       JOIN tbl_load tbload ON tbload.course_id = cs.course_id
       JOIN tbl_enroll enr ON tbload.enroll_id = enr.enroll_id
       JOIN tbl_program prog ON enr.program_id = prog.program_id
       JOIN tbl_academicyear ay ON enr.ay_id = ay.ay_id
       JOIN tbl_studentinfo studinfo ON enr.stud_id = studinfo.stud_id
       
       WHERE cs.course_id = ? AND ay.ay = ?  ORDER BY `studinfo`.`lname` ASC";
    $result = $db_con->prepare($query);
    $result->execute([
        $courseID, $academic_year
    ]);


    $get_All_info = $result->fetchAll(PDO::FETCH_ASSOC);
}

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Record</title>
    <link rel="stylesheet" href="../css/bootstrap.css" />
    <link rel="stylesheet" href="../css/instructor_print.css" />
</head>

<body>
    <div id="page_print">
        <section class="report--card">
            <div class="container">
                <div class="print--btn-wrap">
                    <div class="print">
                        <a href="#">Print</a>
                    </div>
                </div>
                <div class="inner__container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="print--record-card">


                                <div class="container">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="print__record">
                                                <div class="content--wrapper">

                                                    <div class="logos--wrapper">
                                                        <img src="../img/logo__donjose.png" alt="">
                                                        <!-- <div class="school--logo">
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
                                                        </div> -->
                                                    </div>

                                                </div>
                                                <div class="content--wrapper list__content">
                                                    <div class="header__title">
                                                        <h1><span>GRADING SHEET</span></h1>
                                                    </div>
                                                    <div class="acad--wrapper">
                                                        <div class="academic--info">

                                                            <div class="other--info">
                                                                <div class="academic__term">
                                                                    <div class="term__info academic--year">
                                                                        <div class="acad--name">
                                                                            <h5>Academic Year: </h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="term__info semester">
                                                                        <div class="semester--name">
                                                                            <h5>Semester: </span></h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="term__info course--wrapper">
                                                                        <div class="course__descript">
                                                                            <div class="course__info">
                                                                                <h5>Course:</span></h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="term__info instructor--wrapper">
                                                                        <div class="instructor__name">
                                                                            <h5>Instructor: </h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="academic__term--info">
                                                                    <div class="term__info academic--year">
                                                                        <div class="acad--name">
                                                                            <h5><span><?php echo $_SESSION['acad'] ?></span></h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="term__info semester">
                                                                        <div class="semester--name">
                                                                            <h5><span><?php echo $_SESSION['sem'] ?></span></h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="term__info course--wrapper">
                                                                        <div class="course__descript">
                                                                            <div class="course__info">
                                                                                <h5><span><?php echo $get_info['course_desc'] ?></span></h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="term__info instructor--wrapper">
                                                                        <div class="instructor__name">
                                                                            <h5><span><?php echo $user['fname'] ?> <?php echo $user['mname'] ?> <?php echo $user['lname'] ?></span></h5>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="content--wrapper list__content">
                                                    <div class="list__students--wrapper">
                                                        <table class="tbl__info-grades">
                                                            <tr class="info--heading">
                                                                <th class="th_lname">Last Name</th>
                                                                <th class="th_fname">First Name</th>
                                                                <th class="th_mname">M.I</th>
                                                                <th>Program</th>
                                                                <th>Remarks</th>
                                                                <th>Grades</th>
                                                            </tr>
                                                            <tr class="spacer"></tr>
                                                            <!-- run the list of student -->
                                                            <?php foreach ($get_All_info as $row) : ?>
                                                                <tr class="main--status">
                                                                    <td class="td_names print__lname"><?php echo utf8_encode($row['lname'])  ?></td>
                                                                    <td class="td_names print__fname"><?php echo $row['fname'] ?></td>
                                                                    <td><?php echo $row['mname'] ?>.</td>
                                                                    <td><?php echo $row['program_name'] ?> - <?php echo $row['yearlvl'] ?></td>

                                                                    <!-- If the grades are lower than 75 it shows fails -->

                                                                    <?php if ($row['grade'] >= 75) : ?>
                                                                        <!--above 75 -->
                                                                        <td class="pass">PASSED</td>
                                                                    <?php endif ?>
                                                                    <?php if ($row['entry'] == 4) : ?>
                                                                        <!--lock == 4 -->
                                                                        <?php if ($row['grade'] < 75) : ?>
                                                                            <!--grades is 74 below and 0 automatic failed -->
                                                                            <td class="fail">FAILED</td>
                                                                        <?php endif ?>
                                                                    <?php else : ?>
                                                                        <?php if ($row['grade'] == 0) : ?>
                                                                            <!--grades == 0 is none graded -->
                                                                            <td class="none--g">No Grade</td>
                                                                        <?php elseif ($row['grade'] < 75) : ?>
                                                                            <!--grades is 74 below is failed -->
                                                                            <td class="fail">FAILED</td>
                                                                        <?php endif ?>

                                                                    <?php endif ?>


                                                                    <td>
                                                                        <div class="show--grades">
                                                                            <div class="show__grades">
                                                                                <h5 id="grades"><?php echo $row['grade'] ?></h5>
                                                                            </div>
                                                                        </div>

                                                                    </td>

                                                                </tr>

                                                                <tr class="spacer"></tr>

                                                            <?php endforeach ?>

                                                        </table>
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
                </div>
            </div>
        </section>

    </div>

    <script src="../app/jquery.min.js"></script>
    <script src="../app/printThis.js"></script>
    <script src="../app/jquery.lock.js"></script>

    <script>
        jQuery(document).ready(function() {
            $("h5,td,th").lock();
            $(".print a").on("click", function() {
                $(".print--record-card .print__record").printThis({
                    importCSS: true, // import parent page css
                    importStyle: true, // import style tags
                    loadCSS: "/css/instructor_print.css", // path to additional css file - use an array [] for multiple
                    base: "../Instructor/",
                    printDelay: 1000,
                })
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