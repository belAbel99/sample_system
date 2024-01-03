<center><br>
  <div class="login text-center">

    <form class="form-signin text-left" action="process/check_login.php" method="POST">
      <center>
        <img class="mb-4" src="assets/images/avatarlogin.png" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      </center>
      <?php
      if (isset($_GET['success'])) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            You are successfully registered! Now you can sign in.
                    <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                        <span aria-hidden='true'>&times</span>
                    </button>
            </div>";
      } elseif (isset($_GET['error'])) {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    Username or password is Incorrect!
                    <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                        <span aria-hidden='true'>&times</span>
                    </button>
            </div>";
      }
      ?>

      <label for="inputEmail" class="sr-only">Email Address</label>
      <input type="email" class="form-control" placeholder="Email address" name="Email" required>

      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="myInput" class="form-control" placeholder="Password" name="Password" required>

      <label>
        <input type="checkbox" onclick="myFunction()"> Show Password <br><br>
      </label>

      <script>
        function myFunction() {
          var x = document.getElementById("myInput");
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
        }
      </script>



      <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Sign in</button>
      <br>
      <p>Don't have an account? <a href=".?page=signup" style="color:white"><b>Sign Up</b></a></p>
      <p>Login as <a href=".?page=admin" style="color:white"><b>Admin</b></a></p>

    </form>

  </div><br>
</center>