<nav class="navbar navbar-expand-sm navbar-dark" style="background-color: black;">
    <a class="navbar-brand" href=".?page=home">ADMIN PORTAL</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation"></button>
   
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
            <a class="nav-link" href=".?page=home">Users <span class="sr-only">(current)</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href=".?page=trash">Trash</a>
        </li>


    </ul>

    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
           
        </ul>

        <form class="form-inline my-2 my-lg-0">
        <?php
        // Example code to conditionally display an edit button
        if ($_SESSION['user_role'] == 'admin') {
            echo '<a class ="nav-item" style="text-align: center; color: white; display: block;">ADMIN Perm Granted</a>';
        } else {
            echo 'You have read-only access.';
        }
        ?>
            <a class="btn btn-danger ml-2" href="./process/logout.php">Logout</a>
        </form>
    </div>
</nav>
