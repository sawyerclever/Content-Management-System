<?php
    if(isset($_POST['checkboxArray'])) {
        foreach($_POST['checkboxArray'] as $checkboxId) {
            $bulk_options = $_POST['bulk_options'];
            
            switch($bulk_options) {
                case 'user':
                case 'sub':
                case 'admin';
                    $query = "UPDATE users SET user_role = '{$bulk_options}' WHERE user_id = {$checkboxId}";
                    $multi_update = mysqli_query($connection, $query);
                    query_error($multi_update);
                    break;
                case 'delete':
                    $query = "DELETE FROM users WHERE user_id = {$checkboxId}";
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
                <option value="user">Set Role: User</option>
                <option value="sub">Set Role: Subscriber</option>
                <option value="admin">Set Role: Admin</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="users.php?source=add_user">Add New User</a>
        </div>
        <thead>
            <tr>
                <th class="text-center"><input type="checkbox" id="selectAllBoxes"></th>
                <th class="text-center">ID</th>
                <th class="text-center">Username</th>
                <th class="text-center">First Name</th>
                <th class="text-center">Last Name</th>
                <th class="text-center">Email</th>
                <th class="text-center">Role</th>
                <th class="text-center">Created</th>
                <th class="text-center">Modify</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php find_all_users(); ?>
            <?php delete_user(); ?>
        </tbody>
    </table>
</form>