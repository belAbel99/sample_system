<?php

require_once('../database/db_connect2.php');

$id = $_REQUEST['id'];

// Start a PostgreSQL transaction
pg_query($dbconn, "BEGIN");

// Insert data into tbl_users
$restore_query = "INSERT INTO tbl_users (id, firstname, lastname, email, password, reg_datetime, gender, contactno, dob, address, updation_date)
          SELECT id, firstname, lastname, email, password, reg_datetime, gender, contactno, dob, address, updation_date
          FROM tbl_archive WHERE id='$id';";

$restore_result = pg_query($dbconn, $restore_query);

// Check if the restore into tbl_users was successful
if ($restore_result) {
    // Delete data from tbl_archive
    $delete_archive_query = "DELETE FROM tbl_archive WHERE id='$id';";
    $delete_archive_result = pg_query($dbconn, $delete_archive_query);

    // Commit the transaction if delete from tbl_archive is successful
    if ($delete_archive_result) {
        pg_query($dbconn, "COMMIT");
        echo "<script>window.location.href='..?page=trash&success=1';</script>";
    } else {
        // Rollback the transaction if delete from tbl_archive fails
        $error_message = pg_last_error($dbconn);
        pg_query($dbconn, "ROLLBACK");
        echo "<script>alert('Error deleting from tbl_archive: $error_message'); window.location.href='..?page=trash&error=1';</script>";
    }
} else {
    // Rollback the transaction if restore into tbl_users fails
    $error_message = pg_last_error($dbconn);
    pg_query($dbconn, "ROLLBACK");
    echo "<script>alert('Error restoring into tbl_users: $error_message'); window.location.href='..?page=trash&error=1';</script>";
}

?>
