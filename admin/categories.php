<?php 
    include "includes/admin_header.php";
    include "../includes/functions.php";
?>
<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_nav.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">
            <?php
                addCategory();
                deleteCategory();
            ?>
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Add Categories
                    </h1>
                    <div class="col-xs-6">
                        <form action="" method="post">
                            <div class="form-group">
                            <label for="cat_title">Category Title</label>
                                <input class="form-control" type="text" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit_cat" value="Add Category">
                            </div>
                        </form>
                    </div>
                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $categories = getAllCategories();
                                    while($row = mysqli_fetch_assoc($categories)){
                                        ?>
                                        <tr>
                                        <?php
                                            echo "<td>" . $row['cat_id'] . "</td>";
                                            echo "<td>" . $row['cat_title'] . "</td>";
                                        ?>
                                        <td>                                            
                                            <a class='btn btn-danger btn-xs' href="?delete_cat=true&id=<?php echo $row['cat_id']; ?>">Delete</a>                                            
                                        </td>
                                        </tr>
                                        <?php
                                    }
                                ?>                                                        
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<?php
    include "includes/admin_footer.php";
?>
