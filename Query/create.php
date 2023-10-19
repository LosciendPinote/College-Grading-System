<?php
require("./connection/connect.php");


try {

    session_start();
// INSTRUCTOR
    if (isset($_POST['login_instructor'])) {
        $username =   $_POST['username_instructor'];
        $password =  $_POST['password_instructor'];

        $query = ("SELECT * FROM `tbl_instructor` WHERE
        `username`=? AND `password`=?");
        $result = $db_con->prepare($query);
        $result->execute([
            $username,
            $password
        ]);

        $user = $result->fetch();


        if (empty($_POST['username_instructor']) || empty($_POST['password_instructor'])) {
            echo "<script>alert('All Fields Are Required!');location.reload;</script>";
        } else {
            if (isset($user)) {
                if (($_POST['username_instructor'] == $user['username']) and ($_POST['password_instructor'] == $user['password'])) {
                    $_SESSION['user_id'] = $user['instructor_id'];

                    header("Location: Instructor-dashboard.php");
                } else {
                    echo "<script>alert('Error: No Data Found');location.reload;</script>";
                }
            }
        }
    }

    //STUDENT LOGIN
    if (isset($_POST['login_student'])) {
        $username = utf8_decode($_POST['student_username']);
        $password = md5($_POST['student_password']);

        $query="SELECT stud_id, `username`, `password` FROM `tbl_studentinfo` WHERE username=? AND password=?";
        $result = $db_con->prepare($query);
        $result->execute([
            $username,$password
        ]);
        $userstudent= $result->fetch(PDO::FETCH_ASSOC);

        if ($password ==  $userstudent['password']) {
            $_SESSION['userStudent'] = $userstudent['stud_id'];
            
            header("Location: ./Student/index.php");
        } else{
            echo "<script>alert('This Account is not Registered');</script>";
        }

    }

} catch (PDOException $e) {
    die('<script>alert("Error:.$e->getMessage()");</script>');
}
// END
