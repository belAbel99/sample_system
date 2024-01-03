<?php
session_start();

if (isset($_POST['login'])) {
    require_once('../database/db_connect2.php');

    $Email = $_POST['Email'];
    $Password = $_POST['Password'];

    $check_login = pg_prepare($dbconn, "check_login", "SELECT * FROM tbl_users WHERE email = $1");
    $result = pg_execute($dbconn, "check_login", array($Email));

    if (pg_num_rows($result) >= 1) {
        $getData = pg_fetch_assoc($result);

        if (password_verify($Password, $getData['password'])) {
            $_SESSION['id'] = $getData['id'];
            $_SESSION['Firstname'] = $getData['firstname'];
            $_SESSION['Lastname'] = $getData['lastname'];
            $_SESSION['Email'] = $getData['email'];
            $_SESSION['ContactNo'] = $getData['contactno'];
            $_SESSION['Reg_DateTime'] = $getData['reg_datetime'];
            $_SESSION['Updation_Date'] = $getData['updation_date'];
            $_SESSION['Date_of_Birth'] = $getData['dob'];
            $_SESSION['Gender'] = $getData['gender'];
            $_SESSION['Address'] = $getData['address'];

           // After successful login for regular user
            $_SESSION['user_role'] = 'regular_user';

            header("location:../users/");
            exit(); // Add exit() after header
        } else {
            echo "<script>window.location.href='../?page=login&error=1';</script>";
            die("Incorrect password"); // Add an error message
        }
    } else {
        echo "<script>window.location.href='../?page=login&error=1';</script>";
        die("User not found"); // Add an error message
    }
}
?>
