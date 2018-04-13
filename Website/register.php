<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

    <!-- Navigation -->
    <?php  include "includes/navigation.php"; ?>
    
    <!-- Registration -->
    <?php
        if(isset($_POST['register'])) {
            $user_name = rtrim($_POST['username']);
            $user_email = rtrim($_POST['email']);
            $user_pass = rtrim($_POST['password']);
            $user_fname = rtrim($_POST['fname']);
            $user_lname = rtrim($_POST['lname']);

            if(!empty($user_name) && !empty($user_email) && !empty($user_pass) && !empty($user_pass) && !empty($user_pass)) {
                $user_name = mysqli_real_escape_string($connection, $user_name);
                $user_email = mysqli_real_escape_string($connection, $user_email);
                $user_pass = mysqli_real_escape_string($connection, $user_pass);
                $user_fname = mysqli_real_escape_string($connection, $user_fname);
                $user_lname = mysqli_real_escape_string($connection, $user_lname);

                $options = [
                    'cost' => 10,
                ];

                $user_pass = password_hash($user_pass, PASSWORD_BCRYPT, $options);

                $query = "INSERT INTO users (user_name, user_email, user_pass, user_fname, user_lname, user_role, user_date) VALUES ('{$user_name}', '{$user_email}', '{$user_pass}', '{$user_fname}', '{$user_lname}', 'user', now())";
                $register = mysqli_query($connection, $query);
                query_error($register);
                $message = "<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Success!</strong> You have been registered. Click <a href='index.php'><i>here</i></a> to go to the homepage.</div>";
            } else {
                $message = "<div class='alert alert-danger' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Oops!</strong> These fields cannot be left blank.</div>";
            }
        } else {
            $message='';
        }

        if(isset($_SESSION['user_name'])) {
            header("Location: index.php");
        }
    ?>
 
    <!-- Page Content -->
    <div class="container">
        <section id="login">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3">
                        <div class="form-wrap well">
                        <h1 class="text-center">Registration Form</h1>
                            <form role="form" action="register.php" method="post" id="login-form" autocomplete="off">
                                <?php echo $message; ?>
                                <div class="form-group">
                                    <label for="username" class="sr-only">Username</label>
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Desired Username" required>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="sr-only">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" required>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" name="password" id="key" class="form-control" placeholder="Password" required>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="fname" class="sr-only">First Name</label>
                                    <input type="text" name="fname" id="fname" class="form-control" placeholder="First Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="lname" class="sr-only">Last Name</label>
                                    <input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name" required>
                                </div>
                                <input type="submit" name="register" id="btn-login" class="btn btn-primary btn-lg btn-block" value="Register">
                            </form>
                        </div>
                    </div> <!-- /.col-xs-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </section>
        <hr>



<?php include "includes/footer.php";?>
