<?php include "includes/adm_header.php"; ?>
    <div id="wrapper">
        <?php include "includes/adm_navigation.php"; ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Admin Control Panel
                            <small><?php echo $_SESSION['user_name']; ?></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-bordered table-hover" id="view-all">
                            <thead>
                                <tr>
                                    <th class="text-center">Item</th>
                                    <th class="text-center">Decription</th>
                                    <th class="text-center">Value</th>
                                    <th class="text-center">Reset</th>
                                </tr>
                            </thead>
                            <tbody class="text-center valign">
                                <tr>
                                    <td class="text-center valign">Site Title</td>
                                    <td class="text-center valign">Change the title of the website in areas such as the navigation bar and the page title.</td>
                                    <td class="text-center valign"><input type='text' placeholder='default'></td>
                                    <td class="text-center valign"><a href='#'><i class="fa fa-fw fa-undo"></i></a></td>
                                </tr>
                                <tr>
                                    <td class="text-center valign">Company Name</td>
                                    <td class="text-center valign">Change the default company name</td>
                                    <td class="text-center valign"><input type='text' placeholder='default'></td>
                                    <td class="text-center valign"><a href='#'><i class="fa fa-fw fa-undo"></i></a></td>
                                </tr>
                                <tr>
                                    <td class="text-center valign">Comment Approval</td>
                                    <td class="text-center valign">Change whether or not post comments need to be approved by an administrator.</td>
                                    <td class="text-center valign"><input type='text' placeholder='default'></td>
                                    <td class="text-center valign"><a href='#'><i class="fa fa-fw fa-undo"></i></a></td>
                                </tr>
                                <tr>
                                    <td class="text-center valign">Contact Email</td>
                                    <td class="text-center valign">Change the default contact email.</td>
                                    <td class="text-center valign"><input type='text' placeholder='default'></td>
                                    <td class="text-center valign"><a href='#'><i class="fa fa-fw fa-undo"></i></a></td>
                                </tr>
                                <tr>
                                    <td class="text-center valign">Copyright Year</td>
                                    <td class="text-center valign">Change the default copyright year.</td>
                                    <td class="text-center valign"><input type='text' placeholder='default'></td>
                                    <td class="text-center valign"><a href='#'><i class="fa fa-fw fa-undo"></i></a></td>
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