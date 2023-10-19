<?php
require("../connection/connect.php");

session_start();

$CourseID = $_POST['courseval'];

//Get the Session value of course ID for Instructor Print Record
$_SESSION['CourseID'] = $CourseID;

$acadyear = $_SESSION['acad'];
/* View List of Student to the targeted Course */
if (isset($CourseID)) {

    if (isset($_POST['searchName'])) {
        $searchName = utf8_decode($_POST['searchName']);
    }
    if (!isset($_POST['searchName'])) {
        $searchName = "";
    }


    $query = ("SELECT ay.ay, cs.course_desc, prog.program_name, enr.yearlvl, studinfo.fname,
    LEFT(studinfo.mname, '1') AS mname, studinfo.lname, studinfo.stud_id,enr.enroll_id,tbload.entry
        FROM tbl_courses cs
        JOIN tbl_load tbload ON tbload.course_id = cs.course_id
        JOIN tbl_enroll enr ON tbload.enroll_id = enr.enroll_id
        JOIN tbl_program prog ON enr.program_id = prog.program_id
        JOIN tbl_academicyear ay ON enr.ay_id = ay.ay_id
        JOIN tbl_studentinfo studinfo ON enr.stud_id = studinfo.stud_id
        
        WHERE cs.course_id = ? AND ay.ay = ? AND CONCAT(studinfo.fname,' ',studinfo.lname) LIKE '%$searchName%'
        ORDER BY `studinfo`.`lname` ASC");

    $result = $db_con->prepare($query);
    $result->execute([$CourseID, $acadyear]);
    $student_list_val = $result->fetchAll(PDO::FETCH_ASSOC);

    $_SESSION['Course_id'] = $CourseID;
?>
<div class="loading-wrap">
            <div class="skeleton">
                <div class="skeleton__block"></div>
                <div class="skeleton__block"></div>
                <div class="skeleton__block"></div>
            </div>

            <div class="skeleton">
                <div class="skeleton__block"></div>
                <div class="skeleton__block"></div>
                <div class="skeleton__block"></div>
            </div>

            <div class="skeleton">
                <div class="skeleton__block"></div>
                <div class="skeleton__block"></div>
                <div class="skeleton__block"></div>
            </div>
            <div class="skeleton">
                <div class="skeleton__block"></div>
                <div class="skeleton__block"></div>
                <div class="skeleton__block"></div>
            </div>
             <div class="skeleton">
                <div class="skeleton__block"></div>
                <div class="skeleton__block"></div>
                <div class="skeleton__block"></div>
            </div>
        </div>

<?php
    foreach ($student_list_val as $row) : ?>

       

        <div class="student-content__inner">

            <div class="list-student__wrap">
                <!-- For the students who belongs to entry 4 turns color red -->
                <?php if ($row['entry']  == 4) : ?>
                    <div class="entry--info entry__red"></div>
                <?php endif ?>
                <!-- For the students who belongs to entry 3 turns color red -->
                <?php if ($row['entry']  == 3) : ?>
                    <div class="entry--info entry__red"></div>
                <?php endif ?>
                <!-- For the students who belongs to entry 2 turns color yellow -->
                <?php if ($row['entry']  == 2) : ?>
                    <div class="entry--info entry__yellow"></div>
                <?php endif ?>
                <!-- For the students who belongs to entry 1 turns color green -->
                <?php if ($row['entry']  == 1) : ?>
                    <div class="entry--info entry__green"></div>
                <?php endif ?>
                <!-- For the students who belongs to entry 0 Default -->
                <?php if ($row['entry']  == 0) : ?>
                    <div class="entry--info"></div>
                <?php endif ?>
                <div class="student--icon">

                </div>
                <div class="student-name--wrapper" studentVal="<?php echo $_SESSION['studentID'] = $row['stud_id'] ?>" enrollID="<?php echo $row['enroll_id'] ?>" entry="<?php echo $row['entry'] ?>">
                    <div class="student--info student-name">

                        <h5> <?php echo  utf8_encode($row['lname']) ?>, <?php echo utf8_encode($row['fname']) ?> <?php echo $row['mname'] ?>.</h5>
                    </div>
                    <div class="student--info student-position">
                        <h5><?php echo $row['program_name'] ?> - <?php echo $row['yearlvl'] ?></h5>
                    </div>
                    <?php if ($row['entry'] == 4) : ?>
                        <div class="student--info student-lock">
                            <h5>Locked</h5>
                        </div>
                    <?php endif ?>

                </div>
            </div>
        </div>
    <?php endforeach ?>
<?php
}




?>

<div class="search--inner">
    <form action="" method="post">
        <input type="text" name="student-name" placeholder="Search Student ID" id="">
    </form>
</div>