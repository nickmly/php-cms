<div class="table-responsive">
    <table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Post ID</th>
            <th>Author</th>
            <th>Email</th>
            <th>Content</th>
            <th>Date</th>
            <th>Status</th>            
        </tr>
    </thead>
    <tbody>
        <?php
            $comments = getAllComments();
            while($row = mysqli_fetch_assoc($comments)) {
                ?>
                <tr>
                    <?php                        
                        echo "<td>" . $row['comment_id'] . "</td>";
                        echo "<td>" . $row['comment_post_id'] . "</td>";
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
                        <a class="btn-xs btn-danger" href="?deny_comment=<?php echo $row['comment_id']; ?>">Deny</a>
                    </td>
                </tr>                                        
                <?php
            }
        ?>
    </tbody>
    </table>
</div>
