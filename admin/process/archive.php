<?php

require_once('../database/db_connect2.php');

$id = $_REQUEST['id'];

// Check for references in uploaded_files
$check_query = "SELECT COUNT(*) FROM uploaded_files WHERE user_id='$id'";
$references = pg_fetch_result(pg_query($dbconn, $check_query), 0, 0);

// Start a PostgreSQL transaction
pg_query($dbconn, "BEGIN");

if ($references > 0) {
    // Delete related records in uploaded_files
    $delete_uploaded_files_query = "DELETE FROM uploaded_files WHERE user_id='$id'";
    $delete_uploaded_files_result = pg_query($dbconn, $delete_uploaded_files_query);

    // Check if the delete from uploaded_files was successful
    if (!$delete_uploaded_files_result) {
        // Rollback the transaction if there's an error
        $error_message = pg_last_error($dbconn);
        pg_query($dbconn, "ROLLBACK");
        echo "<script>alert('Error deleting from uploaded_files: $error_message'); window.location.href='..?page=home&error=1';</script>";
        exit();
    }
}

// Insert data into tbl_archive
$insert_query = "INSERT INTO tbl_archive (id, firstname, lastname, email, password, reg_datetime, gender, contactno, dob, address, updation_date)
          SELECT id, firstname, lastname, email, password, reg_datetime, gender, contactno, dob, address, updation_date
          FROM tbl_users WHERE id='$id';";

$insert_result = pg_query($dbconn, $insert_query);

// Check if the insert into tbl_archive was successful
if ($insert_result) {
    // Delete data from tbl_users
    $delete_users_query = "DELETE FROM tbl_users WHERE id='$id';";
    $delete_users_result = pg_query($dbconn, $delete_users_query);

    // Commit the transaction if delete from tbl_users is successful
    if ($delete_users_result) {
        pg_query($dbconn, "COMMIT");
        echo "<script>window.location.href='..?page=home&success=1';</script>";
    } else {
        // Rollback the transaction if delete from tbl_users fails
        $error_message = pg_last_error($dbconn);
        pg_query($dbconn, "ROLLBACK");
        echo "<script>alert('Error deleting from tbl_users: $error_message'); window.location.href='..?page=home&error=1';</script>";
    }
} else {
    // Rollback the transaction if insert into tbl_archive fails
    $error_message = pg_last_error($dbconn);
    pg_query($dbconn, "ROLLBACK");
    echo "<script>alert('Error inserting into tbl_archive: $error_message'); window.location.href='..?page=home&error=1';</script>";
}

?>
