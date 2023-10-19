<?php
require_once("connection/connect.php");
$student_id = $_GET['id'];
$query = ("DELETE FROM tbl_student WHERE student_ID = :id ");
$result =$db_con ->prepare($query);
$result->execute([
    'id' => $student_id
]);
$rowsDeleted = $result->rowCount();
if($rowsDeleted==1){
echo "Data has been deleted";
}else{
    echo "Data already been deleted";  
}
