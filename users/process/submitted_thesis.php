<?php
// Include the database connection file
require_once('../database/db_connect2.php');

// Check if the user is logged in
//session_start();
if (!isset($_SESSION['id'])) {
    header("location: ../?page=login");
    exit();
}

// Fetch submitted theses for the current user
$user_id = $_SESSION['id'];
$select_query = pg_prepare(
    $dbconn,
    "select_query",
    "SELECT profile_name, group_name, file_path, description FROM uploaded_files WHERE user_id = $1"
);
$result = pg_execute($dbconn, "select_query", array($user_id));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include your head content here -->
    <title>Submitted Theses</title>
</head>

<body>
    <center>
        <br>
        <div class="container">
            <h1>Submitted Theses</h1>
        </div>
        <div class="profile">
<!-- Display submitted theses -->
<table class="table">
    <thead>
        <tr>
            <th>Thesis Name</th>
            <th>Group Name</th>
            <th>Description</th>
            <th>File</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = pg_fetch_assoc($result)) : ?>
            <tr>
                <td><?php echo $row['profile_name']; ?></td>
                <td><?php echo $row['group_name']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td>
                <a href="download.php?file=<?php echo urlencode($row['file_path']); ?>" download="<?php echo $row['profile_name'] . '_' . $row['group_name'] . '_Thesis'; ?>">Download</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
        </div>
    </center>
</body>

</html>
?>
