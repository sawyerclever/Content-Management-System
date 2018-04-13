<?php
    function query_error($result) {
        global $connection;
        if(!$result) {
            die('<b>Query failed.</b> ' . mysqli_error($connection));
        }
    }

    function insert_categories() {
        global $connection;
        if(isset($_POST['submit'])) {
            $cat_title = rtrim($_POST['cat_title']);
            if(empty($cat_title)) {
                echo "This field cannot be left blank.";
            } else {
                $query = "INSERT INTO categories(cat_title) VALUE ('{$cat_title}')";
                $create_category = mysqli_query($connection, $query);
                query_error($create_category);
            }
        }
    }

    function find_all_categories() {
        global $connection;
        $query = "SELECT * FROM categories";
        $select_categories = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_categories)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            echo "<tr><td class='valign'>{$cat_id}</td>";
            echo "<td class='valign'><a href=../category.php?category={$cat_id}>{$cat_title}</td>";
            echo "<td class='valign'><a href='categories.php?edit={$cat_id}'><i class='fa fa-fw fa-pencil'></i></a><br>";
            echo "<a onClick=\" javascript: return confirm('Are you sure you want to delete this category? This action cannot be undone.'); \" href='categories.php?delete={$cat_id}'><i class='fa fa-fw fa-trash'></a></td></tr>";
        }
    }

    function delete_category() {
        global $connection;
        if(isset($_GET['delete'])) {
            $del_cat_id = $_GET['delete'];
            $query = "DELETE FROM categories WHERE cat_id = {$del_cat_id}";
            $delete = mysqli_query($connection, $query);
            header("Location: categories.php");
        }
    }
    
    function edit_category() {
        global $connection;
        if(isset($_GET['edit'])) {
            $cat_id = $_GET['edit'];

            $query = "SELECT * FROM categories WHERE cat_id = $cat_id";
            $edit_categories = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($edit_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                ?>
                <input value="<?php if(isset($cat_title)) {echo $cat_title;} ?>" type="text" class="form-control" name="cat_title" id="edit_cat">
                <?php
            }
        } else { ?>
            <input value="" type="text" class="form-control" name="cat_title" id="edit_cat" readonly>
            <?php
        } 
        if(isset($_POST['update'])) {
            $edit_cat_title = rtrim($_POST['cat_title']);
            if(empty($edit_cat_title)) {
                echo "This field cannot be left blank.";
            } else {
                $query = "UPDATE categories SET cat_title ='{$edit_cat_title}' WHERE cat_id = {$cat_id}";
                $edit = mysqli_query($connection, $query);
                query_error($edit);
                header("Location: categories.php");
            }
        }
    }

    function categories_dropdown() {
        //global $connection;
    }

    function toggle_edit() {
        if(!isset($_GET['edit'])) { ?>
            <input class="btn btn-primary" type="submit" name ="update" value="Update" disabled>
            <?php 
        } else { ?>
            <input class="btn btn-primary" type="submit" name ="update" value="Update" enabled>
            <?php
        }
    }

    function find_all_posts() {
        global $connection;
        $query = "SELECT * FROM posts ORDER BY post_id DESC";
        $select_posts = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_posts)) {
            $post_id = $row['post_id'];
            $post_author= $row['post_author'];
            $post_title= $row['post_title'];
            $post_cat_id= $row['post_cat_id'];
            $post_status= $row['post_status'];
            $post_image= $row['post_image'];
            $post_tags= $row['post_tags'];
            $post_com_count= $row['post_com_count'];
            $post_date= $row['post_date'];
            $post_view_count= $row['post_view_count'];
            
            $query2 = "SELECT user_id FROM users WHERE user_name = '{$post_author}'";
            $get_id = mysqli_query($connection, $query2);

            while($row = mysqli_fetch_assoc($get_id)) {
                $post_author_id = $row['user_id'];
            }

            echo "<tr><td class='valign'><input class='checkboxes' type='checkbox' name='checkboxArray[]' value='$post_id'></td>";
            echo "<td class='valign'>{$post_id}</td>";
            echo "<td class='valign'><a href=../profile.php?u_id={$post_author_id}>{$post_author}</a></td>";
            echo "<td class='valign'><a href=../post.php?p_id={$post_id}>{$post_title}</a></td>";
            $query3 = "SELECT * FROM categories WHERE cat_id = {$post_cat_id}";
            $select_cat_id = mysqli_query($connection, $query3);
            while($row = mysqli_fetch_assoc($select_cat_id)) {
                $cat_id = $row['cat_id'];
                $cat_title= $row['cat_title'];
            }
            echo "<td class='valign'>{$cat_title}</td>";
            echo "<td class='valign'>{$post_status}</td>";
            echo "<td class='valign'><img width='100px' src='{../../../images/{$post_image}' alt='{$post_image}'></td>";
            echo "<td class='valign'>{$post_tags}</td>";
            echo "<td class='valign'>{$post_com_count}</td>";
            echo "<td class='valign'>{$post_view_count}</td>";
            echo "<td class='valign'>{$post_date}</td>";
            echo "<td class='valign'><a href='posts.php?source=edit_post&p_id={$post_id}'><i class='fa fa-fw fa-pencil'></i></a><br>";
            echo "<a onClick=\" javascript: return confirm('Are you sure you want to delete this post? This action cannot be undone.'); \" href='posts.php?delete={$post_id}'><i class='fa fa-fw fa-trash'></i></a></td></tr>";
        }
    }

    function posts_by_id() {
        //global $connection;
    }

    function create_post() {
        global $connection;
        if(isset($_POST['post_create'])) {
            $post_title = $_POST['post_title'];
            $post_author = $_SESSION['user_name'];
            $post_cat_id = $_POST['post_cat_id'];
            $post_status = $_POST['post_status'];

            $post_image = $_FILES['post_image']['name'];
            $post_image_temp = $_FILES['post_image']['tmp_name'];

            $post_tags = $_POST['post_tags'];
            $post_content = $_POST['post_content'];
            $post_date = date('y-m-d');
            $post_com_count = 0;

            move_uploaded_file($post_image_temp, "../images/{$post_image}");

            $query = "INSERT INTO posts(post_cat_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_com_count, post_status) VALUES({$post_cat_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', {$post_com_count}, '{$post_status}')";

            $create_post = mysqli_query($connection, $query);

            query_error($create_post);
            echo "<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Success!</strong> Post has been created. Click <a href='posts.php'><i>here</i></a> to go back to all posts.</div>";
        }
    }

    function delete_post() {
        global $connection;
        if(isset($_GET['delete'])) {
            $del_post_id = $_GET['delete'];
            $query = "DELETE FROM posts WHERE post_id = {$del_post_id}";
            $delete = mysqli_query($connection, $query);
            header("Location: posts.php");
        }
    }

    function find_all_comments() {
        global $connection;
        $query = "SELECT * FROM comments ORDER BY com_id DESC";
        $select_comments = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_comments)) {
            $com_id = $row['com_id'];
            $com_post_id = $row['com_post_id'];
            $com_author = $row['com_author'];
            $com_email = $row['com_email'];
            $com_content = $row['com_content'];
            $com_status = $row['com_status'];
            $com_date = $row['com_date'];
            
            $query2 = "SELECT user_id FROM users WHERE user_name = '{$com_author}'";
            $get_id = mysqli_query($connection, $query2);

            while($row = mysqli_fetch_assoc($get_id)) {
                $com_author_id = $row['user_id'];
            }

            echo "<tr><td class='valign'><input class='checkboxes' type='checkbox' name='checkboxArray[]' value='$com_id'></td>";
            echo "<td class='valign'>{$com_id}</td>";
            echo "<td class='valign'><a href=../profile.php?u_id={$com_author_id}>{$com_author}</a></td>";
            echo "<td class='valign'>";
            if(strlen($com_content) > 100) {
                echo substr($com_content,0,100) . "...";
            } else {
                echo $com_content;
            }
            echo "</td>";
            echo "<td class='valign'>{$com_email}</td>";
            echo "<td class='valign'>{$com_status}</td>";
            $query2 = "SELECT * FROM posts WHERE post_id = {$com_post_id}";
            $select_post_id = mysqli_query($connection, $query2);
            while($row = mysqli_fetch_assoc($select_post_id)) {
                $post_id = $row['post_id'];
                $post_title= $row['post_title'];
            }
            echo "<td class='valign'><a href=../post.php?p_id={$post_id}>{$post_title}</a></td>";
            echo "<td class='valign'>{$com_date}</td>";
            echo "<td class='valign'><a href='comments.php?approve={$com_id}'><i class='fa fa-fw fa-check'></i></a>";
            echo "<br><a href='comments.php?unapprove={$com_id}'><i class='fa fa-fw fa-remove'></i></a></td>";
            echo "<td class='valign'><a href='comments.php?source=review&com_id={$com_id}'><i class='fa fa-fw fa-eye'></i></a>";
            echo "<br><a onClick=\" javascript: return confirm('Are you sure you want to delete this comment? This action cannot be undone.'); \" href='comments.php?delete={$com_id}'><i class='fa fa-fw fa-trash'></i></a></td></tr>";
        }
    }

    function delete_comment() {
        global $connection;
        if(isset($_GET['delete'])) {
            $query2 = "UPDATE posts, comments SET posts.post_com_count = posts.post_com_count-1 WHERE comments.com_post_id = posts.post_id";
            //$query2 = "FOR com_id UPDATE posts SET post_com_count = posts.post_com_count-1";
            $sub_com_count = mysqli_query($connection, $query2);
            query_error($sub_com_count);
            
            $del_com_id = $_GET['delete'];
            $query = "DELETE FROM comments WHERE com_id = {$del_com_id}"; 
            $delete = mysqli_query($connection, $query);
            query_error($delete);
            
            header("Location: comments.php");
        }
    }

    function change_comment_status() {
        global $connection;
        if(isset($_GET['unapprove'])) {
            $unapp_com_id = $_GET['unapprove'];
            $query = "UPDATE comments SET com_status = 'unapproved' WHERE com_id = {$unapp_com_id}";
            $unapprove = mysqli_query($connection, $query);
            header("Location: comments.php");
            
            query_error($unapprove);
        }
        
        if(isset($_GET['approve'])) {
            $app_com_id = $_GET['approve'];
            $query = "UPDATE comments SET com_status = 'approved' WHERE com_id = {$app_com_id}";
            $approve = mysqli_query($connection, $query);
            header("Location: comments.php");
            
            query_error($approve);
        }
    }

    function find_all_users() {
        global $connection;
        $query = "SELECT * FROM users";
        $select_users = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_users)) {
            $user_id = $row['user_id'];
            $user_name = $row['user_name'];
            $user_pass = $row['user_pass'];
            $user_fname = $row['user_fname'];
            $user_lname = $row['user_lname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
            $user_date = $row['user_date'];

            echo "<tr><td class='valign'><input class='checkboxes' type='checkbox' name='checkboxArray[]' value='$user_id'></td>";
            echo "<td class='valign'>{$user_id}</td>";
            echo "<td class='valign'>{$user_name}</td>";
            echo "<td class='valign'>{$user_fname}</td>";
            echo "<td class='valign'>{$user_lname}</td>";
            echo "<td class='valign'>{$user_email}</td>";
            echo "<td class='valign'>{$user_role}</td>";
            echo "<td class='valign'>{$user_date}</td>";
            echo "<td class='valign'><a href='users.php?source=edit_user&u_id={$user_id}'><i class='fa fa-fw fa-pencil'></i></a><br>";
            echo "<a onClick=\" javascript: return confirm('Are you sure you want to delete this user? This action cannot be undone.'); \" href='users.php?delete={$user_id}'><i class='fa fa-fw fa-trash'></i></a></td></tr>";
        }
    }

    function create_user() {
        global $connection;
        if(isset($_POST['user_create'])) {
            $user_fname = $_POST['user_fname'];
            $user_lname = $_POST['user_lname'];
            $user_role = $_POST['user_role'];
            $user_email = $_POST['user_email'];
            $user_name = $_POST['user_name'];
            $user_pass = $_POST['user_pass'];
            $user_date = date('y-m-d');

            $user_image = $_FILES['user_image']['name'];
            $user_image_temp = $_FILES['user_image']['tmp_name'];

            move_uploaded_file($user_image_temp, "../images/{$user_image}");
            
            $options = [
                'cost' => 10,
            ];
        
            $user_pass = password_hash($user_pass, PASSWORD_BCRYPT, $options);

            $query = "INSERT INTO users(user_fname, user_lname, user_role, user_email, user_name, user_pass, user_date, user_image) VALUES('{$user_fname}', '{$user_lname}', '{$user_role}', '{$user_email}', '{$user_name}', '{$user_pass}', now(), '{$user_image}')";

            $create_user = mysqli_query($connection, $query);

            query_error($create_user);
            echo "<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Success!</strong> User has been created. Click <a href='users.php'><i>here</i></a> to go back to all users.</div>";
        }
    }

    function delete_user() {
        global $connection;
        if(isset($_GET['delete'])) {
            $del_user_id = $_GET['delete'];
            $query = "DELETE FROM users WHERE user_id = {$del_user_id}"; 
            $delete = mysqli_query($connection, $query);
            query_error($delete);
            header("Location: users.php");
        }
    }
?>