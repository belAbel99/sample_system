<?php
session_start();
if(isset($_SESSION['id']) == 0){
    header('location:../');
    exit;
} else {
    ?>

    <!-- navbar -->
    <?php include('include/navbar.php') ?>
    <!-- navbar end -->

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <?php include('include/head.php')?>
    </head>

    <body>
        <?php
        // Determine the folder and page to include
        $include_folder = isset($_GET['folder']) ? $_GET['folder'] : 'pages/';
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';

        // Adjust the include folder based on the page
        if ($page === 'upload_form') {
            $include_folder = 'process/';
        }

        // Include the specific page content
        if ($page === 'profile') {
            require_once('pages/viewdata.php'); // Adjusted to viewdata.php
        } else {
            require_once($include_folder . $page . '.php');
        }
        ?>

        <footer class="footer">
            <?php include('include/footer.php')?>
        </footer>

        <!-- Include your scripts here -->
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/code.jquery.comjquery-3.5.1.slim.min.js"></script>
        <script src="assets/js/cdn.jsdelivr.netnpmbootstrap@4.5.3distjsbootstrap.bundle.min.js"></script>
    </body>
    </html>

    <?php 
} 
?>
