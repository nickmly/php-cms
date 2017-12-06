<?php
    include_once __DIR__ . "/../../includes/functions.php";
    addPost();
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" name="post_title" class="form-control">        
    </div>
    <div class="form-group">
        <label for="post_cat">Post Category ID</label>
        <input type="text" name="post_cat" class="form-control">        
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
        <input type="text" name="post_status" class="form-control">
    </div>
    <div class="form-group">        
        <input type="submit" name="post_submit" class="btn btn-primary" value="Publish">
    </div>
</form>