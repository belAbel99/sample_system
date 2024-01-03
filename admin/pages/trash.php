<?php
require("database/db_connect2.php");

// Use pg_query instead of mysqli_query
$showlist = pg_query($dbconn, "SELECT a.id, a.firstname, a.lastname, a.email, a.gender, a.contactno, a.dob, a.address, a.reg_datetime, a.updation_date,
                                        f.profile_name, f.group_name, f.file_path, f.description, f.form_a, f.form_b, f.form_c, f.form_d
                                 FROM tbl_archive a
                                 LEFT JOIN uploaded_files f ON a.id = f.user_id");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Deleted Data</title>
    <!-- Include your head content here -->
    <script src="assets/js/search.js"></script>
    <script>
        $(document).ready(function () {
            $("#myInput").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</head>

<body>
    <center>
        <br>
        <div class="trash">
            <br>
            <div class="container">
                <h2>Deleted Data</h2>
                <br>

                <?php
                if (isset($_GET['success'])) {
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        Data has been restored successfully!
                        <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                            <span aria-hidden='true'>&times</span>
                        </button>
                    </div>";
                } elseif (isset($_GET['error'])) {
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Error!
                        <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                            <span aria-hidden='true'>&times</span>
                        </button>
                    </div>";
                } elseif (isset($_GET['delete'])) {
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        Data has been deleted successfully!
                        <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                            <span aria-hidden='true'>&times</span>
                        </button>
                    </div>";
                }
                ?>

                <div class="table-responsive">
                    <input id="myInput" class="form-control" type="text" placeholder="Search..">
                    <br>
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID_No.</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Phone_No.</th>
                                <th>Birthdate</th>
                                <th>Address</th>
                                <th>Reg_Date</th>
                                <th>Updation_Date</th>
                                <th>Thesis_Name</th>
                                <th>Group_Names</th>
                                <th>File_Path</th>
                                <th>Description</th>
                                <th>Form_A</th>
                                <th>Form_B</th>
                                <th>Form_C</th>
                                <th>Form_D</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody id="myTable" style="color:white;">

                            <?php
                            while ($showData = pg_fetch_assoc($showlist)) {
                            ?>
                                <tr>
                                    <td><?php echo $showData['id']; ?></td>
                                    <td><?php echo $showData['firstname']; ?></td>
                                    <td><?php echo $showData['lastname']; ?></td>
                                    <td><?php echo $showData['email']; ?></td>
                                    <td><?php echo $showData['gender']; ?></td>
                                    <td><?php echo $showData['contactno']; ?></td>
                                    <td><?php echo $showData['dob']; ?></td>
                                    <td><?php echo $showData['address']; ?></td>
                                    <td><?php echo $showData['reg_datetime']; ?></td>
                                    <td><?php echo $showData['updation_date']; ?></td>
                                    <td><?php echo $showData['profile_name']; ?></td>
                                    <td><?php echo $showData['group_name']; ?></td>
                                    <td><?php echo $showData['file_path']; ?></td>
                                    <td><?php echo $showData['description']; ?></td>
                                    <td><?php echo ($showData['form_a'] ? 'True' : 'False'); ?></td>
                                    <td><?php echo ($showData['form_b'] ? 'True' : 'False'); ?></td>
                                    <td><?php echo ($showData['form_c'] ? 'True' : 'False'); ?></td>
                                    <td><?php echo ($showData['form_d'] ? 'True' : 'False'); ?></td>
                                    <td>
                                        <a style="color:yellow;" href="process/undo.php?id=<?php echo $showData['id'] ?>"><b>Restore</b></a>
                                        <a style="color:red;" href="process/delete.php?id=<?php echo $showData['id'] ?>"><b>Delete_Permanently</b></a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>

                    </table>
                </div>
            </div>

            <br>
        </div>
        <br>
    </center>
</body>

</html>

<?php
pg_close($dbconn);
?>
