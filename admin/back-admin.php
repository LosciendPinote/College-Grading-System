<?php
require("../connection/connect.php");
session_start();
// admin Login

if (isset($_POST['admin__login'])) {
    require("../connection/connect.php");
    if ($_POST['admin__user'] == "" && $_POST['admin__password'] == "") {
        echo "<script>
        alert('Field must Required!')
        </script>";
    } else {
        $db_username = $_POST['admin__user'];
        $password = md5($_POST['admin__password']);
        $userlvl = "Administrator";
        $query = "SELECT `userID`, `Name`, `Username`, `Pass`, `UserLevel` FROM `tbl_users` 
                    WHERE Username = :db_username AND Pass =:password AND UserLevel =:userlvl";
        $result = $db_con->prepare($query);
        $result->execute([
            'db_username' => $db_username,
            'password' => $password,
            'userlvl' =>  $userlvl
        ]);
        $row = $result->rowCount();
        $getUser = $result->fetch(PDO::FETCH_ASSOC);

        if ($row == 1) {
            header("Location: admin.php");
            // user session for admin user
            $_SESSION['admin-user'] = $getUser['userID'];
        } else {
            echo "<script>
            alert('Error: No data Found!')
            </script>";
        }
    }
}


//Displaying Academic year
if (isset($_SESSION['admin-user'])) {

    $query = "SELECT `ay_id`, `ay` FROM `tbl_academicyear`";
    $result = $db_con->prepare($query);
    $result->execute([]);
    $get_acad = $result->fetchAll(PDO::FETCH_ASSOC);
}



