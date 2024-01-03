<center><br>
<div class="admin text-center">

<form class="form-signin text-left" action="process/admin_login.php" method="POST">
<center>
  <img class="mb-4" src="assets/images/admin_icon.png" alt="" width="72" height="72">
  <h1 class="h3 mb-3 font-weight-normal">ADMINISTRATOR</h1>
  </center>
  <?php
        if(isset($_GET['success'])){
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            You are successfully registered! Now you can sign in.
                    <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                        <span aria-hidden='true'>&times</span>
                    </button>
            </div>";
        }

        elseif(isset($_GET['error'])){
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    Username or password is Incorrect!
                    <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                        <span aria-hidden='true'>&times</span>
                    </button>
            </div>";
        }
    ?>

  <input type="text" class="form-control" placeholder="admin" name="username" required>

  <input type="password" id="myInput" class="form-control" placeholder="password" name="Password" required>


<button class="btn btn-lg btn-primary btn-block" name="a_login" type="submit">LOGIN</button>
  <br>
  <p>Back to <a href=".?page=login"style="color:white"><b>User Login</b></a></p>
  
</form>

</div><br>
</center>
