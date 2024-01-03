<?php

require_once('../database/db_connect2.php');

$id = $_REQUEST['id'];

$query = "DELETE FROM tbl_archive WHERE id='$id';";

// Use pg_query for simple queries
$result = pg_query($dbconn, $query);

if ($result) {
    echo "<script>window.location.href='..?page=trash&delete=1';</script>"; 
} else {
    echo "<script>window.location.href='..?page=trash&error=1';</script>";
}

?>
