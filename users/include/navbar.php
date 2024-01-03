<nav class="navbar navbar-expand-sm navbar-dark" style="background-color: black;">
    <a class="navbar-brand" href=".?page=home">SYSTEM</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
        aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation"></button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href=".?page=home">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href=".?page=upload_form">Upload</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href=".?folder=process/&page=submitted_thesis">Submitted Thesis</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
        <?php
        // Example code to conditionally display an edit button
        if ($_SESSION['user_role'] == 'regular_user') {
            echo '<a style="text-align: center; color: white; display: block;">Regular User</a>';
        }
        ?>
            <a class="btn btn-danger ml-2" href="./process/logout.php">Sign Out</a>
        </form>
    </div>
</nav>
