<?php
//session_start();

require_once('../database/db_connect2.php'); // Assuming your new database connection file is named db_connect.php

if (!isset($_SESSION['id'])) {
    header("location: ../?page=login");
    exit();
}

if (isset($_POST['update'])) {
    $new_firstname = $_POST['Firstname'];
    $new_lastname = $_POST['Lastname'];
    $new_gender = $_POST['Gender'];
    $new_dob = $_POST['DoB'];
    $new_contactno = $_POST['ContactNo'];
    $new_address = $_POST['Address'];

    $update_query = pg_prepare(
        $dbconn,
        "update_query",
        "UPDATE tbl_users SET firstname = $1, lastname = $2, gender = $3, dob = $4, contactno = $5, address = $6, updation_date = $7 WHERE id = $8"
    );

    $update_success = pg_execute(
        $dbconn,
        "update_query",
        array($new_firstname, $new_lastname, $new_gender, $new_dob, $new_contactno, $new_address, date("Y-m-d h:i:sa"), $_SESSION['id'])
    );

    if ($update_success) {
        $_SESSION['Firstname'] = $new_firstname;
        $_SESSION['Lastname'] = $new_lastname;
        $_SESSION['Gender'] = $new_gender;
        $_SESSION['DoB'] = $new_dob;
        $_SESSION['ContactNo'] = $new_contactno;
        $_SESSION['Address'] = $new_address;
        $_SESSION['Updation_Date'] = date("Y-m-d h:i:sa");

        header("location: .?success=1");
        exit();
    } else {
        header("location: .?error=1");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include your head content here -->
</head>

<body>
    <center>
        <br>
        <div class="container1">
            <h1>MY PROFILE</h1>
        </div>

        <div class="profile">
            <br>
            <form action=".?folder=process/&page=profile_update" method="POST">
                <h2><b>
                        <?php echo htmlspecialchars($_SESSION['Firstname']) ?>
                        <?php echo htmlspecialchars($_SESSION['Lastname']) ?>
                    </b></h2>

                <div class="container row-sm text-left">
                    <?php
                    if (isset($_GET['success'])) {
                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                    Save changes successfully!
                                    <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>";
                    } elseif (isset($_GET['error'])) {
                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    Error in saving data!
                                    <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>";
                    }
                    ?>

                    <br><b>Registered Date: </b>
                    <?php echo htmlspecialchars($_SESSION['Reg_DateTime']) ?><br>
                    <b>Last Update at: </b>
                    <?php echo htmlspecialchars($_SESSION['Updation_Date']) ?>
                    <hr>

                    <label><b>Firstname:</b></label>
                    <input type="text" class="form-control"
                        value="<?php echo htmlspecialchars($_SESSION['Firstname']) ?>" name="Firstname" required>
                    <label><b>Lastname:</b></label>
                    <input type="text" class="form-control"
                        value="<?php echo htmlspecialchars($_SESSION['Lastname']) ?>" name="Lastname" required>

                    <br><label><b>Gender:</b>
                        <?php echo htmlspecialchars($_SESSION['Gender']) ?> 
                    </label>
                    <input type="radio" id="male" name="Gender" value="Male" <?php if ($_SESSION['Gender'] === 'Male')
                        echo 'checked' ?> required>
                        <label for="male">Male </label>
                        <input type="radio" id="female" name="Gender" value="Female" <?php if ($_SESSION['Gender'] === 'Female')
                        echo 'checked' ?> required>
                        <label for="female">Female</label><br>

                        <label><b>Date of Birth:</b></label><br>
                        <input type="date" class="form-control" name="DoB"
                            value="<?php echo htmlspecialchars($_SESSION['DoB']) ?>" required>

                    <label for="Email" class="custom-label"><b>Email Address:</b></label>
                    <input type="email" class="form-control" value="<?php echo htmlspecialchars($_SESSION['Email']) ?>"
                        name="Email" required readonly>

                    <label for="ContactNo" class="custom-label"><b>Contact Number:</b></label>
                    <input type="tel" class="form-control" name="ContactNo"
                        value="<?php echo htmlspecialchars($_SESSION['ContactNo']) ?>" pattern="[0-9]{11}" required>

                    <label><b>Your Address:</b></label>
                    <textarea class="form-control" name="Address" rows="3"
                        required><?php echo htmlspecialchars($_SESSION['Address']) ?></textarea><br>

                    <button class="btn btn-lg btn-info btn-block" name="update" type="submit"><b>Save
                            Changes</b></button>
                </div>
            </form>
        </div>
    </center>
</body>

</html>