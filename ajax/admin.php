<?php

require("../connection/connect.php");
session_start();
//Ajax for Locking Entry
if (isset($_POST['acad_text']) || isset($_POST['sem_text'])) {

    $acad_text =   $_POST['acad_text'];
    $sem_text =  $_POST['sem_text'];

    $lock = 4;
    $query = "UPDATE `tbl_load` 

    JOIN tbl_enroll enr ON tbl_load.enroll_id = enr.enroll_id

    JOIN tbl_academicyear ay ON enr.ay_id = ay.ay_id
  
    SET tbl_load.entry= ? WHERE ay.ay = ? AND enr.sem=?
";
    $result = $db_con->prepare($query);
    $result->execute([
        $lock, $acad_text, $sem_text
    ]);
    echo "<script>alert('successfullly Lock!')</script>";
}

//Ajax for Unlocking Entry
if (isset($_POST['acad_unlock']) || isset($_POST['sem_unlock'])) {

    $acad_unlock =   $_POST['acad_unlock'];
    $sem_unlock =  $_POST['sem_unlock'];

    $lock = 0;
    $query = "UPDATE `tbl_load` 

    JOIN tbl_enroll enr ON tbl_load.enroll_id = enr.enroll_id

    JOIN tbl_academicyear ay ON enr.ay_id = ay.ay_id
  
    SET tbl_load.entry= ? WHERE ay.ay = ? AND enr.sem=?
";
    $result = $db_con->prepare($query);
    $result->execute([
        $lock, $acad_unlock, $sem_unlock
    ]);
    echo "<script>alert('successfullly UnLock!')</script>";
}



//Set the html Staus
if ((isset($_POST['acad_text']) || isset($_POST['sem_text']))) {


    $acad_text = $_POST['acad_text'];
    $sem_text = $_POST['sem_text'];

    $query = "SELECT ay.ay, cs.course_desc, prog.program_name, enr.yearlvl, studinfo.fname,LEFT(studinfo.mname, '1') AS mname, studinfo.lname,studinfo.email_add,studinfo.address,studinfo.contactNo,tbload.grade,tbload.entry,studinfo.stud_id
   FROM tbl_courses cs
   JOIN tbl_load tbload ON tbload.course_id = cs.course_id
   JOIN tbl_enroll enr ON tbload.enroll_id = enr.enroll_id
   JOIN tbl_program prog ON enr.program_id = prog.program_id
   JOIN tbl_academicyear ay ON enr.ay_id = ay.ay_id
   JOIN tbl_studentinfo studinfo ON enr.stud_id = studinfo.stud_id
   
   WHERE  ay.ay = ? AND enr.sem=? LIMIT 1";
    $result = $db_con->prepare($query);
    $result->execute([
        $acad_text, $sem_text
    ]);
    $get_entry = $result->fetch(PDO::FETCH_ASSOC);


?>
    <?php if ($get_entry['entry'] == 4) : ?>
        <h5>Already Locked!</h5>
    <?php endif ?>

<?php
}

if (isset($_POST['acad_unlock']) || isset($_POST['sem_unlock'])) {
    $acad_text = $_POST['acad_unlock'];
    $sem_text = $_POST['sem_unlock'];

    $query = "SELECT ay.ay, cs.course_desc, prog.program_name, enr.yearlvl, studinfo.fname,LEFT(studinfo.mname, '1') AS mname, studinfo.lname,studinfo.email_add,studinfo.address,studinfo.contactNo,tbload.grade,tbload.entry,studinfo.stud_id
    FROM tbl_courses cs
    JOIN tbl_load tbload ON tbload.course_id = cs.course_id
    JOIN tbl_enroll enr ON tbload.enroll_id = enr.enroll_id
    JOIN tbl_program prog ON enr.program_id = prog.program_id
    JOIN tbl_academicyear ay ON enr.ay_id = ay.ay_id
    JOIN tbl_studentinfo studinfo ON enr.stud_id = studinfo.stud_id
    
    WHERE  ay.ay = ? AND enr.sem=? LIMIT 1";
    $result = $db_con->prepare($query);
    $result->execute([
        $acad_text, $sem_text
    ]);
    $get_entry = $result->fetch(PDO::FETCH_ASSOC);


?>
    <?php if ($get_entry['entry'] == 0) : ?>
        <h5>Already Unlocked!</h5>
    <?php endif ?>

<?php
}
//Display Lock or unlock Status by selecting academic and semester
if (isset($_POST['check'])) {
    $acad_attr =   $_POST['acad_attr'];
    $sem_attr =  $_POST['sem_attr'];
    $query = "SELECT ay.ay, cs.course_desc, prog.program_name, enr.yearlvl, studinfo.fname,LEFT(studinfo.mname, '1') AS mname, studinfo.lname,studinfo.email_add,studinfo.address,studinfo.contactNo,tbload.grade,tbload.entry,studinfo.stud_id
   FROM tbl_courses cs
   JOIN tbl_load tbload ON tbload.course_id = cs.course_id
   JOIN tbl_enroll enr ON tbload.enroll_id = enr.enroll_id
   JOIN tbl_program prog ON enr.program_id = prog.program_id
   JOIN tbl_academicyear ay ON enr.ay_id = ay.ay_id
   JOIN tbl_studentinfo studinfo ON enr.stud_id = studinfo.stud_id
   
   WHERE  ay.ay = ? AND enr.sem=? LIMIT 1";
    $result = $db_con->prepare($query);
    $result->execute([
        $acad_attr, $sem_attr
    ]);
    $get_entry = $result->fetch(PDO::FETCH_ASSOC);


?>
    <?php if ($get_entry['entry'] == 4) : ?>
        <h5>Lock!</h5>
    <?php else : ?>
        <h5>Not Lock!</h5>
    <?php endif ?>

<?php
}
