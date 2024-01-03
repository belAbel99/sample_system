<?php
session_start();
date_default_timezone_set('Etc/GMT-8');
require_once('../database/db_connect2.php');

$Id = $_POST['id'];
$Email = $_POST['Email'];
$ProfileName = $_POST['ProfileName'];
$GroupName = $_POST['GroupName'];
$FilePath = $_POST['FilePath'];
$Description = $_POST['Description'];
$FormA = $_POST['FormA'];
$FormB = $_POST['FormB'];
$FormC = $_POST['FormC'];
$FormD = $_POST['FormD'];

// Use prepared statements to prevent SQL injection
$updateQuery = "UPDATE uploaded_files SET profile_name=$1, group_name=$2, file_path=$3, description=$4, form_a=$5, form_b=$6, form_c=$7, form_d=$8 WHERE user_id=$9";
$updatedata = pg_prepare($dbconn, "update_query", $updateQuery);
$result = pg_execute($dbconn, "update_query", array($ProfileName, $GroupName, $FilePath, $Description, $FormA, $FormB, $FormC, $FormD, $Id));

if (!$result) {
    $error = pg_last_error($dbconn);
    echo "Update failed: $error";
} else {
    // Redirect to the user profile page with success message
    header("Location: ../?page=profile&id=$Id&success_update=1");
}

pg_close($dbconn);
?>
