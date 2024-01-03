<?php

date_default_timezone_set('Etc/GMT-8');
require_once('../database/db_connect2.php');

$Email = $_POST['Email'];
$Firstname = $_POST['Firstname'];
$Lastname = $_POST['Lastname'];
$ContactNo = $_POST['ContactNo'];
$Updation_Date = date("Y-m-d h:i:sa");
$DoB = $_POST['DoB'];
$Gender = $_POST['Gender'];
$Address = $_POST['Address'];

// Use prepared statements to prevent SQL injection
$updatedata = pg_prepare($dbconn, "updatedata", "UPDATE tbl_users SET Firstname=$1, Lastname=$2, ContactNo=$3, Updation_Date=$4, DoB=$5, Gender=$6, Address=$7 WHERE Email=$8");
$result = pg_execute($dbconn, "updatedata", array($Firstname, $Lastname, $ContactNo, $Updation_Date, $DoB, $Gender, $Address, $Email));

if (!$result) {
    echo "<script>window.location.href='.?page=home&error=1';</script>";
} else {
    // Update and get data
    $check_email = pg_prepare($dbconn, "check_email", "SELECT * FROM tbl_users WHERE Email=$1");
    $result_check = pg_execute($dbconn, "check_email", array($Email));

    if (pg_num_rows($result_check) >= 1) {
        while ($getData = pg_fetch_assoc($result_check)) {
            $id = $_SESSION['id'] = $getData['id'];
            $Firstname = $_SESSION['Firstname'] = $getData['Firstname'];
            $Lastname = $_SESSION['Lastname'] = $getData['Lastname'];
            $Email = $_SESSION['Email'] = $getData['Email'];
            $ContactNo = $_SESSION['ContactNo'] = $getData['ContactNo'];
            $Reg_DateTime = $_SESSION['Reg_DateTime'] = $getData['Reg_DateTime'];
            $Updation_Date = $_SESSION['Updation_Date'] = $getData['Updation_Date'];
            $DoB = $_SESSION['DoB'] = $getData['DoB'];
            $Gender = $_SESSION['Gender'] = $getData['Gender'];
            $Address = $_SESSION['Address'] = $getData['Address'];

            echo "<script>window.location.href='.?page=home&success=1';</script>";
        }
    } else {
        echo "<script>window.location.href='.?page=home&error=1';</script>";
    }
}

?>
