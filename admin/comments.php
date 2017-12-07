<?php 
    include "includes/admin_header.php";
    include_once "../includes/functions.php";
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
                        Comments
                    </h1>                    
                    <?php
                        if(isset($_GET['source'])) {
                            $source = $_GET['source'];                            
                        } else {
                            $source = '';
                        }
                        switch($source) {                            
                            default:
                                include "includes/view_all_comments.php"; 
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
