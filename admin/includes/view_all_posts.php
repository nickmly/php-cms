<div class="table-responsive">
    <form action="" method="post">
        <div class="bulkOptionsContainer col-xs-4">
            <select class="form-control" name="bulk-options" id="">
                <option value="">Select Options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
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
                <th>Author</th>
                <th>Title</th>
                <th>Date</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
            </tr>
        </thead>
        <tbody>
            <?php
                editAllPosts();
                deletePost();
                $posts = getAllPosts();
                while($row = mysqli_fetch_assoc($posts)) {
                    ?>
                    <tr>
                        <?php
                            $cat_title = getCategoryTitle($row['post_category_id']);
                        ?>
                        <td><input class="checkboxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $row['post_id']; ?>"></td>
                        <?php
                            echo "<td>" . $row['post_id'] . "</td>";
                            echo "<td>" . $row['post_author'] . "</td>";
                            echo "<td><a href=../post.php?p_id=". $row['post_id'] . ">" . $row['post_title'] . "</a></td>";
                            echo "<td>" . $row['post_date'] . "</td>";
                            echo "<td>" . $cat_title . "</td>";
                            echo "<td>" . $row['post_status'] . "</td>";
                            echo "<td><img class='img-responsive' src='../images/" . $row['post_image'] . "'></td>";
                            echo "<td>" . $row['post_tags'] . "</td>";
                            echo "<td>" . $row['post_comment_count'] . "</td>";
                        ?>
                        <td>
                            <a class="btn-xs btn-warning" href="?source=edit&update_post=<?php echo $row['post_id']; ?>">Edit</a>
                        </td>
                        <td>
                            <a onclick="return confirmAction()" class="btn-xs btn-danger" href="?delete_post=<?php echo $row['post_id']; ?>">Delete</a>
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
