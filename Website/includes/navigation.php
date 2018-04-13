<?php session_start(); ?>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">CMS</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php
                        $query = "SELECT * FROM categories";
                        $select_all_categories = mysqli_query($connection, $query);
                    
                        while($row = mysqli_fetch_assoc($select_all_categories)) {
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];
                            echo "<li><a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";
                        }
                    ?>
                </ul>
                <ul class="nav navbar-right navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
                            <?php
                                if(isset($_SESSION['user_name'])) {
                                    echo $_SESSION['user_name'];
                                } else {
                                    echo "Login";
                                }
                            ?> 
                            <b class="caret"></b>
                        </a>
                        <?php
                            if(isset($_SESSION['user_name'])) { ?>
                                <ul class="dropdown-menu">
                                    <li><a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a></li>
                                    <li class="divider"></li>
                                    <?php
                                        if(isset($_SESSION['user_role']) AND $_SESSION['user_role'] == 'admin') {
                                            echo "<li><a href='admin'><i class='fa fa-fw fa-gavel'></i> Admin</a></li>";
                                        }
                                    ?>
                                    <!--<li><a href="../index.php"><i class="fa fa-fw fa-home"></i> Home</a></li>-->
                                    <li><a href="includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a></li>
                                </ul> <?php
                            } else { ?>
                                <ul class="dropdown-menu">
                                    <form action="login.php" method="post">
                                        <div class="form-group">
                                            <input name="username" type="text" class="form-control" placeholder="Username">
                                        </div>
                                        <div class="input-group">
                                            <input name="password" type="password" class="form-control" placeholder="Password">
                                            <span class="input-group-btn">
                                                <button name="login" class="btn btn-primary" type="submit">Login</button>
                                            </span>
                                        </div>
                                    </form>
                                </ul> <?php
                            }
                        ?>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>