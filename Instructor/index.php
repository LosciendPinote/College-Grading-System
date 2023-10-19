<?php

require("../Query/read.php");


if (isset($_SESSION['user_id'])) {
  require("../connection/connect.php");
  $instructor_user = $_SESSION['user_id'];

  $query = ("SELECT * FROM `tbl_instructor` WHERE instructor_id = ? ");
  $result = $db_con->prepare($query);
  $result->execute([
    $instructor_user
  ]);
  $user = $result->fetch();
} else {
  header("Location: ../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Instrutor Dashboard</title>
  <link rel="stylesheet" href="../css/instructor-ui.css" />
  <link rel="stylesheet" href="../css/bootstrap.css" />
  <link rel="stylesheet" href="../css/themify-icons.css" />
  <link rel="stylesheet" href="../css/loading.css">
  <script src="../app/jquery.min.js"></script>
  <script src="../app/gsap-public/minified/gsap.min.js"></script>
</head>

<body>

  <section class="section instructor-dashboard">
    <div class="container-fluid">
      <div class="row height-100vh">
        <div class="col-md-2 instructor--nav">
          <?php require_once("sidebar.php") ?>
        </div>
        <div class="col-md-7">
          <div class="inner-col has_flex jc-end">

            <div class="status--wrapper primary--bg">
              <div class="status-text text-secondary">
                <h5>Status:</h5>
              </div>
              <div class="acad-year--text text-secondary">
                <h5>Academic Year:
                  <?php if (isset($_SESSION['acad'])) : ?>
                    <span><?php echo $_SESSION['acad'] ?></span>
                </h5>
              <?php endif ?>

              </div>
              <div class="semister--text text-secondary">
                <h5> Semester:
                  <?php if (isset($_SESSION['sem'])) : ?>
                    <span><?php echo $_SESSION['sem'] ?></span> <span>Sem</span>
                </h5>
              <?php endif ?>

              </div>
            </div>

            <div class="welcome__dashboard--wrapper">
              <div class="welcome-dashboard ">
                <div class="inner__welcome primary--bg text-secondary">
                  <div class="welcome--text">
                    <h2>Welcome Back, <span><?php echo $user['fname'] ?>!</span></h2>
                  </div>
                  <div class="guide--text">
                    <h5>View settings to update A.Y. and Semester </h5>
                  </div>
                  <div class="guide--text reminders">
                    <h5>Reminder: Grades can update only 3 times</h5>
                  </div>

                </div>
              </div>
              <div class="welcome-dashboard legends--info">
                <div class="inner__welcome primary--bg text-secondary">
                  <div class="welcome--heading">
                    <h2>LEGEND</h2>
                  </div>
                  <div class="legends__list">
                    <div class="legend__item legend__0">
                      <div class="entry-0 entry-color"></div>
                      <div class="legend--descripton legend__descript__0">
                        <p>No Entry Grades</p>
                      </div>
                    </div>
                    <div class="legend__item legend__1">
                      <div class="entry-1 entry-color"></div>
                      <div class="legend--descripton legend__descript__1">
                        <p>First Entry of Grades</p>
                      </div>
                    </div>
                    <div class="legend__item legend__2">
                      <div class="entry-2 entry-color"></div>
                      <div class="legend--descripton legend__descript__2">
                        <p>Second Entry of Grades</p>
                      </div>
                    </div>
                    <div class="legend__item legend__3">
                      <div class="entry-3 entry-color"></div>
                      <div class="legend--descripton legend__descript__3">
                        <p>3rd Entry of Grades</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="status-grade--ui primary--bg">

              <div class="status-grade__inner">
                <div class="student--upper__wrap">

                  <div class="student-status__wrapper">
                    <div class="student-status__inner">

                      <div class="student-wrapper studentinfo">
                        <div class="status-inner">
                          <div class="student-icon">
                            <!-- IMAGE RANI -->
                          </div>
                          <div class="student-name--wrapper">
                            <div class="student--info student-name text__primary">
                              <h5>Student Name</h5>
                            </div>
                            <div class="student--info student-position text--white">
                              <h5>Student Program & Level</h5>
                            </div>
                          </div>
                        </div>
                        <div class="student--info__wrap">
                          <div class="student--info__1 student-program--wrap">
                            <div class="info__icon student-program">
                              <img src="../img/instructor-dashboard/Student--info/email.svg" alt="" />
                            </div>
                            <div class="student--info student-program__text text--white">
                              <h5>Email Address</h5>
                            </div>
                          </div>
                          <div class="student--info__1 student-number--wrap">
                            <div class="info__icon student-number">
                              <img src="../img/instructor-dashboard/Student--info/number.svg" alt="">
                            </div>
                            <div class="student--info student-number__text text--white">
                              <h5>Contact Number</h5>
                            </div>
                          </div>

                          <div class="student--info__1 student-address--wrap">
                            <div class="info__icon student-address">
                              <img src="../img/instructor-dashboard/Student--info/location.svg" alt="">
                            </div>
                            <div class="student--info student-address__text text--white">
                              <h5>
                                Address
                              </h5>
                            </div>
                          </div>

                        </div>
                      </div>


                    </div>


                  </div>

                  <div class="student-status__wrapper">
                    <div class="student-status__inner">
                      <div class="student-wrapper student">
                        <div class="enter__grade grade--Text text--white">
                          <h5>Enter Grade:</h5>
                        </div>
                        <div class="enter__grade grade__wrapper">
                          <form action="" method="post">
                            <div class="Set--Grade">
                              <input class="default_cursor" type="number" name="setGrade" id="" readonly>
                            </div>

                          </form>
                        </div>
                        <div class="cta--wraper">
                          <div class="btn__grade save--grade">
                            <h5>SAVE</h5>
                          </div>

                        </div>
                      </div>


                    </div>
                  </div>

                </div>

                <div class="student-status__wrapper course--grade">
                  <div class="student--upper__inner">
                    <div class="course__wrap">
                      <div class="course-info course-text">
                        <h4>Course:</h4>
                      </div>
                      <div class="course-info course-name">
                        <div class="inner_course">
                          <p>Student Course</p>
                        </div>
                      </div>
                      <div class="course-info course-grade__text">
                        <h4>Grade:</h4>
                      </div>
                      <div class="course-info course-grade">
                        <form action="index.php" method="post">
                          <div class="input-grade">
                            <input class="" type="number" name="grade" id="" value="" readonly>
                          </div>
                        </form>

                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 list--student">
          <div class="list-student--wrapper primary--bg">
            <div class="list-student__inner">

              <div class="list-course--wrapper">
                <div class="list-course--heading">

                  <form class="drop-down--courses" action="" method="post">
                    <div class="courses__text">

                      <h5>Course</h5>
                    </div>
                    <div class="list-courses__arrow">
                      <i class="ti-angle-down"></i>
                    </div>

                    <div class="drop-down--container scroll">
                      <!-- List of Courese Loop -->

                      <?php if (isset($_SESSION['acad'])) : ?>
                        <?php foreach ($course_list as $row) : ?>
                          <div class="drop-down__courses courses" value="<?php echo $row['course_id'] ?>" courseCode="<?php echo $row['course_code'] ?>">
                            <h3><?php echo $row['course_desc'] ?></h3>
                          </div>
                        <?php endforeach ?>
                      <?php endif ?>


                    </div>
                  </form>

                </div>
              </div>

              <div class="list--student__content">
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
                </div>

              </div>
              <div class="search-student--wrapper">
                <div class="search--inner">
                  <form action="" method="post">
                    <input type="text" name="student-name" placeholder="Search Student Name" id="">
                  </form>
                </div>

              </div>
            </div>


          </div>
        </div>
      </div>
    </div>
    </div>
  </section>


  <script>
    jQuery(document).ready(function() {

      // Click Selected Students
      $(".drop-down__courses").on("click", function() {
        $(this).closest(".list-student__inner").find(".drop-down--container.active").removeClass("active")

      })

      function Click_Student() {
        ///////////////////////////////////////////
        ////////////////  Click Selected Students

        $(".student-content__inner .list-student__wrap").on("click", function() {
          $(".student--info.student-name h5").removeClass("active")
          $(".student--info.student-position h5").removeClass("active")
          $(".list-student__wrap").removeClass("active")
          $(".entry--info").removeClass("active")


          $(this).find(".entry--info").addClass("active")
          $(this).addClass("active")
          $(this).find(".student--info.student-name h5").addClass("active")
          $(this).find(".student--info.student-position h5").addClass("active")


          //Get Student ID Value From Database to HTML
          var StudentID = $(this).find(".student-name--wrapper").attr("studentval")
          //Get Enroll ID From Database to HTML
          var enrollID = $(this).find(".student-name--wrapper").attr("enrollid")
          //remove readonly on a grade field
          $(".Set--Grade input").removeAttr("readonly")
          //set back the default text cursor on a field
          $(".Set--Grade input").addClass("enterCursor")

          $(this).closest(".list--student__content")

          //Lock Grades when the entry is 4 from database
          var entryval = $(this).find(".student-name--wrapper").attr("entry")
          if (entryval == 4 || entryval == 3) {
            $(".Set--Grade input").removeClass("enterCursor")
            $(".Set--Grade input").addClass("default_cursor")
            $(".Set--Grade input").attr("readonly", true)
          }

          $.ajax({
            url: "../ajax/selected-student.php",
            type: "POST",
            dataType: "html",
            data: {
              'studentval': StudentID,
              'enrollID': enrollID
            },

            success: function(data) {



              var studentInf = $(".student-wrapper.studentinfo")
              $('.inner_course').html(data)
              var ViewGrades = $(".input-grade")
              if (studentInf.hasClass("studentinfo")) {
                $(".student-wrapper.studentinfo").html(data)
              }

              if (ViewGrades.hasClass("input-grade")) {
                ViewGrades.html(data)
              }


              var gradeval = $(".input-grade input").val()

              if (gradeval < 75) {
                $(".input-grade input").addClass("color")
                $(".student-status__wrapper").addClass("color")
                $(".course-info.course-name").addClass("color")

              } else {
                $(".input-grade input").removeClass("color")
                $(".student-status__wrapper").removeClass("color")
                $(".course-info.course-name").removeClass("color")
              }

            }


          })

        })
        ///////////////////////////
      }

      /////////////////
      //// Click List of Course to see the list of students
      $(".drop-down__courses").on("click", function() {
        var Value = $(this).attr("value")

        var show = $(this).find("h3").html()

        //replace dropdown value
        $(".drop-down--courses h5").text(show)

        //get the courses ID 
        $.ajax({
          url: "../ajax/list-student.php",
          type: "POST",
          dataType: "html",
          data: {
            'courseval': Value
          },
          beforeSend: function() {
            $(".loading-wrap").show()
            $(".student-content__inner").hide()
          },
          success: function(data) {
            $(".loading-wrap").hide()
            $(".list--student__content").html(data);


            //// To Click Selected Student
            Click_Student()
            /////////////////
            //////For Search Bar Function
            $(".search--inner input").on("keyup", function() {

              studName = $(this).val()

              $.ajax({
                url: "../ajax/list-student.php",
                dataType: "html",
                type: "POST",
                data: {
                  "searchName": studName,
                  'courseval': Value
                },
                success: function(data) {

                  $(".list--student__content").html(data);
                  $("search-student--wrapper").html(data)

                  //// To Click Selected Student
                  Click_Student()
                }

              })

            })
          }
        })
      })

      //Show DropDown Menu by Clicking the dropdown Arrow
      var drop_menu = $(".list-courses__arrow");
      drop_menu.on("click", function() {

        $(this).closest(".list-course--heading form").find(".drop-down--container").toggleClass("active")


      });

      //////// Set grade field color to red of its below 75
      $(".Set--Grade input").on("keyup", function() {
        var gradeval = $(this).val()
        if (gradeval < 75) {
          $(this).addClass("color")
        } else {
          $(this).removeClass("color")
        }


      })
      //////////////// View Grades Click SAVE button

      $(".btn__grade.save--grade").on("click", function(e) {

        //////Condition for not firing save button if the value of entering grade is null
        var gradeVal = $(".Set--Grade input").val()
        var entry = $(this).closest(".status-grade__inner").find(".input-grade input").attr("entry")
        var entrylock = $(this).closest(".status-grade__inner").find(".input-grade input").attr("entry")
       


        // alert(entry)
        if (gradeVal == '') {
          alert("Please Enter grades value :)")
        } else {


          if (entry <= 3) {


            entry = ++entry
            // alert("current entry: " + entry)
            //Send grades to DataBase
            //=======

            if (entry <= 3) {
              if (entry <= 3) {

              } else {

                entry = 0

                // alert("entry reset to " + entry)
              }

              var session_entry = entry
              $.ajax({
                url: "../ajax/Grades.php",
                type: "POST",
                dataType: "html",
                data: {
                  "gradeval": gradeVal,
                  "entry_val": entry

                },
                success: function(data) {

                  $(".input-grade").html(data)
                  $(".Set--Grade input").val("")
                  alert('Successfull Updated')

                  var entry_val = $(".input-grade input").attr("entry")

                  if (entry_val == 1) {
                    $(".entry--info.active").removeClass("entry__green")
                    $(".entry--info.active").removeClass("entry__yellow")
                    $(".entry--info.active").removeClass("entry__red")
                    var active = $(".entry--info.active").addClass("entry__green")

                  }
                  if (entry_val == 2) {
                    $(".entry--info.active").removeClass("entry__green")
                    $(".entry--info.active").removeClass("entry__yellow")
                    $(".entry--info.active").removeClass("entry__red")
                    var active = $(".entry--info.active").addClass("entry__yellow")

                  }
                  if (entry_val == 3) {
                    $(".entry--info.active").removeClass("entry__green")
                    $(".entry--info.active").removeClass("entry__yellow")
                    $(".entry--info.active").removeClass("entry__red")
                    var active = $(".entry--info.active").addClass("entry__red")

                  }




                  var gradeval = $(".input-grade input").val()

                  if (gradeval < 75) {
                    $(".input-grade input").addClass("color")
                    $(".student-status__wrapper").addClass("color")
                    $(".course-info.course-name").addClass("color")
                  } else {
                    $(".input-grade input").removeClass("color")
                    $(".student-status__wrapper").removeClass("color")
                    $(".course-info.course-name").removeClass("color")
                  }


                }


              })
            } else {
              alert("You cannot enter the grade")
              $(this).closest(".status-grade__inner").find(".Set--Grade input").removeClass("enterCursor")
              $(this).closest(".status-grade__inner").find(".Set--Grade input").attr("readonly", true)
              $(this).closest(".status-grade__inner").find(".Set--Grade input").val("")


            }


          } else {
            e.preventDefault()

            $(".Set--Grade input").attr("readonly", true)
            $(".Set--Grade input").val("");

            //set back the default text cursor on a field
            $(".Set--Grade input").removeClass("enterCursor")
            $(".Set--Grade input").addClass("default_cursor")

            if (entrylock == 4) {
              $(".entry--info.active").removeClass("entry__green")
              $(".entry--info.active").removeClass("entry__yellow")
              $(".entry--info.active").removeClass("entry__red")
              var active = $(".entry--info.active").addClass("entry__red")
              //Get The value of Courses For loading all the list of student
              var Value = $(this).closest(".container-fluid").find(".drop-down__courses").attr("value")
              $.ajax({
                url: "../ajax/list-student.php",
                type: "POST",
                dataType: "html",
                data: {
                  'courseval': Value
                },
                success: function(data) {
                  $(".list--student__content").html(data);
                }
              })
              $(this).closest(".container-fluid").find(".list--student__content").load(location.href + " .list--student__content>*", "")
            }
          }







        }



      })




      //Prevent direct Url for Dashboard Side bar
      $("a.dashboad_sidebar").on("click", function(e) {
        e.preventDefault()
        location.reload()


      })

      //Prevent Entring Print Record Instructor
      $(".print_record a").on("click", function(e) {
        var course_val = $(this).closest(".section.instructor-dashboard").find(".courses__text h5").text()


        if (course_val == "Course") {
          e.preventDefault()
          alert("Select Course first")
        }


      })

      //ANIMATION
      gsap.from(".instructor-nav__wrapper", {
        duration: 0.5,
        delay: 0.2,
        x: -100,
        opacity: 0,
      })

      gsap.from(".list-student--wrapper", {
        duration: 0.5,
        delay: 0.2,
        x: 100,
        opacity: 0,
      })
      gsap.from(".status--wrapper", {
        duration: 0.5,
        delay: 0.5,
        y: -50,
        opacity: 0,
      })
      gsap.from(".status-grade--ui", {
        duration: 0.7,
        delay: 1,
        y: 100,
        opacity: 0,
      })
      gsap.from(".welcome-dashboard ", {
        duration: 1,
        delay: 1.4,

        opacity: 0,
      })
    });
  </script>
</body>

</html>