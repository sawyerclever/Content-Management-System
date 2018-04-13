                    <?php
                        if(isset($_SESSION['user_name'])) {
                            $user_name = $_SESSION['user_name'];

                            $query = "SELECT * FROM users WHERE user_name = '${user_name}'";
                            $user_profile = mysqli_query($connection, $query);
                            query_error($user_profile);

                            while($row = mysqli_fetch_array($user_profile)) {
                                $user_id = $row['user_id'];
                                $user_name = $row['user_name'];
                                $user_pass = $row['user_pass'];
                                $user_fname = $row['user_fname'];
                                $user_lname = $row['user_lname'];
                                $user_email = $row['user_email'];
                                $user_image = $row['user_image'];
                                $user_role = $row['user_role'];
                                $user_date = $row['user_date'];
                            }

                            if(isset($_POST['prof_edit'])) {
                                $user_fname = $_POST['user_fname'];
                                $user_lname = $_POST['user_lname'];
                                $user_email = $_POST['user_email'];
                                $user_pass = $_POST['user_pass'];
                                $user_image = $_FILES['user_image']['name'];
                                $user_image_temp = $_FILES['user_image']['tmp_name'];

                                move_uploaded_file($user_image_temp, "images/{$user_image}");

                                if(empty($user_image)) {
                                    $query = "SELECT user_image FROM users WHERE user_id = {$user_id}";
                                    $select_image = mysqli_query($connection, $query);

                                    while($row = mysqli_fetch_array($select_image)) {
                                        $user_image = $row['user_image'];
                                    }
                                }

                                $query = "UPDATE users SET user_fname = '{$user_fname}', user_lname = '{$user_lname}', user_role = '{$user_role}', user_email = '{$user_email}', user_name = '{$user_name}', user_pass = '{$user_pass}', user_image = '{$user_image}' WHERE user_id = {$user_id}";

                                $edit_profile = mysqli_query($connection, $query);
                                query_error($edit_profile);
                            }
                        }
                    ?>
                    <div class="col-md-8">
                        <div class="well">
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
                                    <label for="user_email">Email Address</label>
                                    <input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="user_image">User Image</label><br>
                                    <img src="images/<?php echo $user_image; ?>" width="100px" height="100px" alt="<?php $user_image; ?>">
                                    <input type="file" name="user_image">
                                </div>
                                <div class="form-group">
                                    <label for="user_pass">Password</label>
                                    <input type="password" class="form-control" name="user_pass" value="<?php echo $user_pass; ?>" required>
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="prof_edit" value="Save">
                                </div>
                            </form>
                        </div>
                    </div>