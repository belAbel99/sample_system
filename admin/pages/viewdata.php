<?php
require("../database/db_connect2.php");

// Check if 'id' is set in the request
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];

    // Use parameter binding to prevent SQL injection
    $editdata = pg_prepare($dbconn, "editdata", "SELECT * FROM user_data_view WHERE id = $1");
    $result = pg_execute($dbconn, "editdata", array($id));

    while ($showData = pg_fetch_assoc($result)) {
        ?>        
        <div class="form-container">
        <style>
        .form-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        /* Add more styles as needed */
    </style>
         <form action="process/profile_update.php" method="POST">
            <h2><b>
                    <?php echo $showData['id'] ?>
                    <?php echo $showData['email'] ?>
                    <?php echo $showData['profile_name'] ?>
                </b></h2>

            <div class="container row-sm text-left">

                <?php
                if (isset($_GET['success'])) {
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            Save changes successfully!
            
                    <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                        <span aria-hidden='true'>&times</span>
                    </button>
            </div>";
                } elseif (isset($_GET['error'])) {
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Error in saving data!
                <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                    <span aria-hidden='true'>&times</span>
                </button>
            </div>";
                }
                ?>

                <br><b>Registered Date: </b>
                <?php echo $showData['reg_datetime'] ?><br>
                <b>Last Update at: </b>
                <?php echo $showData['updation_date'] ?>
                <hr>

                <label><b>ID:</b></label>
                <input type="text" class="form-control" value="<?php echo $showData['id'] ?>" name="id" required readonly>

                <label for="Email" class="custom-label"><b>Email Address:</b></label>
                <input type="email" class="form-control" value="<?php echo $showData['email'] ?>" name="Email" required readonly>

                <label><b>Thesis Name:</b></label>
                <input type="text" class="form-control" value="<?php echo $showData['profile_name'] ?>" name="ProfileName" required>

                <label><b>Group Name:</b></label>
                <input type="text" class="form-control" value="<?php echo $showData['group_name'] ?>" name="GroupName" required>

                <label><b>File Path:</b></label>
                <input type="text" class="form-control" value="<?php echo $showData['file_path'] ?>" name="FilePath" required readonly>

                <label><b>Description:</b></label>
                <input type="text" class="form-control" value="<?php echo $showData['description'] ?>" name="Description">

                <label><b>Form A:</b></label>
                <input type="text" class="form-control" value="<?php echo ($showData['form_a'] ? 'True' : 'False'); ?>" name="FormA" required readonly>

                <label><b>Form B:</b></label>
                <input type="text" class="form-control" value="<?php echo ($showData['form_b'] ? 'True' : 'False'); ?>" name="FormB" required readonly>

                <label><b>Form C:</b></label>
                <input type="text" class="form-control" value="<?php echo ($showData['form_c'] ? 'True' : 'False'); ?>" name="FormC" required readonly>

                <label><b>Form D:</b></label>
                <input type="text" class="form-control" value="<?php echo ($showData['form_d'] ? 'True' : 'False'); ?>" name="FormD" required readonly>

                <button class="btn btn-lg btn-info btn-block" name="update" type="submit"><b>Save Changes</b></button>
                <a class="btn btn-lg btn-secondary btn-block" href=".?page=home"><b>Back</b></a>
            </div>
         </form>
        </div>

    <?php
    }
    pg_close($dbconn);
}
?>
