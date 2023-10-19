<?php
session_start();
require("../connection/connect.php");



if (isset($_POST['gradeval'])) {

    $entry_val = $_POST['entry_val'];
    $entry_session =  $_POST['entry_val'] - 1;
    $setgrades = $_POST['gradeval'];
    $enrollID = $_SESSION['enrollID'];
    $courseID = $_SESSION['Course_id'];
    $query = "UPDATE `tbl_load` SET `grade`= ?,`entry`=? WHERE course_id = ? AND enroll_id = ? AND entry = ? ";
    $result = $db_con->prepare($query);
    $result->execute([
        $setgrades, $entry_val, $courseID, $enrollID, $entry_session
    ]);
    $getgrades = $result->fetch(PDO::FETCH_ASSOC);

    if (isset($_POST['entry_val'])) {
        $courseID = $_SESSION['Course_id'];
        $studentID =  $_SESSION['studentID'];
        $acad = $_SESSION['acad'];
        $query = ("SELECT ay.ay, cs.course_desc, prog.program_name, enr.yearlvl, studinfo.fname,LEFT(studinfo.mname, '1') AS mname, studinfo.lname,studinfo.email_add,studinfo.address,studinfo.contactNo,tbload.grade,tbload.entry
        FROM tbl_courses cs
        JOIN tbl_load tbload ON tbload.course_id = cs.course_id
        JOIN tbl_enroll enr ON tbload.enroll_id = enr.enroll_id
        JOIN tbl_program prog ON enr.program_id = prog.program_id
        JOIN tbl_academicyear ay ON enr.ay_id = ay.ay_id
        JOIN tbl_studentinfo studinfo ON enr.stud_id = studinfo.stud_id
        
        WHERE cs.course_id = ? AND ay.ay = ? AND studinfo.stud_id = ?  ");

        $result = $db_con->prepare($query);
        $result->execute(
            [
                $courseID, $acad,
                $studentID
            ]
        );
        $selected_student_val = $result->fetch(PDO::FETCH_ASSOC);
    }

?>
    <input id="g--f" type="number" name="grade" enrollID="<?php echo $enrollID ?>" entry="<?php echo  $selected_student_val['entry'] ?>" id="" value="<?php echo  $setgrades ?>" readonly class="">


<?php
}


?>