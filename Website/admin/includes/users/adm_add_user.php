<?php create_user(); ?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_fname">First Name</label>
        <input type="text" class="form-control" name="user_fname" required>
    </div>
    <div class="form-group">
        <label for="user_lname">Last Name</label>
        <input type="text" class="form-control" name="user_lname" required>
    </div>
    <div class="form-group">
        <label for="user_role">Role</label><br>
        <select name="user_role" id="" required>
            <option value="" selected disabled>-----</option>
            <option value="user">Registered User</option>
            <option value="sub">Subscriber</option>
            <option value="admin">Administrator</option>
        </select>
    </div>
    <div class="form-group">
        <label for="user_email">Email Address</label>
        <input type="email" class="form-control" name="user_email" required>
    </div>
    <div class="form-group">
        <label for="user_image">User Image</label>
        <input type="file" name="user_image">
    </div>
    <div class="form-group">
        <label for="user_name">Username</label>
        <input type="text" class="form-control" name="user_name" required>
    </div>
    <div class="form-group">
        <label for="user_pass">Password</label>
        <input type="password" class="form-control" name="user_pass" required>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="user_create" value="Create User">
    </div>
</form>