<?php
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
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

    <title>PHP Blog</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-home.css" rel="stylesheet">

    <!-- Font Awesome CSS -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>
<body>
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

   