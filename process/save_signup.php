<?php
if (isset($_POST['signup'])) {
    date_default_timezone_set('Etc/GMT-8');
    require_once('../database/db_connect2.php');

    $Firstname = $_POST['Firstname'];
    $Lastname = $_POST['Lastname'];
    $Email = $_POST['Email'];
    $Password = password_hash($_POST['Password'], PASSWORD_BCRYPT); // Hash the password

    // Additional fields
    $Gender = $_POST['Gender'];
    $DoB = $_POST['DoB'];
    $ContactNo = $_POST['ContactNo'];
    $Address = $_POST['Address'];

    // Use parameterized queries to prevent SQL injection
    $check_email = pg_prepare($dbconn, "check_email", "SELECT * FROM tbl_users WHERE Email = $1");
    $result = pg_execute($dbconn, "check_email", array($Email));

    if (pg_num_rows($result) >= 1) {
        echo "<script>window.location.href='..?page=signup&exist=1';</script>";
    } else {
        // Use parameterized queries to prevent SQL injection
        $insert_query = "INSERT INTO tbl_users (Firstname, Lastname, Email, Password, Reg_DateTime, Gender, DoB, ContactNo, Address) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9)";
        $query = pg_prepare($dbconn, "insert_query", $insert_query);
        $result = pg_execute($dbconn, "insert_query", array($Firstname, $Lastname, $Email, $Password, date("Y-m-d h:i:sa"), $Gender, $DoB, $ContactNo, $Address));

        if ($result) {
            echo "<script>window.location.href='..?page=login&success=1';</script>";
        } else {
            echo "<script>window.location.href='..?page=signup&error=1';</script>";
        }
    }
}
?>
