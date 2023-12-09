<?php
session_start();
if (isset($_SESSION['UserID'])) {
    $userID = $_SESSION['UserID'];
} else {
    header("location: ../Login/Login.php");
    exit();
}
?>