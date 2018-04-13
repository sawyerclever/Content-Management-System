<?php include "includes/adm_header.php"; ?>
    <div id="wrapper">
        <?php
            $uo_session = session_id();
            $uo_time = time();
        echo "<a>".$uo_time."</a>";
            $time_out_seconds = 60;
            $time_out = $uo_time - $time_out_seconds;
        
            $query = "SELECT * FROM users_online WHERE uo_session = '{$uo_session}'";
            $get_uo = mysqli_query($connection, $query);
            $uo_count = mysqli_num_rows($get_uo);
        
            if($uo_count == null) {
                mysqli_query($connection, "INSERT INTO users_online(uo_session, uo_time) VALUES('{$uo_session}', '{$uo_time}')");
            } else {
                mysqli_query($connection, "UPDATE users_online SET uo_time = '{$uo_time}' WHERE session = '{$uo_session}'");
            }
        
            $uo_query = mysqli_query($connection, "SELECT * FROM users_online WHERE uo_time > '{$time_out}'");
            $count_users = mysqli_num_rows($uo_query);
        ?>
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
                        <h1>
                            <?php echo $count_users; ?>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                <!-- row -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                            $query = "SELECT * FROM categories";
                                            $select_cats = mysqli_query($connection, $query);
                                            $cat_count = mysqli_num_rows($select_cats);
                                            echo "<div class='huge'>{$cat_count}</div>";
                                        ?>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Categories</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-edit fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                            $query = "SELECT * FROM posts";
                                            $select_posts = mysqli_query($connection, $query);
                                            $post_count = mysqli_num_rows($select_posts);
                                            echo "<div class='huge'>{$post_count}</div>";
                                        ?>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Posts</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                            $query = "SELECT * FROM comments";
                                            $select_coms = mysqli_query($connection, $query);
                                            $com_count = mysqli_num_rows($select_coms);
                                            echo "<div class='huge'>{$com_count}</div>";
                                        ?>
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Comments</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                            $query = "SELECT * FROM users";
                                            $select_users = mysqli_query($connection, $query);
                                            $user_count = mysqli_num_rows($select_users);
                                            echo "<div class='huge'>{$user_count}</div>";
                                        ?>
                                        <div>Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Users</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                
                <?php
                    $query = "SELECT * FROM posts WHERE post_status = 'draft'";
                    $select_draft_posts = mysqli_query($connection, $query);
                    $post_draft_count = mysqli_num_rows($select_draft_posts);
                
                    $query = "SELECT * FROM posts WHERE post_status = 'published'";
                    $select_pub_posts = mysqli_query($connection, $query);
                    $post_pub_count = mysqli_num_rows($select_pub_posts);
                
                    $query = "SELECT * FROM comments WHERE com_status = 'approved'";
                    $select_app_coms = mysqli_query($connection, $query);
                    $com_app_count = mysqli_num_rows($select_app_coms);
                
                    $query = "SELECT * FROM comments WHERE com_status = 'unapproved'";
                    $select_unapp_coms = mysqli_query($connection, $query);
                    $com_unapp_count = mysqli_num_rows($select_unapp_coms);
                
                    $query = "SELECT * FROM users WHERE user_role = 'admin'";
                    $select_admins = mysqli_query($connection, $query);
                    $admin_count = mysqli_num_rows($select_admins);
                
                    $query = "SELECT * FROM users WHERE user_role = 'sub'";
                    $select_subs = mysqli_query($connection, $query);
                    $sub_count = mysqli_num_rows($select_subs);
                    
                    $query = "SELECT * FROM users WHERE user_role = 'user'";
                    $select_users = mysqli_query($connection, $query);
                    $normal_user_count = mysqli_num_rows($select_users);
                ?>
                <?php include "includes/dashboard/adm_view_charts.php"; ?>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/adm_footer.php"; ?>