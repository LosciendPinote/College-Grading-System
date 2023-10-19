<?php
session_start();
if (isset($_SESSION['admin-user'])) { //Admin Logout
    session_destroy();
    header("Location: http://gradingsystem.42web.io/admin");
}