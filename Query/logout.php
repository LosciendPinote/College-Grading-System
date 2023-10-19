<?php
session_start();

if (isset($_SESSION['user_id'])) { //Instructor Logout
    session_destroy();
    header("Location: http://localhost/new_gradingsystem/");
}
if (isset($_SESSION['userStudent'])) { //Student Logout
    session_destroy();
    header("Location: http://localhost/new_gradingsystem/");
}

