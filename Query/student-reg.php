<?php
require("../connection/connect.php");
session_start();

/*View Student Civil Status */
$cv = '';

$query = "SELECT cs_desc, cs_id
  FROM tbl_civilstatus";
$result = $db_con->prepare($query);
$result->execute([$cv]);
$view_cv = $result->fetchAll(PDO::FETCH_ASSOC);


if (isset($_POST['elemval'])) :
  $val = '';
  $elemval = $_POST['elemval'];
  $query = "SELECT elemSch_id,elemSch_desc FROM `tbl_elemschool` 
            WHERE elemSch_desc LIKE '%$elemval%'";
  $result = $db_con->prepare($query);
  $result->execute([$val]);
  $get_elem_item = $result->fetchAll(PDO::FETCH_ASSOC);




?>

  <?php foreach ($get_elem_item as $row) : ?>
    <div class="modal__item" elemID="<?php echo $row['elemSch_id'] ?>">
      <h5><?php echo $row['elemSch_desc'] ?></h5>
    </div>
  <?php endforeach ?>
<?php endif ?>



<?php if (isset($_POST['highschoolval'])) :
  $val = '';
  $highschoolval = $_POST['highschoolval'];
  $query = "SELECT highSch_id,highSch_desc FROM `tbl_highschool` 
            WHERE highSch_desc LIKE '%$highschoolval%'";
  $result = $db_con->prepare($query);
  $result->execute([$val]);
  $get_highschool_item = $result->fetchAll(PDO::FETCH_ASSOC);
?>

  <?php foreach ($get_highschool_item as $row) : ?>
    <div class="modal__item" highschoID="<?php echo $row['highSch_id'] ?>">
      <h5><?php echo $row['highSch_desc'] ?></h5>
    </div>
  <?php endforeach ?>
<?php endif ?>


<?php if (isset($_POST['parentval'])) :
  $val = '';
  $parentval = $_POST['parentval'];
  $query = "SELECT tbl_parentinfo.pg_name,tbl_parentinfo.pg_id FROM `tbl_parentinfo` 
            WHERE tbl_parentinfo.pg_name LIKE '%$parentval%'";
  $result = $db_con->prepare($query);
  $result->execute([$val]);
  $get_parent_list = $result->fetchAll(PDO::FETCH_ASSOC);
?>

  <?php foreach ($get_parent_list as $row) : ?>
    <div class="modal__item" parentID="<?php echo $row['pg_id'] ?>">
      <h5><?php echo $row['pg_name'] ?></h5>
    </div>
  <?php endforeach ?>
<?php endif ?>

<?php if (isset($_POST['parentName']) && isset($_POST['parentNumber'])) :

  $parentName = $_POST['parentName'];
  $parentNumber = '09' . $_POST['parentNumber'];

  $query = "SELECT `pg_name`, `pg_contact` FROM `tbl_parentinfo` WHERE pg_name = ?";
  $result = $db_con->prepare($query);
  $result->execute([$parentName]);
  $get_parent_list = $result->fetch();
?>

  <?php if ($get_parent_list['pg_name'] == $parentName) { ?>

    <?php
    $parentList = $get_parent_list['pg_name'];
    echo json_encode(array('parent_list' => $parentList));
    exit();
    ?>

  <?php } else {
    $query = "INSERT INTO `tbl_parentinfo`(`pg_name`, `pg_contact`)
    VALUES (?,?)";
    $result = $db_con->prepare($query);
    $result->execute([$parentName, $parentNumber]);

    echo json_encode(array('savedParents' => 'true'));
    exit();
  }

  ?>



<?php endif ?>


<?php if (isset($_POST['academicVal']) || isset($_POST['semesterVal'])) :

  $_SESSION['semesterVal'] = $_POST['semesterVal'];
  $_SESSION['academicVal'] = $_POST['academicVal'];
  $academicval =  $_SESSION['academicVal'];
  $semesterval = $_SESSION['semesterVal'];
  $studentID = $_SESSION['userStudent'];

  $query = "SELECT DISTINCT crs.course_desc,crs.course_code, inst.fname,inst.mname,inst.lname, tbload.grade, tbload.entry
            FROM (SELECT instructor_id, course_id FROM  tbl_instructor 
            JOIN tbl_instructorload ON tbl_instructorload.instructorID = tbl_instructor.instructor_id
            JOIN tbl_instructorloaddetails ON tbl_instructorloaddetails.ins_loadingID = tbl_instructorload.ins_loadingID
            JOIN tbl_academicyear ON tbl_academicyear.ay_id = tbl_instructorload.ay_id
            WHERE tbl_academicyear.ay = :academicval AND tbl_instructorload.sem = :semesterval) inscurload, tbl_load tbload
            JOIN tbl_enroll enr ON tbload.enroll_id = enr.enroll_id
            JOIN tbl_courses crs ON tbload.course_id = crs.course_id
            JOIN tbl_studentinfo studinfo ON enr.stud_id = studinfo.stud_id
            JOIN tbl_academicyear acad ON enr.ay_id = acad.ay_id
            JOIN tbl_instructorloaddetails instloadt ON crs.course_id = instloadt.course_id
            JOIN tbl_instructorload instload ON instload.ins_loadingID = instloadt.ins_loadingID
            JOIN tbl_instructor inst ON instload.instructorID = inst.instructor_id
            WHERE studinfo.stud_id = :studentID AND acad.ay = :academicval AND enr.sem = :semesterval
            AND inst.instructor_id = inscurload.instructor_id
            AND tbload.course_id = inscurload.course_id";
  $result = $db_con->prepare($query);
  $result->execute([
    'studentID' =>  $studentID,
    'academicval' =>  $academicval,
    'semesterval' =>   $semesterval
  ]);

  $Getinfogrades = $result->fetchAll(PDO::FETCH_ASSOC);
?>

  <table class="tbl__info-rades">
    <tr class="info--heading">
      <th>Courses</th>
      <th>Course Code</th>
      <th>Instructor</th>
      <th>Remarks</th>
      <th class="grades">Grades</th>
    </tr>

    <tr class="main--status display remove--bg hide">

      <td class="loading">
        <div class="student--loading">
          <svg class="pl" viewBox="0 0 64 64" width="64px" height="64px" xmlns="http://www.w3.org/2000/svg">
            <defs>
              <linearGradient id="grad" x1="0" y1="0" x2="0" y2="1">
                <stop offset="0%" stop-color="#000" />
                <stop offset="100%" stop-color="#fff" />
              </linearGradient>
              <mask id="grad-mask">
                <rect x="0" y="0" width="64" height="64" fill="url(#grad)" />
              </mask>
            </defs>
            <circle class="pl__ring" cx="32" cy="32" r="26" fill="none" stroke="hsl(223,90%,55%)" stroke-width="12" stroke-dasharray="169.65 169.65" stroke-dashoffset="-127.24" stroke-linecap="round" transform="rotate(135)" />
            <g fill="hsl(223,90%,55%)">
              <circle class="pl__ball1" cx="32" cy="45" r="6" transform="rotate(14)" />
              <circle class="pl__ball2" cx="32" cy="48" r="3" transform="rotate(-21)" />
            </g>
            <g mask="url(#grad-mask)">
              <circle class="pl__ring" cx="32" cy="32" r="26" fill="none" stroke="hsl(283,90%,55%)" stroke-width="12" stroke-dasharray="169.65 169.65" stroke-dashoffset="-127.24" stroke-linecap="round" transform="rotate(135)" />
              <g fill="hsl(283,90%,55%)">
                <circle class="pl__ball1" cx="32" cy="45" r="6" transform="rotate(14)" />
                <circle class="pl__ball2" cx="32" cy="48" r="3" transform="rotate(-21)" />
              </g>
            </g>
          </svg>
        </div>
      </td>
      <?php foreach ($Getinfogrades as $row) : ?>
       
    <tr class="main--status main">
      <td><?php echo $row['course_desc'] ?></td>
      <td><?php echo $row['course_code'] ?></td>
      <td class="instructor_name"><?php echo $row['fname'] ?> <?php echo $row['mname'] ?> <?php echo $row['lname'] ?></td>
      <?php if ($row['grade'] >= 75) : ?>
        <td class="pass">
          <h5><span>P</span>ASS</h5>
        </td>
        <td>
          <div class="show--grades">
            <div class="show__grades">
              <h5><?php echo $row['grade'] ?></h5>
            </div>
            <div class="show__grades-status">
              <div class="inner__grades-status">
              </div>
            </div>
          </div>
        </td>
      <?php endif ?>
      <?php if ($row['entry'] == 4) : ?>
        <?php if ($row['grade'] <= 74) : ?>
          <td class="pass fail">
            <h5><span>F</span>AILED</h5>
          </td>
          <td>
            <div class="show--grades">
              <div class="show__grades fail">
                <h5><?php echo $row['grade'] ?></h5>
              </div>
              <div class="show__grades-status">
                <div class="inner__grades-status fail">
                </div>
              </div>
            </div>
          </td>
        <?php endif ?>
      <?php else : ?>
        <?php if ($row['grade'] == 0) : ?>
          <td class="pass example">
            <h5><span>N</span>GRADED</h5>
          </td>
          <td>
            <div class="show--grades">
              <div class="show__grades example">
                <h5><?php echo $row['grade'] ?></h5>
              </div>
              <div class="show__grades-status">
                <div class="inner__grades-status example">
                </div>
              </div>
            </div>
          </td>
        <?php elseif ($row['grade'] <= 74) : ?>
          <td class="pass fail">
            <h5><span>F</span>AILED</h5>
          </td>
          <td>
            <div class="show--grades">
              <div class="show__grades fail">
                <h5><?php echo $row['grade'] ?></h5>
              </div>
              <div class="show__grades-status">
                <div class="inner__grades-status fail">
                </div>
              </div>
            </div>
          </td>
        <?php endif ?>
      <?php endif ?>
    </tr>
   
    <tr class="spacer"></tr>


  <?php endforeach ?>

  </tr>
  </tr>


  </table>



<?php endif ?>