<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
   
    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php
                    if(isset($_GET['p_id'])) {
                        $post_p_id = $_GET['p_id'];
                        
                        $query = "UPDATE posts SET post_view_count = post_view_count+1 WHERE post_id = {$post_p_id}";
                        $view_count = mysqli_query($connection, $query);
                        query_error($view_count);
                    
                        $query2 = "SELECT * FROM posts WHERE post_id = '$post_p_id'";
                        $select_post = mysqli_query($connection, $query2);
                        query_error($select_post);

                        while($row = mysqli_fetch_assoc($select_post)) {
                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date'];
                            $post_image = $row['post_image'];
                            $post_content = $row['post_content'];

                            $query = "SELECT user_id FROM users WHERE user_name = '$post_author'";
                            $select_author = mysqli_query($connection, $query);

                            while($row = mysqli_fetch_assoc($select_author)) {
                                $user_id = $row['user_id'];
                            }
                            ?>

                            <h1 class="page-header">
                                Page Heading
                                <small>Secondary Text</small>
                            </h1>

                            <!-- First Blog Post -->
                            <h2>
                                <a href="#"><?php echo $post_title ?></a>
                            </h2>
                            <p class="lead">
                                by <?php echo "<a href = 'profile.php?u_id={$user_id}'>" . $post_author. "</a>"; ?>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                            <hr>
                            <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                            <hr>
                            <p><?php echo $post_content; ?></p>
                            <hr> <?php 
                        }
                    } else {
                        header("Location: index.php");
                    }
                ?>
                
                <!-- Blog Comments -->

                <!-- Comments Form -->
                <?php
                    if(isset($_POST['create_comment'])) {
                        $com_p_id = $_GET['p_id'];
                       
                        $com_author = $_SESSION['user_name'];
                        
                        $query = "SELECT user_email FROM users WHERE user_id = {$_SESSION['user_id']}";
                        $com_details = mysqli_query($connection, $query);
                        query_error($com_details);
                        
                        while($row = mysqli_fetch_assoc($com_details)) {
                            $com_email = $row['user_email'];
                        }
                        
                        $com_content = rtrim($_POST['com_content']);
                        
                        if(empty($com_content)) {
                            echo "<div class='alert alert-danger' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Oops!</strong> This field cannot be left blank.</div>";
                            //echo "<script>alert('You cannot post a blank comment.');</script>";
                        } else {
                            $query = "INSERT INTO comments (com_post_id, com_author, com_email, com_content, com_status, com_date) VALUES ({$com_p_id}, '{$com_author}', '{$com_email}', '{$com_content}', 'unapproved', now())";

                            $create_comment = mysqli_query($connection, $query);
                            query_error($create_comment);

                            $query = "UPDATE posts SET post_com_count = post_com_count+1 WHERE post_id = {$com_p_id}";
                            $update_com_count = mysqli_query($connection, $query);
                            query_error($update_com_count);

                            echo "<div class='alert alert-warning' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Success!</strong> Your comment has been recorded and is currently pending approval from the site administrator.</div>";
                        }
                    }
                ?>
                <div class="well">
                    <h4>Leave a Comment</h4><?php
                    if(isset($_SESSION['user_id'])) { ?>
                        <form action ="" method="post" role="form">
                            <div class="form-group">
                                <textarea class="form-control" rows="8" name="com_content" required></textarea>
                            </div>
                            <button type="submit" name="create_comment" class="btn btn-primary" required>Submit</button>
                        </form><?php
                    } else {
                        echo "Please login to post a comment.";
                    }?>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php
                    if(isset($_GET['p_id'])) {
                        $com_p_id = $_GET['p_id'];
                    }
                    $query = "SELECT * FROM comments WHERE com_post_id = {$com_p_id} AND com_status = 'approved' ORDER BY com_id DESC";
                    $select_comments = mysqli_query($connection, $query);
                    query_error($select_comments);
                
                    while($row = mysqli_fetch_array($select_comments)) {
                        $com_date = $row['com_date'];
                        $com_content = $row['com_content'];
                        $com_author = $row['com_author']; 
                    
                        $query = "SELECT user_id, user_image FROM users WHERE user_name = '{$com_author}'";
                        $get_id = mysqli_query($connection, $query);
                        query_error($get_id);

                        while($row = mysqli_fetch_array($get_id)) {
                            $com_author_id = $row['user_id']; 
                            $com_author_image = $row['user_image']; 
                        }
                        ?>
                       
                        <div class="media">
                        <a class="pull-left" href="#"><img class="media-object" src="images/<?php echo $com_author_image; ?>" alt="" width="64px" height="64px"></a>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo "<a href='profile.php?u_id={$com_author_id}'>" . $com_author . "</a>"; ?>
                                    <small><?php echo $com_date; ?></small>
                                </h4>
                                <?php echo $com_content; ?>
                            </div>
                        </div> 
                        <hr> <?php
                    } ?>
                    

                <!-- Comment -->
                
                

                <!-- Pager -->
                <?php //include "includes/pager.php"; ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>
        
<?php include "includes/footer.php"; ?>
