<?php create_post(); ?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="post_title" required>
    </div>
    <div class="form-group">
        <label for="post_cat">Post Category ID</label><br>
        <select name="post_cat_id" id="" required>
            <option value="" selected disabled>-----</option>
            <?php
                //categories_dropdown();
                $query = "SELECT * FROM categories";
                $select_categories = mysqli_query($connection, $query);
                query_error($select_categories);
                
                while($row = mysqli_fetch_assoc($select_categories)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    $default_cat = $post_cat_id;?>
                    <option value='<?php echo $cat_id; ?>' ><?php echo $cat_title; ?> </option>
                    <?php 
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author" value="<?php echo $_SESSION['user_name'] ?>" required disabled>
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label><br>
        <select name="post_status" id="" required>
            <option value="" selected disabled>-----</option>
            <option value="draft">Draft</option>
            <option value="published">Published</option>
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content" required>Post Content</label>
        <textarea class="form-control" name="post_content" id="editor"></textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="post_create" value="Create Post">
    </div>
</form>