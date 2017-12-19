<?php 
    include "includes/admin_header.php";
    include "../includes/category_functions.php";
    include "../includes/post_functions.php";
?>
<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_nav.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">            
            <!-- Page Heading -->
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="page-header">
                        Posts
                    </h1>                    
                    <?php
                        if(isset($_GET['source'])) {
                            $source = $_GET['source'];                            
                        } else {
                            $source = '';
                        }
                        switch($source) {
                            case "add":
                                include "includes/add_post.php";
                            break;
                            case "edit":
                                include "includes/edit_post.php";
                            break;
                            default:
                                include "includes/view_all_posts.php"; 
                            break;
                        }                
                    ?>                                       
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
