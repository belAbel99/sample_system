<center>
    <br>
    <div class="signup">
        <form class="form-signin text-left" action="process/save_signup.php" method="POST">
            <center>
                <img class="mb-4" src="assets/images/avatarsignup.png" alt="" width="72" height="72">
                <h1 class="h3 mb-3 font-weight-normal">SIGN UP</h1>
            </center>
            <?php
            if (isset($_GET['success'])) {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        Registration successful! Now you can Login
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
            } elseif (isset($_GET['exist'])) {
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Email already exists!
                        <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
            }
            ?>
            <div class="row text-left">
                <div class="col">
                    <label>Firstname</label>
                    <input type="text" class="form-control" placeholder="Enter Firstname" name="Firstname" required>
                </div>
                <div class="col">
                    <label>Lastname</label>
                    <input type="text" class="form-control" placeholder="Enter Lastname" name="Lastname" required>
                </div>
            </div>

            <label>Email</label>
            <input type="email" class="form-control" placeholder="Enter Email address" name="Email" required>

            <label>Password</label>
            <input type="password" class="form-control" placeholder="Enter Password" name="Password" required>

            <label>Confirm Password</label>
            <input type="password" class="form-control" placeholder="Enter Password Again" required>

            <label>Gender</label>
            <select class="form-control" name="Gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="PreferNotToSay">Prefer not to say</option>
            </select>
            <label>Date of Birth</label>
            <input type="text" class="form-control" placeholder="Enter Date of Birth" name="DoB" required>

            <label>Contact Number</label>
            <input type="text" class="form-control" placeholder="Enter Contact Number" name="ContactNo" required>

            <label>Address</label>
            <input type="text" class="form-control" placeholder="Enter Address" name="Address" required>

            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" checked="" required> I accept the <a href="" style="color:blue">Term of
                        Use</a>
                </label>
            </div>
            <button class="btn btn-lg btn-info btn-block" onclick="return Validate()" type="submit"
                name="signup">Register</button>

            <script type="text/javascript">
                function Validate() {
                    var password = document.getElementById("txtPassword").value;
                    var confirmPassword = document.getElementById("txtConfirmPassword").value;
                    if (password != confirmPassword) {
                        alert("Passwords do not match.");
                        return false;
                    }
                    return true;
                }
            </script>

            <br>
            <p>Already have an account? <a href=".?page=login" style="color:white"><b>Login Here</b></a></p>
            <br>
        </form>
    </div>
    <br>
</center>