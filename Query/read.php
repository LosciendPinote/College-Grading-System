<?php
session_start();
require("../connection/connect.php");
if (isset($_SESSION['user_id'])) {
    require("../connection/connect.php");
}
if (isset($_SESSION['userStudent'])) {
    require("../connection/connect.php");
}


//for Settings.php


if (isset($_POST['settings_acad'])) {
    $instructorID = $_SESSION['user_id'];
    $academic_year = $_POST['settings_acad'];
    $semister  = $_POST['settings_semester'];


    $set_value = $_POST['set_value'];



    $_SESSION['courses'] = $academic_year;
    $query = ("SELECT cs.course_desc, cs.course_id, insload.sem
    FROM tbl_instructor ins 
    JOIN tbl_instructorload insload ON ins.instructor_id = insload.instructorID
    JOIN tbl_academicyear ay ON insload.ay_id = ay.ay_id
    
    JOIN tbl_instructorloaddetails insloadtls ON insload.ins_loadingID = insloadtls.ins_loadingID
    JOIN tbl_courses cs ON insloadtls.course_id = cs.course_id
    
    WHERE ins.instructor_id = ? AND insload.sem = ? AND ay.ay = ?  LIMIT 1");

    $result = $db_con->prepare($query);
    $result->execute([$instructorID, $semister, $academic_year]);
    $course_list = $result->fetch(PDO::FETCH_ASSOC);

    $_SESSION['acad'] = $academic_year;
    $_SESSION['sem'] =  $semister;
    $_SESSION['set_value'] = $set_value;
}

// // It Stop the Notice: Undefined index: set_value in C:\xampp\htdocs\GradingSystem\Query\read.php on line 46
// error_reporting(0);
if (!isset($_SESSION['set_value'])) {
    $_SESSION['acad'] = "2020-2021";
    $_SESSION['sem'] =  "1st";
}





/*View Academic Year */

$acadyear = '';
$query = "SELECT * FROM tbl_academicyear";
$result = $db_con->prepare($query);
$result->execute([$acadyear]);
$acad_val = $result->fetchAll(PDO::FETCH_ASSOC);



// Showing Instructor Courses

if (isset($_SESSION['user_id'])) {
    $academic_year =  $_SESSION['acad'];
    $semister  =  $_SESSION['sem'];
    $instructorID = $_SESSION['user_id'];

    $_SESSION['courses'] = $academic_year;
    $query = ("SELECT cs.course_desc, cs.course_id, cs.course_code
    FROM tbl_instructor ins 
    JOIN tbl_instructorload insload ON ins.instructor_id = insload.instructorID
    JOIN tbl_academicyear ay ON insload.ay_id = ay.ay_id
    
    JOIN tbl_instructorloaddetails insloadtls ON insload.ins_loadingID = insloadtls.ins_loadingID
    JOIN tbl_courses cs ON insloadtls.course_id = cs.course_id
    
    WHERE ins.instructor_id = ? AND insload.sem = ? AND ay.ay = ? ");

    $result = $db_con->prepare($query);
    $result->execute([$instructorID, $semister, $academic_year]);
    $course_list = $result->fetchAll(PDO::FETCH_ASSOC);
}




/* View List of Student to the targeted Course */
if (isset($_SESSION['CourseID'])) {
    $CourseID = $_SESSION['CourseID'];

    $query = ("SELECT ay.ay, cs.course_desc, prog.program_name, enr.yearlvl, studinfo.fname, studinfo.lname, studinfo.stud_id
        FROM tbl_courses cs
        JOIN tbl_load tbload ON tbload.course_id = cs.course_id
        JOIN tbl_enroll enr ON tbload.enroll_id = enr.enroll_id
        JOIN tbl_program prog ON enr.program_id = prog.program_id
        JOIN tbl_academicyear ay ON enr.ay_id = ay.ay_id
        JOIN tbl_studentinfo studinfo ON enr.stud_id = studinfo.stud_id
        
        WHERE cs.course_id = ? AND ay.ay_id = '7'  
        ORDER BY `studinfo`.`lname` ASC");

    $result = $db_con->prepare($query);
    $result->execute([$CourseID]);
    $student_list_val = $result->fetchAll(PDO::FETCH_ASSOC);
}


/*View Academic Year */




