<div class="table-responsive">
    <table class="table table-bordered table-hover">
    <thead>
        <tr>
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
            deleteComment();
            changeCommentStatus();
            $comments = getAllComments();
            while($row = mysqli_fetch_assoc($comments)) {
                $post = getPost($row['comment_post_id']);
                ?>
                <tr>
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
                        <a class="btn-xs btn-success" href="?approve_comment=<?php echo $row['comment_id']; ?>">Approve</a>
                    </td>
                    <td>
                        <a class="btn-xs btn-warning" href="?deny_comment=<?php echo $row['comment_id']; ?>">Deny</a>
                    </td>
                    <td>
                        <a class="btn-xs btn-danger" href="?p_id=<?php echo $row['comment_post_id']; ?>&delete_comment=<?php echo $row['comment_id']; ?>">Delete</a>
                    </td>
                </tr>                                        
                <?php
            }
        ?>
    </tbody>
    </table>
</div>
