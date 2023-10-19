<?php

// require_once("connection/connect.php");

// $query = ("SELECT 'userName','passWord' FROM tbl_student ");
// $dbView = $db_con->query($query);

// if (isset($_POST['fname']) || isset($_POST['mname']) || isset($_POST['lname']) || isset($_POST['username']) || isset($_POST['password'])) {
//     $Fname = $_POST['fname'];
//     $Mname = $_POST['mname'];
//     $Lname = $_POST['lname'];
//     $username = $_POST['username'];
//     $password = $_POST['password'];

//     $query = ("INSERT INTO tbl_student(`firstName`, `middleName`, `lastName`, `userName`, `passWord`) 
//     VALUES( '$Fname','$Mname', '$Lname','$username','$password')");

//     if ($db_con->exec($query)) {
//         echo "<script>alert('Successfully Registered');location.reload;</script>";

//         $db_con = NULL;
//     } else {
//         echo "<script>alert('Register Failed :(');location.reload;</script>";
//         $db_con = NULL;
//     }
// }







if (isset($_POST['register'])) {
    require("./connection/connect.php");


    $faculty_ID = $_POST['faculty_id'];
    $FirstName = $_POST['fname'];
    $Middle_name = $_POST['mname'];
    $Last_name = $_POST['lname'];
    $Name_ext = $_POST['name_ext'];
    $Position = $_POST['position'];
    $Address = $_POST['address'];
    $Username = $_POST['username'];
    $Password = $_POST['password'];
    $passwordHashed = password_hash($Password, PASSWORD_DEFAULT);

    $query = ("SELECT * FROM `tbl_instructor` WHERE (`faculty_id`=:faculty_id) OR  (`fname`= :firstname AND `lname`=:lastname AND `username` =:username AND `password` =:password)");
    $result = $db_con->prepare($query);
    $result->execute([
        'faculty_id' => $faculty_ID,
        'firstname' => $FirstName,
        'lastname' => $Last_name,
        'username' => $Username,
        'password' => $Password
    ]);
    $row = $result->rowCount();

    if (
        empty($faculty_ID) || empty($FirstName) || empty($Middle_name)
        || empty($Last_name) || empty($Name_ext) || empty($Name_ext) || empty($Position)
        || empty($Address) || empty($Username) || empty($Password)
    ) {
        echo "<script>alert('All Fields Are Requird');</script>";
    } else {

        if ($row == 1) {
            echo "<script>alert('Account Already Been Taken');location.reload;</script>";
        } else {


            $query = ("INSERT INTO `tbl_instructor` (`faculty_id`, `fname`, `mname`, `lname`, `name_ext`, `position`, `address`, `username`, `password`) 
        VALUES(?,?,?,?,?,?,?,?,?)");
            $result = $db_con->prepare($query);

            if ($result->execute([
                $faculty_ID, $FirstName, $Middle_name, $Last_name, $Name_ext, $Position, $Address, $Username, $passwordHashed
            ])) {
                echo "<script>alert('Successfully Registered');location.reload;</script>";
                $db_con = NULL;
            } else {
                echo "<script>alert('Register Failed! ');location.reload;</script>";
                $db_con = NULL;
            }
        }
    }
}
// Register STUDENT
if (isset($_POST['register_student'])) {
    require("../connection/connect.php");


    $StudentID = $_POST['StudentID'];
    $Firstname = $_POST['Firstname'];
    $Middlename = $_POST['Middlename'];
    $Lastname = $_POST['Lastname'];
    $Sex = $_POST['Sex'];
    $civil = $_POST['val-cs'];
    $DOB = $_POST['DOB'];
    $POB = $_POST['POB'];
    $Address = $_POST['Address'];
    $email_add = $_POST['email_add'];
    $elemcomplete = $_POST['val-elemcomplete'];
    $hs_complete = $_POST['val-elemcomplete'];
    $elem_year = $_POST['elem_year'];
    $hs_year = $_POST['hs_year'];
    $con_num = $_POST['con_num'];
    $parent_name = $_POST['val-parent_name'];
    $Username = $_POST['Username'];
    $password = $_POST['password'];
    $password_hash = md5($password);
   
 
   
        $query = "SELECT `stud_id`, `fname`, `lname` FROM tbl_studentinfo WHERE stud_id =:studID OR fname=:Fname AND lname=:Lname";
        $result = $db_con->prepare($query);
        $result->execute([
            'studID' => $StudentID,
            'Fname' => $Firstname,
            'Lname' => $Lastname
        ]);
        $row = $result->rowCount();
        if ($row == 1) {
            echo "<script>alert('Account Already Been Taken');</script>";
        } else {
            $query = "INSERT INTO `tbl_studentinfo`(`stud_id`, `fname`, `mname`, `lname`, `sex`, `cs_id`, `dob`, `pob`, 
                          `address`, `email_add`, `elem_completed_id`, `hs_completed_id`, `eYear`, `sYear`, `contactNo`,
                         `pg_id`, `username`, `password`) 
                         VALUES (:StudentID,:Firstname,:Middlename,:Lastname,:Sex,:civil,:DOB,:POB,:Address,:email_add,
                         :elemcomplete,:hs_complete,:elem_year,:hs_year,:con_num,:parent_name,:Username,:password)";
            $result = $db_con->prepare($query);
            if ($result->execute([
                'StudentID' => $StudentID,
                'Firstname' => $Firstname,
                'Middlename' => $Middlename,
                'Lastname' => $Lastname,
                'Sex' => $Sex,
                'civil' => $civil,
                'DOB' => $DOB,
                'POB' => $POB,
                'Address' => $Address,
                'email_add' => $email_add,
                'elemcomplete' => $elemcomplete,
                'hs_complete' => $hs_complete,
                'elem_year' => $elem_year,
                'hs_year' => $hs_year,
                'con_num' => $con_num,
                'parent_name' => $parent_name,
                'Username' => $Username,
                'password' => $password_hash
            ])) {
                echo "<script>alert('Successfully Registered');location.reload;</script>";
                $db_con = NULL;
            } else {
                echo "<script>alert('Failed to register');location.reload;</script>";
                $db_con = NULL;
            }
        }
    
}
