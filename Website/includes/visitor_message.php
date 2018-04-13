            <div class="col-md-8">
   
                <?php
                    if(isset($_POST['post_vm'])) {
                        $vm_author = $_SESSION['user_name'];
                        $vm_author_id = $_SESSION['user_id'];
                        $vm_content = $_POST['vm_content'];
                        
                        $query = "INSERT INTO vmessages (vm_user_id, vm_author, vm_author_id, vm_date, vm_content) VALUES ({$user_u_id}, '{$vm_author}', {$vm_author_id}, now(), '{$vm_content}')";
                        $create_vm = mysqli_query($connection, $query);
                        query_error($create_vm);
                    }
                ?>
                    
                <div class="well">
                    <h4>Visitor Messages</h4>
                    <hr><?php
                    if(isset($_SESSION['user_id'])) { ?>
                        <form action ="" method="post" role="form">
                            <div class="form-group">
                                <textarea class="form-control" rows="5" name="vm_content" required></textarea>
                            </div>
                            <button type="submit" name="post_vm" class="btn btn-primary" required>Post Message</button>
                        </form>
                        <hr><?php
                    } ?>
                    <!-- Posted Visitor Messages -->
                    <?php
                        $query = "SELECT * FROM vmessages WHERE vm_user_id = {$user_u_id} ORDER BY vm_id DESC";
                        $select_vms = mysqli_query($connection, $query);
                        query_error($select_vms);

                        while($row = mysqli_fetch_array($select_vms)) {
                            $vm_date = $row['vm_date'];
                            $vm_content = $row['vm_content'];
                            $vm_author = $row['vm_author']; 
                            $vm_author_id = $row['vm_author_id']; 

                            $query = "SELECT user_image FROM users WHERE user_id = {$vm_author_id}";
                            $get_img = mysqli_query($connection, $query);
                            query_error($get_img);

                            while($row = mysqli_fetch_array($get_img)) {
                                $user_image = $row['user_image'];
                            }?>

                            <div class="media">
                                <a class="pull-left" href="#"><img class="media-object" src="images/<?php echo $user_image; ?>" alt="" width="65px" height="65px"></a>
                                <div class="media-body">
                                    <h4 class="media-heading"><?php echo "<a href='profile.php?u_id={$vm_author_id}'>" . $vm_author . "</a>"; ?>
                                        <small><?php echo $vm_date; ?></small>
                                    </h4>
                                    <?php echo $vm_content; ?>
                                </div>
                            </div> 
                            <hr> <?php
                        } 
                    ?>
                </div>
            </div>