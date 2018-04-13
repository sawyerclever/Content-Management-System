            <div class="col-md-4">

                <!-- Login Well -->
                <?php
                    if(!isset($_SESSION['user_name'])) { ?>
                        <div class="well">
                            <h4>Login</h4>
                                <form action="login.php" method="post">
                                    <div class="form-group">
                                        <input name="username" type="text" class="form-control" placeholder="Username" required>
                                    </div>
                                    <div class="input-group">
                                        <input name="password" type="password" class="form-control" placeholder="Password" required>
                                        <span class="input-group-btn">
                                            <button name="login" class="btn btn-primary" type="submit">Login</button>
                                        </span>
                                    </div>
                                </form>
                            <!-- /.input-group -->
                        </div><?php
                    }
                ?>
                
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                        <form action="search.php" method="post">
                        <div class="input-group">
                            <input name="search" type="text" class="form-control">
                            <span class="input-group-btn">
                                <button name="submit" class="btn btn-default" type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                            </button>
                            </span>
                        </div>
                        </form>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <?php
                        $query = "SELECT * FROM categories";
                        $select_sidebar_categories = mysqli_query($connection, $query);
                    ?>
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                                <?php
                                    while($row = mysqli_fetch_assoc($select_sidebar_categories)) {
                                        $cat_id = $row['cat_id'];
                                        $cat_title = $row['cat_title'];
                                        echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <?php include "widget.php"; ?>

            </div>