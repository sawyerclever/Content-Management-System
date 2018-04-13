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
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-bordered table-hover" id="view-all">
                            <thead>
                                <tr>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Change Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class='valign text-center'><span class="label label-danger">New!</span></td>
                                    <td class='valign text-center'>This is a dummy description for the alerts menu.</td>
                                    <td class='valign text-center'><i class='fa fa-fw fa-eye-slash'></i></td>
                                </tr>
                                <tr>
                                    <td class='valign text-center'><span class="label label-default">Seen</span></td>
                                    <td class='valign text-center'>This is a dummy description for the alerts menu.</td>
                                    <td class='valign text-center'><i class='fa fa-fw fa-eye'></i></td>
                                </tr>
                                <tr>
                                    <td class='valign text-center'><span class="label label-default">Seen</span></td>
                                    <td class='valign text-center'>This is a dummy description for the alerts menu.</td>
                                    <td class='valign text-center'><i class='fa fa-fw fa-eye'></i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/adm_footer.php"; ?>
                