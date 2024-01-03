<?php
// Start the session at the beginning of the script
session_start();

if (isset($_POST['a_login'])) {
    // Include the database connection file
    require_once('../database/db_connect2.php');

    // Sanitize and get the posted information
    $username = pg_escape_string($dbconn, $_POST['username']);
    $password = md5(pg_escape_string($dbconn, $_POST['Password']));

    // PostgreSQL query
    $check_login = pg_query($dbconn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");

    // Check the row if the data is existing
    if (pg_num_rows($check_login) >= 1) {
        // Fetch the data
        $getData = pg_fetch_assoc($check_login);

        // Assign session variables
        $_SESSION['id'] = $getData['id'];
        $_SESSION['firstname'] = $getData['firstname'];
        $_SESSION['lastname'] = $getData['lastname'];
        $_SESSION['email'] = $getData['email'];
        $_SESSION['contactno'] = $getData['contactno'];
        $_SESSION['reg_datetime'] = $getData['reg_datetime'];
        $_SESSION['updation_date'] = $getData['updation_date'];
        $_SESSION['date_of_birth'] = $getData['date_of_birth'];
        $_SESSION['gender'] = $getData['gender'];
        $_SESSION['address'] = $getData['address'];
        $_SESSION['country'] = $getData['country'];
        $_SESSION['city'] = $getData['city'];


        // After successful login for admin
        $_SESSION['user_role'] = 'admin';

        // Redirect to the admin page
        header("location:../admin/");
        exit();
    } else {
        // Redirect with an error parameter
        header("location:../?page=admin&error=1");
        exit();
    }
}
?>
