<?php
require_once("connection/connect.php");

$id = $_POST['id_update'];
$firstname = $_POST['fname_update'];
$middlename = $_POST['mname_update'];
$lastname = $_POST['lname_update'];

$query = ("UPDATE tbl_student SET firstName = :firstname,middleName =:middlename,lastName=:lastname WHERE student_ID = :id");

$result = $db_con->prepare($query);
$result->execute([
  'firstname' => $firstname,
  'middlename' => $middlename,
  'lastname' => $lastname,
  'id' => $id
]);
$rowUpdated = $result->rowCount();


if (isset($_POST['updatebtn'])) {
  if ((empty($_POST['fname_update'])) OR (empty($_POST['mname_update'])) OR (empty($_POST['lname_update']))){
    echo '<script>alert("All Fields are Required!");location.reload;</script>';
  }else{
    if ($rowUpdated == 1) {
      echo '<script>alert("Success Update");location.reload;</script>';
      header("Location: list-Student.php");
    } else {
      echo '<script>alert("Please Change the Value")</script>';
    }
  }
    
}

$db_con = NULL;
