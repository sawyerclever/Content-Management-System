<?php
    if(isset($_POST['checkboxArray'])) {
        foreach($_POST['checkboxArray'] as $checkboxId) {
            $bulk_options = $_POST['bulk_options'];
            
            switch($bulk_options) {
                case 'published':
                case 'draft':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkboxId}";
                    $multi_update = mysqli_query($connection, $query);
                    query_error($multi_update);
                    break;
                case 'delete':
                    $query = "DELETE FROM posts WHERE post_id = {$checkboxId}";
                    $multi_delete = mysqli_query($connection, $query);
                    query_error($multi_delete);
                    break;
                case 'reset_views':
                    $query = "UPDATE posts SET post_view_count = 0 WHERE post_id = {$checkboxId}";
                    $multi_reset = mysqli_query($connection, $query);
                    query_error($multi_reset);
                    break;
                default:
                    break;
            }
        }
    }
?>

<form action="" method='post'>
    <table class="table table-bordered table-hover" id="view-all">
        <div id="bulkOptionsContainer" class="col-xs-4">
            <select class="form-control" name="bulk_options" id="" required>
                <option value="" selected disabled>-----</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                <option value="reset_views">Reset Views</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="posts.php?source=add_post">Add New Post</a>
        </div>
        <thead>
            <tr>
                <th class="text-center"><input type="checkbox" id="selectAllBoxes"></th>
                <th class="text-center">ID</th>
                <th class="text-center">Author</th>
                <th class="text-center">Title</th>
                <th class="text-center">Category</th>
                <th class="text-center">Status</th>
                <th class="text-center">Image</th>
                <th class="text-center">Tags</th>
                <th class="text-center">Comments</th>
                <th class="text-center">Views</th>
                <th class="text-center">Date</th>
                <th class="text-center">Modify</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php find_all_posts(); ?>
            <?php delete_post(); ?>
        </tbody>
    </table>
</form>