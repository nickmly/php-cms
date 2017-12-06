<table class="table table-bordered table-hover">
<thead>
    <tr>
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
        $posts = getAllPosts();
        while($row = mysqli_fetch_assoc($posts)) {
            ?>
            <tr>
                <?php
                    $cat_title = getCategoryTitle($row['post_category_id']);
                    echo "<td>" . $row['post_id'] . "</td>";
                    echo "<td>" . $row['post_author'] . "</td>";
                    echo "<td>" . $row['post_title'] . "</td>";
                    echo "<td>" . $row['post_date'] . "</td>";
                    echo "<td>" . $cat_title . "</td>";
                    echo "<td>" . $row['post_status'] . "</td>";
                    echo "<td><img class='img-responsive' src='../images/" . $row['post_image'] . "'></td>";
                    echo "<td>" . $row['post_tags'] . "</td>";
                    echo "<td>" . $row['post_comment_count'] . "</td>";
                ?>
            </tr>                                        
            <?php
        }
    ?>
</tbody>
</table>