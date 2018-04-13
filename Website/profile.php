<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
   
    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-4">
                <?php
                    if(isset($_GET['u_id'])) {
                        $user_u_id = $_GET['u_id'];
                    } else if(isset($_SESSION['user_id']) AND !isset($_GET['u_id'])) {
                        $user_u_id = $_SESSION['user_id'];
                    } else {
                        header("Location: index.php");
                    }
                    $query = "SELECT * FROM users WHERE user_id = '$user_u_id'";
                    $user_profile = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($user_profile)) {
                        $user_id = $row['user_id'];
                        $user_role = $row['user_role'];
                        $user_image = $row['user_image'];
                        $user_name = $row['user_name'];
                        $user_date = $row['user_date'];
                        ?>
                        <div class="well">
                            <h1>
                                <?php echo $user_name; ?>
                                <p><small>
                                    <?php
                                        if(isset($user_role) AND $user_role == 'admin') {
                                            echo "Administrator";
                                            if(isset($_SESSION['user_id']) AND $_SESSION['user_id'] == $user_u_id) {
                                                if(!isset($_GET['edit'])) {
                                                    echo "<br><a href='profile.php?edit'><button type='submit' name='edit_profile' class='btn btn-primary' required>Edit Profile</button></a>";
                                                } else {
                                                    if(!isset($_POST['prof_edit'])) {
                                                        echo "<br><a href='profile.php'><button type='submit' name='edit_profile' class='btn btn-danger' required>Exit without Saving</button></a>";
                                                    } else {
                                                        echo "<br><a href='profile.php'><button type='submit' name='edit_profile' class='btn btn-success' required>Exit</button></a>";
                                                    }
                                                }
                                            }
                                        } else if(isset($user_role) AND $user_role == 'sub') {
                                            echo "Subscriber";
                                        } else {
                                            echo "Registered User";
                                        }
                                    ?>
                                </small></p>
                            </h1>
                        </div>
                        <div class="well">
                            <img src="images/<?php echo $user_image; ?>" height="100px" width="100px" alt="<?php $user_image; ?>">
                            <p><span class="glyphicon glyphicon-time"></span> <?php echo "Member Since: " . $user_date; ?><br>
                            <span class="glyphicon glyphicon-time"></span> <?php echo "Last Active: " . $user_date; ?></p>
                        </div>
                        <?php
                            $post_count = 0;
                            $query = "SELECT * FROM posts WHERE post_author = '$user_name'";
                            $posts_profile = mysqli_query($connection, $query);

                            while($row = mysqli_fetch_assoc($posts_profile)) {
                                $post_author = $row['post_author'];
                                $post_id = $row['post_id'];
                                $post_count = $post_count+1;
                            }
                        
                            $com_count = 0;
                            $query = "SELECT * FROM comments WHERE com_author = '$user_name'";
                            $coms_profile = mysqli_query($connection, $query);

                            while($row = mysqli_fetch_assoc($coms_profile)) {
                                $com_author = $row['com_author'];
                                $com_id = $row['com_id'];
                                $com_count = $com_count+1;
                            }
                        ?>
                        <div class="well">
                            <p>Post Count: <?php echo "<a href=''>".$post_count."</a>"; ?><br>
                            Comment Count: <?php echo "<a href=''>".$com_count."</a>"; ?><br></p>
                        </div>
                        <?php
                    }
                ?>

                <!-- Pager -->
                <?php //include "includes/pager.php"; ?>

            </div>

            <!-- Righthand Side -->
            <?php
                if(isset($_GET['edit'])) {
                    include "includes/edit_profile.php";
                } else {
                    include "includes/visitor_message.php";
                }
            ?>
            

        </div>
        <!-- /.row -->

        <hr>
        
<?php include "includes/footer.php"; ?>
