<?php
    //users_by_id();
    if(isset($_GET['u_id'])) {
            $user_u_id = $_GET['u_id'];
        }

    $query = "SELECT * FROM users WHERE user_id = $user_u_id";
    $select_user_id = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_user_id)) {
        $user_fname = $row['user_fname'];
        $user_lname = $row['user_lname'];
        $user_role = $row['user_role'];
        $user_email = $row['user_email'];
        $user_name = $row['user_name'];
        $user_pass = $row['user_pass'];
        $user_image = $row['user_image'];
    }

    if(isset($_POST['user_edit'])) {
        $user_fname = $_POST['user_fname'];
        $user_lname = $_POST['user_lname'];
        $user_role = $_POST['user_role'];
        $user_email = $_POST['user_email'];
        $user_name = $_POST['user_name'];
        $user_pass = $_POST['user_pass'];
        $user_image = $_FILES['user_image']['name'];
        $user_image_temp = $_FILES['user_image']['tmp_name'];
        
        move_uploaded_file($user_image_temp, "../images/{$user_image}");
        
        if(empty($user_image)) {
            $query = "SELECT user_image FROM users WHERE user_id = {$user_u_id}";
            $select_image = mysqli_query($connection, $query);
            
            while($row = mysqli_fetch_array($select_image)) {
                $user_image = $row['user_image'];
            }
        }
        
        $options = [
                'cost' => 10,
            ];
        
        $user_pass = password_hash($user_pass, PASSWORD_BCRYPT, $options);

        $query = "UPDATE users SET user_fname = '{$user_fname}', user_lname = '{$user_lname}', user_role = '{$user_role}', user_email = '{$user_email}', user_name = '{$user_name}', user_pass = '{$user_pass}', user_image = '{$user_image}' WHERE user_id = {$user_u_id}";
        
        $edit_user = mysqli_query($connection, $query);

        query_error($edit_user);
        echo "<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Success!</strong> User has been modified. Click <a href='users.php'><i>here</i></a> to go back to all users.</div>";
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_fname">First Name</label>
        <input type="text" class="form-control" name="user_fname" value="<?php echo $user_fname ; ?>" required>
    </div>
    <div class="form-group">
        <label for="user_lname">Last Name</label>
        <input type="text" class="form-control" name="user_lname" value="<?php echo $user_lname; ?>" required>
    </div>
    <div class="form-group">
        <label for="user_role">Role</label><br>
        <select name="user_role" id="" required>
            <option value="user" <?php if($user_role==='user'){echo 'selected';}?> >Registered User</option>
            <option value="sub" <?php if($user_role==='sub'){echo 'selected';}?> >Subscriber</option>
            <option value="admin" <?php if($user_role==='admin'){echo 'selected';}?> >Administrator</option>
        </select>
    </div>
    <div class="form-group">
        <label for="user_email">Email Address</label>
        <input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>" required>
    </div>
    <div class="form-group">
        <label for="user_image">User Image</label><br>
        <img src="../images/<?php echo $user_image; ?>" width="100px" alt="<?php $user_image; ?>">
        <input type="file" name="user_image">
    </div>
    <div class="form-group">
        <label for="user_name">Username</label>
        <input type="text" class="form-control" name="user_name" value="<?php echo $user_name; ?>" required>
    </div>
    <div class="form-group">
        <label for="user_pass">Password</label>
        <input type="password" class="form-control" name="user_pass" value="<?php echo $user_pass; ?>" required>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="user_edit" value="Confirm Changes">
    </div>
</form>