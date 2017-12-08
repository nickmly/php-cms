<?php
    include_once __DIR__ . "/../../includes/functions.php";
    $post = getPost($_GET['update_post']);
    editPost();
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" name="post_title" class="form-control" value="<?php echo $post['post_title']; ?>">        
    </div>    
    <div class="form-group">
        <label for="post_cat">Post Category</label>
        <select class="form-control" name="post_cat">
            <?php
                $categories = getAllCategories();
                while($row = mysqli_fetch_assoc($categories)) {
                    if($post['post_category_id'] == $row['cat_id'])
                        echo "<option selected value='" . $row['cat_id'] . "'>" . $row['cat_title'] ."</option>";
                    else
                        echo "<option value='" . $row['cat_id'] . "'>" . $row['cat_title'] ."</option>";
                }
            ?>
        </select>  
    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" name="post_author" class="form-control" value="<?php echo $post['post_author']; ?>">        
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <img class="img-responsive" src="../images/<?php echo $post['post_image']; ?>">
        
        <input type="file" name="post_image" class="btn btn-default">        
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" name="post_tags" class="form-control" value="<?php echo $post['post_tags']; ?>">        
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo $post['post_content']; ?></textarea>     
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select class="form-control" name="post_status">
            <option value="draft">Draft</option>
            <option value="published">Published</option>
        </select>        
    </div>
    <div class="form-group">        
        <input type="submit" name="post_update" class="btn btn-primary" value="Publish">
    </div>
</form>