<!DOCTYPE html>
<html lang="en">
<!-- head -->

<head>
        <?php include('include/head.php') ?>
</head>
<!--close  head -->

<!-- navbar -->
<?php include('include/navbar.php') ?>
<!-- navbar end -->


<!-- content -->

<body>
        <?php
        $include_folder = isset($_GET['folder']) ? $_GET['folder'] : 'pages/';
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
        require_once($include_folder . $page . '.php');
        ?>
        <!-- end content -->


        <!-- footer -->
        <footer class="footer">
                <?php include('include/footer.php') ?>
        </footer>
        <!-- footer end -->

        <!-- sccript -->

        <script src="assets/js/code.jquery.comjquery-3.5.1.slim.min.js"></script>
        <script src="assets/js/cdn.jsdelivr.netnpmbootstrap@4.5.3distjsbootstrap.bundle.min.js"></script>
        <!-- end sccript -->
</body>

</html>