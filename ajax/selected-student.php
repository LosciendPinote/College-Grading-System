<?php



require("../connection/connect.php");

session_start();

$studentID = $_POST['studentval'];

$courseID = $_SESSION['Course_id'];

$acad = $_SESSION['acad'];

/* View List of Student to the targeted Course */

if (isset($studentID)) {

  $query = ("SELECT ay.ay, cs.course_desc, prog.program_name, enr.yearlvl, studinfo.fname,LEFT(studinfo.mname, '1') AS mname, studinfo.lname,studinfo.email_add,studinfo.address,studinfo.contactNo,tbload.grade,tbload.entry,studinfo.stud_id

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

  $selected_student_val = $result->fetchAll(PDO::FETCH_ASSOC);



  $_SESSION['enrollID'] = $_POST['enrollID'];

  $_SESSION['studentID'] = $_POST['studentval'];

  foreach ($selected_student_val as $row) : ?>





    <div class="status-inner">

      <div class="student-icon">

        <!-- IMAGE RANI -->

      </div>

      <div class="student-name--wrapper">

        <div class="student--info student-name text__primary">

          <h5><?php echo utf8_encode($row['fname'])  ?> <?php echo $row['mname'] ?>. <?php echo utf8_encode($row['lname']) ?></h5>

        </div>

        <div class="student--info student-position text--white">

          <h5><?php echo $row['program_name'] ?> - <?php echo $row['yearlvl'] ?></h5>

        </div>

      </div>

    </div>

    <div class="student--info__wrap">

      <div class="student--info__1 student-program--wrap">

        <div class="info__icon student-program">

          <img src="../img/instructor-dashboard/Student--info/email.svg" alt="" />

        </div>

        <div class="student--info student-address__text text--white">



          <div class="inner_course">



            <h5><?php echo utf8_encode($row['email_add'])   ?></h5>



          </div>



        </div>



      </div>

      <div class="student--info__1 student-number--wrap">

        <div class="info__icon student-number">

          <img src="../img/instructor-dashboard/Student--info/number.svg" alt="">

        </div>

        <div class="student--info student-number__text text--white">

          <h5><?php echo $row['contactNo'] ?></h5>

        </div>

      </div>



      <div class="student--info__1 student-address--wrap">

        <div class="info__icon student-address">

          <img src="../img/instructor-dashboard/Student--info/location.svg" alt="">

        </div>

        <div class="student--info student-address__text text--white">



          <div class="inner_course">

            <h5>

              <?php echo utf8_encode($row['address']) ?>

            </h5>

          </div>



        </div>

      </div>



    </div>





    <p><?php echo $row['course_desc'] ?></p>







  <?php endforeach ?>





  <?php foreach ($selected_student_val as $row) : ?>

    <input type="number" entry="<?php echo $row['entry'] ?>" studentID="<?php echo $row['stud_id'] ?>" name="grade" id="" value="<?php echo $row['grade'] ?>" readonly>





  <?php endforeach ?>

<?php   } ?>