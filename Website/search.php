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
                    if(isset($_POST['submit'])) {
                        $search = $_POST['search'];
                        
                        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' AND post_status = 'published' ORDER BY post_id DESC";
                        $new_search = mysqli_query($connection, $query);
                        
                        query_error($new_search);
                        
                        $count = mysqli_num_rows($new_search);
                        
                        if($count != 0) {
                            $select_all_posts = mysqli_query($connection, $query);
                    
                            while($row = mysqli_fetch_assoc($select_all_posts)) {
                                $post_title = $row['post_title'];
                                $post_author = $row['post_author'];
                                $post_date = $row['post_date'];
                                $post_image = $row['post_image'];
                                $post_content = $row['post_content'];
                                $post_id = $row['post_id'];

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
                                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                                <hr>
                                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                                <hr>
                                <p><?php if(strlen($post_content) > 250) {echo substr($post_content,0,250) . "...";} else {echo $post_content;} ?></p>
                                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                                <hr>    
                    <?php }
                        } else {
                            echo "<h2>Oops!</h2><p>No results were found with that criteria.</p>";
                        }
                    }
                    ?>
                        

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>
        
<?php include "includes/footer.php"; ?>