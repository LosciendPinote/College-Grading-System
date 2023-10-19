<script src="../app/jquery.min.js"></script>

<div class="instructor-nav__wrapper primary--bg">
  <div class="instructor-nav__inner">


    <nav class="navigation-instruct">
      <ul>
        <li><a class="dashboad_sidebar" href="../Instructor"> <span class="ti-dashboard"></span> Dashboard</a></li>
        <li class="print_record"><a href="print-record.php"> <span class="ti-printer"></span> Print Record</a></li>
        <li><a class="settings_sidebar" href="settings.php"> <span class="ti-settings"></span> Settings</a></li>
        <li><a href="../Query/logout.php"> <span class="ti-arrow-circle-right"></span> Logout</a></li>
      </ul>
    </nav>

    <div class="instructor-user--wrapper">
      <div class="instructor-user__inner">
        <div class="instructor__content instructor-icon">
          <!-- IMage ni Diri ah -->
        </div>
        <div class="instructor__content instructor--name">
          <h4> <?php echo $user['fname'] ?> <?php echo $user['mname'] ?> <?php echo $user['lname'] ?></h4>
        </div>
        <div class="instructor--position">
          <h4>Instructor</h4>
        </div>
      </div>
    </div>
  </div>
</div>