<?php
    ob_start();
    include "../includes/db.php";
    include "../includes/functions.php";
?>

<?php
    if(getCurrentUserRole() != "admin") {
        header("Location: ../index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PHP Blog Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Loader -->
    <!-- <link href="css/loader.css" rel="stylesheet" type="text/css"> -->

    <!-- JQuery -->
    <script src="js/jquery.js"></script>
</head>
<body>
<!-- <div id="load-screen">
    <div id="loading">
    </div>
</div> -->
<div class="container">
<?php
    if(isset($_SESSION['success_message'])) {
        echo "<div class='alert alert-success alert-dismissable'>" . $_SESSION['success_message'];
    ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
    <?php
    } else if(isset($_SESSION['error_message'])){
        echo "<div class='alert alert-danger alert-dismissable'>" . $_SESSION['error_message'];
    ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
    <?php
    }
    ?>
    
<?php
// Clear session messages
    $_SESSION['success_message'] = null;
    $_SESSION['error_message'] = null;
?>
</div>
<!-- <script>
    $("#load-screen").delay(700).fadeOut(600, function() {
        $(this).remove();
    });
</script> -->