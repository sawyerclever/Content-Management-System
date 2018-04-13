<?php
    //posts_by_id();
    if(isset($_GET['p_id'])) {
            $post_p_id = $_GET['p_id'];
        }

    $query = "SELECT * FROM posts WHERE post_id = $post_p_id";
    $select_posts_id = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_posts_id)) {
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_cat_id = $row['post_cat_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_content = $row['post_content'];
        $post_com_count = $row['post_com_count'];
        $post_date = $row['post_date'];
    }

    if(isset($_POST['post_edit'])) {
        $post_title = $_POST['post_title'];
        $post_cat_id = $_POST['post_cat_id'];
        $post_status = $_POST['post_status'];
        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        
        move_uploaded_file($post_image_temp, "../images/{$post_image}");
        
        if(empty($post_image)) {
            $query = "SELECT post_image FROM posts WHERE post_id = {$post_p_id}";
            $select_image = mysqli_query($connection, $query);
            
            while($row = mysqli_fetch_array($select_image)) {
                $post_image = $row['post_image'];
            }
        }

        $query = "UPDATE posts SET post_title = '{$post_title}', post_cat_id = {$post_cat_id}, post_author = '{$post_author}', post_status = '{$post_status}', post_image = '{$post_image}', post_tags = '{$post_tags}', post_content = '{$post_content}' WHERE post_id = {$post_p_id}";
        
        $create_post = mysqli_query($connection, $query);

        query_error($create_post);
        echo "<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Success!</strong> Post has been modified. Click <a href='posts.php'><i>here</i></a> to go back to all posts.</div>";
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="post_title" value="<?php echo $post_title; ?>">
    </div>
    <div class="form-group">
        <label for="post_cat">Post Category ID</label><br>
        <select name="post_cat_id" id="">
            <?php
                //categories_dropdown();
                $query = "SELECT * FROM categories";
                $select_categories = mysqli_query($connection, $query);
                query_error($select_categories);
                
                while($row = mysqli_fetch_assoc($select_categories)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    $default_cat = $post_cat_id;?>
                    <option value='<?php echo $cat_id; ?>' <?php if($post_cat_id===$cat_id){echo 'selected';}?> ><?php echo $cat_title; ?> </option>
                    <?php 
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author" value="<?php echo $post_author; ?>" required disabled>
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label><br>
        <!--<input type="text" class="form-control" name="post_status" value="<?php echo $post_status; ?>">-->
        <select name="post_status" id="" required>
            <option value="draft" <?php if($post_status==='draft'){echo 'selected';}?>>Draft</option>
            <option value="published" <?php if($post_status==='published'){echo 'selected';}?>>Published</option>
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label><br>
        <img src="../images/<?php echo $post_image; ?>" width="100px" alt="<?php $post_image; ?>">
        <input type="file" name="post_image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="editor" required><?php echo $post_content; ?></textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="post_edit" value="Confirm Changes">
    </div>
</form>