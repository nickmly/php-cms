<?php 
    include "includes/admin_header.php";
    include_once "../includes/functions.php";
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

                
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-file-text fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                        <div class='huge'><?php echo $post_count; ?></div>
                                <div>Posts</div>
                            </div>
                        </div>
                    </div>
                    <a href="posts.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                            <div class='huge'><?php echo $comment_count; ?></div>
                            <div>Comments</div>
                            </div>
                        </div>
                    </div>
                    <a href="comments.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                            <div class='huge'><?php echo $user_count; ?></div>
                                <div> Users</div>
                            </div>
                        </div>
                    </div>
                    <a href="users.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-list fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class='huge'><?php echo $category_count; ?></div>
                                <div>Categories</div>
                            </div>
                        </div>
                    </div>
                    <a href="categories.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">            
            <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
        </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<?php
    include "includes/admin_footer.php";
?>
