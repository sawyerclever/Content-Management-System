<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

    <!-- Navigation -->
    <?php  include "includes/navigation.php"; ?>
    
    <!-- Login Query -->
    <?php 
        if(isset($_POST['login'])) {
            $user_name = strtolower($_POST['username']);
            $user_pass = $_POST['password'];

            $user_name = mysqli_real_escape_string($connection, $user_name);
            $user_pass = mysqli_real_escape_string($connection, $user_pass);

            $query = "SELECT * FROM users where user_name = '{$user_name}'";
            $select_user_login = mysqli_query($connection, $query);

            query_error($select_user_login);

            while($row = mysqli_fetch_array($select_user_login)) {
                $db_user_name = $row['user_name']; //username
                $db_user_pass = $row['user_pass']; //password
                $db_user_id = $row['user_id'];
                $db_user_fname = $row['user_fname'];
                $db_user_lname = $row['user_lname'];
                $db_user_role = $row['user_role'];
            }
            
            if(empty($db_user_name) || empty($db_user_pass)) {
                $db_user_name = null;
                $db_user_pass = null;
            }
            
            if($user_name !== $db_user_name || !password_verify($user_pass, $db_user_pass)) {
                $message = "<div class='alert alert-danger' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Oops!</strong> The username or password you entered was incorrect. Please try again.</div>";
            } else if($user_name == $db_user_name && password_verify($user_pass, $db_user_pass)) {
                $_SESSION['user_name'] = $db_user_name;
                $_SESSION['user_fname'] = $db_user_fname;
                $_SESSION['user_lname'] = $db_user_lname;
                $_SESSION['user_role'] = $db_user_role;
                $_SESSION['user_id'] = $db_user_id;
                $message = "";
                header("Location: index.php");
            } else {
                $message = "<div class='alert alert-danger' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Oops!</strong> Something went wrong. Please try again. If this problem persists, please contact an administrator.</div>";
            }
        } else {
            $message = "";
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
                        <h1>Login</h1>
                            <form role="form" action="login.php" method="post" id="login-form" autocomplete="off">
                                <?php echo $message; ?>
                                <div class="form-group">
                                    <label for="username" class="sr-only">Username</label>
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter Username" required>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" name="password" id="key" class="form-control" placeholder="Password" required>
                                </div>
                                <input type="submit" name="login" id="btn-login" class="btn btn-primary btn-lg btn-block" value="Login">
                            </form>
                        </div>
                    </div> <!-- /.col-xs-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </section>
        <hr>



<?php include "includes/footer.php";?>