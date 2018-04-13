<?php include "includes/adm_header.php"; ?>
    <div id="wrapper">
        <?php include "includes/adm_navigation.php"; ?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Admin Control Panel
                            <small><?php echo $_SESSION['user_name']; ?></small>
                        </h1>
                        <?php
                            if(isset($_GET['source'])) {
                                $source = $_GET['source'];
                            } else {
                                $source = '';
                            }
                            switch($source) {
                                case 'add_post':
                                    include "includes/posts/adm_add_post.php";
                                    break;
                                case 'edit_post':
                                    include "includes/posts/adm_edit_post.php";
                                    break;
                                default:
                                    include "includes/posts/adm_view_posts.php";
                                    break;
                            }
                        ?>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/adm_footer.php"; ?>