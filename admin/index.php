<?php 
    include "includes/admin_header.php";
    include_once "../includes/functions.php";
    include_once "../includes/user_functions.php";
    include_once "../includes/comment_functions.php";
    include_once "../includes/post_functions.php";

    $post_count = getTableCount("posts");
    $category_count = getTableCount("categories");
    $user_count = getTableCount("users");
    $comment_count = getTableCount("comments");
    $pending_comment_count = mysqli_num_rows(getAllPendingComments());
    $draft_post_count = mysqli_num_rows(getAllDraftPosts());
    $published_post_count = mysqli_num_rows(getAllPublishedPosts());
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Data', 'Count'],
        <?php
            $element_text = ['Posts', 'Draft Posts', 'Published Posts', 'Comments', 'Pending Comments', 'Users', 'Categories'];
            $element_count = [$post_count, $draft_post_count, $published_post_count, $comment_count, $pending_comment_count, $user_count, $category_count];
            for($i = 0; $i < 6; $i++) {
                echo "['{$element_text[$i]}'" . ", " . "{$element_count[$i]}],";
            }
        ?>
    ]);

    var options = {
      chart: {
        title: 'Blog Performance',
        subtitle: '',
      }
    };

    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

    chart.draw(data, google.charts.Bar.convertOptions(options));
  }
</script>


<div id="wrapper">
    <!-- Navigation -->
    <?php include "includes/admin_nav.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to your Dashboard
                        <small><?php showCurrentUsername(); ?></small>
                    </h1>
                </div>
            </div>
            <!-- /.row -->                 

        <div class="card-group">
            <div class="card border-primary">
                <div class="card-body">
                    <span class="card-title">                    
                        <i class="fa fa-file-text fa-5x"></i>
                    </span>
                    <span class="huge card-text float-right">
                        <?php echo $post_count; ?>                        
                    </span>
                    <p class="text-right">Posts</p>               
                </div>
                <a href="posts.php">
                    <div class="card-footer text-primary">
                        More details <i class="fa fa-arrow-circle-right pull-right"></i>
                    </div>
                </a>
            </div>
            <div class="card border-success">
                <div class="card-body">
                    <span class="card-title">                    
                        <i class="fa fa-comments fa-5x"></i>
                    </span>
                    <span class="huge card-text float-right">
                        <?php echo $comment_count; ?>                       
                    </span>
                    <p class="text-right">Comments</p>                            
                </div>
                <a href="comments.php">
                    <div class="card-footer text-success">
                        More details <i class="fa fa-arrow-circle-right pull-right"></i>
                    </div>
                </a>
            </div>
            <div class="card border-danger">
                <div class="card-body">
                    <span class="card-title">                    
                        <i class="fa fa-users fa-5x"></i>
                    </span>
                    <span class="huge card-text float-right">
                        <?php echo $user_count; ?>                       
                    </span>
                    <p class="text-right">Users</p>                            
                </div>
                <a href="users.php">
                    <div class="card-footer text-danger">
                        More details <i class="fa fa-arrow-circle-right pull-right"></i>
                    </div>
                </a>
            </div>
            <div class="card border-warning">
                <div class="card-body">
                    <span class="card-title">                    
                        <i class="fa fa-list fa-5x"></i>
                    </span>
                    <span class="huge card-text float-right">
                        <?php echo $category_count; ?>                       
                    </span>
                    <p class="text-right">Categories</p>                            
                </div>
                <a href="categories.php">
                    <div class="card-footer text-warning">
                        More details <i class="fa fa-arrow-circle-right pull-right"></i>
                    </div>
                </a>
            </div>
        </div>
        
        <hr>   
        <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
        

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<?php
    include "includes/admin_footer.php";
?>
