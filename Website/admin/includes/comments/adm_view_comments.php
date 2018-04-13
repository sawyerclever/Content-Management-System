<?php
    if(isset($_POST['checkboxArray'])) {
        foreach($_POST['checkboxArray'] as $checkboxId) {
            $bulk_options = $_POST['bulk_options'];
            
            switch($bulk_options) {
                case 'approved':
                case 'unapproved':
                    $query = "UPDATE comments SET com_status = '{$bulk_options}' WHERE com_id = {$checkboxId}";
                    $multi_update = mysqli_query($connection, $query);
                    query_error($multi_update);
                    break;
                case 'delete':
                    $query = "DELETE FROM comments WHERE com_id = {$checkboxId}";
                    $multi_delete = mysqli_query($connection, $query);
                    query_error($multi_delete);
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
                <option value="approved">Approve</option>
                <option value="unapproved">Unapprove</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
        </div>
        <thead>
            <tr>
                <th class="text-center"><input type="checkbox" id="selectAllBoxes"></th>
                <th class="text-center">ID</th>
                <th class="text-center">Author</th>
                <th class="text-center">Comment</th>
                <th class="text-center">Email</th>
                <th class="text-center">Status</th>
                <th class="text-center">Post</th>
                <th class="text-center">Date</th>
                <th class="text-center">Review</th>
                <th class="text-center">Modify</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php find_all_comments(); ?>
            <?php delete_comment(); ?>
            <?php change_comment_status(); ?>
        </tbody>
    </table>
</form>