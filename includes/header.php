<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/init.php');
if(!isset($_SESSION['admin'])) {
    header('Location: login');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="<?=$site_url;?>/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?=$site_url;?>/assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <title>Connect+</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>


    <!-- Bootstrap core CSS     -->
    <link href= "<?=$site_url;?>/assets/css/bootstrap.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="<?=$site_url;?>/assets/css/paper-dashboard.css" rel="stylesheet"/>

    <!--  Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="<?=$site_url;?>/assets/css/themify-icons.css" rel="stylesheet">

    <!--   Core JS Files. Extra: TouchPunch for touch library inside jquery-ui.min.js   -->
    <script src="<?=$site_url;?>/assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="<?=$site_url;?>/assets/js/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?=$site_url;?>/assets/js/perfect-scrollbar.min.js" type="text/javascript"></script>
    <script src="<?=$site_url;?>/assets/js/bootstrap.min.js" type="text/javascript"></script>

</head>

<body>
<div class="wrapper">
    <?php
    include_once('sidebar.php');

    // display notification
    if (isset($_GET['success']) && isset($_GET['message'])) {
        $color = $_GET['success'] == 1 ? 'green' : 'red';
        echo $__GB->DisplayError($__GB->b64decode($_GET['message']), $color);
    }




    ?>

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-minimize">
                    <button id="minimizeSidebar" class="btn btn-fill btn-icon"><i class="ti-more-alt"></i></button>
                </div>
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>



