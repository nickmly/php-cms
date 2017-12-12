<?php
    include_once __DIR__ . "/../../includes/functions.php";
    addPost();
?>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" name="post_title" class="form-control">        
    </div>
    <div class="form-group">
        <label for="post_cat">Post Category</label>
        <select class="form-control" name="post_cat">
            <?php
                $categories = getAllCategories();
                while($row = mysqli_fetch_assoc($categories)) {
                    echo "<option value='" . $row['cat_id'] . "'>" . $row['cat_title'] ."</option>";
                }
            ?>
        </select>  
    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" name="post_author" class="form-control">        
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image" class="btn btn-default">        
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" name="post_tags" class="form-control">        
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>     
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select class="form-control" name="post_status">
            <option value="draft">Draft</option>
            <option value="published">Published</option>
        </select>
    </div>
    <div class="form-group">        
        <input type="submit" name="post_submit" class="btn btn-primary" value="Publish">
    </div>
</form>