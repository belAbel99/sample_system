<!-- upload_form.php -->
<?php
//session_start();

require_once('../database/db_connect2.php');

if (!isset($_SESSION['id'])) {
    header("location: ../?page=login");
    exit();
}

if (isset($_POST['upload'])) {
    $profile_name = $_POST['name'];
    $group_name = $_POST['groupName'];
    $description = $_POST['description'];

    $file_name = $_FILES['groupFile']['name'];
    $file_tmp_name = $_FILES['groupFile']['tmp_name'];
    $file_size = $_FILES['groupFile']['size'];

    // Define the directory where the file will be stored
    $target_dir = "C:" . DIRECTORY_SEPARATOR . "xampp" . DIRECTORY_SEPARATOR . "htdocs" . DIRECTORY_SEPARATOR . "sample_system" . DIRECTORY_SEPARATOR . "users" . DIRECTORY_SEPARATOR . "process" . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;
    $target_file = $target_dir . basename($file_name);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size (e.g., 5 MB)
    if ($file_size > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($fileType != "txt" && $fileType != "pdf" && $fileType != "doc" && $fileType != "docx") {
        echo "Sorry, only PDF, DOC, DOCX, & TXT files are allowed.";
        $uploadOk = 0;
    }

    // ... [Previous code]

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($file_tmp_name, $target_file)) {
            // Checkboxes for submitted forms
            $form_a = !empty($_POST['form_a']);
            $form_b = !empty($_POST['form_b']);
            $form_c = !empty($_POST['form_c']);
            $form_d = !empty($_POST['form_d']);

            $insert_query = pg_prepare(
                $dbconn,
                "insert_query",
                "INSERT INTO uploaded_files (user_id, profile_name, group_name, file_path, description, form_a, form_b, form_c, form_d) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9)"
            );
            
            $insert_success = pg_execute(
                $dbconn,
                "insert_query",
                array(
                    $_SESSION['id'],
                    $profile_name,
                    $group_name,
                    $target_file,
                    $description,
                    $form_a ? 't' : 'f', // Convert boolean to 't' or 'f'
                    $form_b ? 't' : 'f',
                    $form_c ? 't' : 'f',
                    $form_d ? 't' : 'f'
                )
            );
            
            if ($insert_success) {
                header("location: .?success=1");
                exit();
            } else {
                $error_message = pg_last_error($dbconn);
                echo "Database error: " . $error_message;
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include your head content here -->
    <!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Include Bootstrap JS after jQuery -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <center>
        <br>
        <div class="container">
            <h1>UPLOAD FORM</h1>
        </div>
        <div class="profile">
            <form action=".?folder=process/&page=upload_form" method="POST" enctype="multipart/form-data">
                <h2><b>Student Names</b></h2>

                <!-- Display alerts -->
                <?php
                if (isset($_GET['success'])) {
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        Upload successful!
                            <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                } elseif (isset($_GET['error'])) {
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Error in upload!
                            <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                }
                ?>

                <br>
                <div class="form-group">
                    <label for="name">Thesis Title:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="groupName">Group Names:</label>
                    <input type="text" id="groupName" name="groupName" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="groupFile">Upload File:</label>
                    <input type="file" id="groupFile" name="groupFile" class="form-control-file" required>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" class="form-control" rows="4"></textarea>
                </div>

                <!-- Checkboxes for submitted forms -->
                <div class="form-group">
                    <label><input type="checkbox" name="form_a" value="1"> Form A</label>
                    <label><input type="checkbox" name="form_b" value="1"> Form B</label>
                    <label><input type="checkbox" name="form_c" value="1"> Form C</label>
                    <label><input type="checkbox" name="form_d" value="1"> Form D</label>
                </div>

                <button class="btn btn-lg btn-info btn-block" name="upload" type="submit"><b>Upload</b></button>
            </form>
        </div>
    </center>
</body>

</html>