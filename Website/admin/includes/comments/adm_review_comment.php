<?php
    //posts_by_id();
    if(isset($_GET['com_id'])) {
            $com_c_id = $_GET['com_id'];
    }

    $query = "SELECT com_content, com_id FROM comments WHERE com_id = $com_c_id";
    $review = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($review)) {
        $com_id = $row['com_id'];
        $com_content = $row['com_content'];
    }
?>

<form action="comments.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_content">Comment Content</label>
        <textarea class="form-control" name="com_content" id="" cols="30" rows="10" readonly><?php echo $com_content; ?></textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="return" value="Back">
    </div>
</form>