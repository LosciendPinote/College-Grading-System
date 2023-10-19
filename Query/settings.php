<?php
session_start();
require("./connection/connect.php");

// Showing Instructor Courses

$instructorID = $_SESSION['user_id'];

if (isset($_POST['savesettings'])) {
    $academic_year = $_POST['course-acad'];
    $semister  = $_POST['course-sem'];

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
}
if (!isset($_POST['savesettings'])) {
    $_SESSION['acad'] = "2020-2021";
    $_SESSION['sem'] =  "1st";

}



/*View Academic Year */

$acadyear = '';

if (isset($instructorID)) {
    $query = "SELECT * FROM tbl_academicyear";
    $result = $db_con->prepare($query);
    $result->execute([$acadyear]);
    $acad_val = $result->fetchAll(PDO::FETCH_ASSOC);
}
