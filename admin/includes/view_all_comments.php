<div class="table-responsive">
    <form action="" method="post">
        <div class="bulkOptionsContainer col-xs-4">
            <select class="form-control" name="bulk-options" id="">
                <option value="">Select Options</option>
                <option value="approved">Approve</option>
                <option value="denied">Deny</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input onclick="return confirmAction()" type="submit" name="submit" value="Apply" class="btn btn-success">
            <a class="btn btn-primary" href="?source=add">Add New</a>
        </div>
        <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th><input id="selectAllBoxes" type="checkbox" name=""></th>
                <th>ID</th>
                <th>On Post</th>
                <th>Author</th>
                <th>Email</th>
                <th>Content</th>
                <th>Date</th>
                <th>Status</th>            
            </tr>
        </thead>
        <tbody>
            <?php
                editAllComments();
                deleteComment();
                changeCommentStatus();
                $comments = getAllComments();
                while($row = mysqli_fetch_assoc($comments)) {
                    $post = getPost($row['comment_post_id']);
                    ?>
                    <tr>
                        <td><input class="checkboxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $row['comment_id']; ?>"></td>
                        <?php                        
                            echo "<td>" . $row['comment_id'] . "</td>";
                            echo "<td><a href=../post.php?p_id=". $row['comment_post_id'] . ">" . $post["post_title"] . "</a></td>";
                            echo "<td>" . $row['comment_author'] . "</td>";
                            echo "<td>" . $row['comment_email'] . "</td>";
                            echo "<td>" . $row['comment_content'] . "</td>";
                            echo "<td>" . $row['comment_date'] . "</td>";
                            echo "<td>" . $row['comment_status'] . "</td>";
                        ?>
                        <td>
                            <a class="btn-sm btn-success" href="?approve_comment=<?php echo $row['comment_id']; ?>">Approve</a>
                        </td>
                        <td>
                            <a class="btn-sm btn-warning" href="?deny_comment=<?php echo $row['comment_id']; ?>">Deny</a>
                        </td>
                        <td>
                            <a onclick="return confirmAction()" class="btn-sm btn-danger" href="?p_id=<?php echo $row['comment_post_id']; ?>&delete_comment=<?php echo $row['comment_id']; ?>">Delete</a>
                        </td>
                    </tr>                                        
                    <?php
                }
            ?>
        </tbody>
        </table>
    </form>
</div>
<script>
    function confirmAction() {
        return confirm("Are you sure?");
    }
    var selectAllBox = document.getElementById("selectAllBoxes");
    selectAllBox.addEventListener("click", function(){
        var checkboxes = document.getElementsByClassName("checkboxes");
        for(var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = selectAllBox.checked;
        }
    });
</script>
