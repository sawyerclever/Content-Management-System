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
                        <div class="col-xs-6">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat-title">Category Title</label>
                                    <input class="form-control" type="text" name ="cat_title">
                                    <?php insert_categories(); ?>
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name ="submit" value="Add Category">
                                </div>
                            </form>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat-title">Edit Category</label>
                                    <?php edit_category(); ?>
                                </div>
                                <div class="form-group">
                                    <?php toggle_edit(); ?>
                                </div>
                            </form>
                        </div>
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover" id="view-all">
                                <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Category Title</th>
                                        <th class="text-center">Modify</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php find_all_categories(); ?>
                                    <?php delete_category(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/adm_footer.php"; ?>