<?php
require("database/db_connect2.php");

    // Use pg_query instead of odbc_exec
    $showlist = pg_query($dbconn, "SELECT * FROM home_page_view");

// Check if the query was successful
if ($showlist === false) {
  echo "Error executing query: " . pg_last_error($dbconn);
} else {
  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <title>User's Data</title>
    <!-- Include your head content here -->
  </head>

  <body>
    <center>
      <br>
      <div class="admin">
        <br>
        <div class="container">
          <h2>User's Data</h2>
          <br>
          <?php
          if (isset($_GET['success'])) {
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                Data has been moved to trash!
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
          } elseif (isset($_GET['success_update'])) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                Data updated successfully!
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
                  <th>Thesis_Name</th>
                  <th>Group_Names</th>
                  <th>File_Name</th>
                  <th>Description</th>
                  <th>Form_A</th>
                  <th>Form_B</th>
                  <th>Form_C</th>
                  <th>Form_D</th>
                  <th>Reg_Date</th>
                  <th>Updation_Date</th>
                  <th>Options</th>
                </tr>
              </thead>
              <tbody id="myTable" style="color:white;">
                <?php
                while ($showData = pg_fetch_assoc($showlist)) {
                  ?>
                  <tr>
                    <td>
                      <?php echo $showData['id']; ?>
                    </td>
                    <td>
                      <?php echo $showData['firstname']; ?>
                    </td>
                    <td>
                      <?php echo $showData['lastname']; ?>
                    </td>
                    <td>
                      <?php echo $showData['email']; ?>
                    </td>
                    <td>
                      <?php echo $showData['profile_name']; ?>
                    </td>
                    <td>
                      <?php echo $showData['group_name']; ?>
                    </td>
                    <td>
                      <?php echo $showData['file_path']; ?>
                    </td>
                    <td>
                      <?php echo $showData['description']; ?>
                    </td>
                    <td><?php echo $showData['form_a']; ?></td>
                    <td><?php echo $showData['form_b']; ?></td>
                    <td><?php echo $showData['form_c']; ?></td>
                    <td><?php echo $showData['form_d']; ?></td>
                    <td>
                      <?php echo $showData['reg_datetime']; ?>
                    </td>
                    <td>
                      <?php echo $showData['updation_date']; ?>
                    </td>
                    <td>
                      <a style="color:white;" href=".?page=viewdata&id=<?php echo $showData['id'] ?>"><b>Edit</b></a>
                      <a style="color:black;" href="process/archive.php?id=<?php echo $showData['id'] ?>"><b>Delete</b></a>
                      <a style="color:white;" href="#" onclick="changeColorWhite(this); return false;"><b>Approve</b></a>
                      <a style="color:white;" href="#" onclick="changeColorYellow(this); return false;"><b>Pending</b></a>
                      <a style="color:white;" href="#" onclick="changeColorRed(this); return false;"><b>Denied</b></a>
                    </td>
                  </tr>
                  <?php
                }
                ?>
                <script>
                  function changeColorWhite(link) {
                    // Get the parent row of the clicked link
                    var row = link.parentNode.parentNode;

                    // Change the color of all cells in the row to red
                    for (var i = 0; i < row.cells.length; i++) {
                      row.cells[i].style.color = "white";
                    }
                  }
                  function changeColorYellow(link) {
                    // Get the parent row of the clicked link
                    var row = link.parentNode.parentNode;

                    // Change the color of all cells in the row to red
                    for (var i = 0; i < row.cells.length; i++) {
                      row.cells[i].style.color = "yellow";
                    }
                  }function changeColorRed(link) {
                    // Get the parent row of the clicked link
                    var row = link.parentNode.parentNode;

                    // Change the color of all cells in the row to red
                    for (var i = 0; i < row.cells.length; i++) {
                      row.cells[i].style.color = "red";
                    }
                  }
                </script>
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
}

pg_close($dbconn);
?>