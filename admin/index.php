<?php
    include 'functions.php';
    if(logged());
    else header("Location:login.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/dataTables.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/dataTables.min.js"></script>
    <script src="js/functions.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo $root; ?>">Brand</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <div class="hidden-md hidden-lg">
                <ul class="nav navbar-nav navbar-left">
                <li><a href="?p=dashboard"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
                <li><a href="?p=orders"><span class="glyphicon glyphicon-list-alt"></span> Orders</a></li>
                <li><a href="?p=services"><span class="glyphicon glyphicon-pushpin"></span> Services</a></li>
                </ul>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['user']; ?><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="?logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="col-md-2" id="sidebar">
        <ul class="list-group">
            <li class="list-group-item active"><a href="?p=dashboard"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
            <li class="list-group-item"><a href="?p=orders"><span class="glyphicon glyphicon-list-alt"></span> Orders</a></li>
            <li class="list-group-item"><a href="?p=services"><span class="glyphicon glyphicon-pushpin"></span> Services</a></li>
        </ul>
</div>
<div class="col-md-10" id="content">
    <?php
    if(!empty(isset($_GET['p']))){
        include $_GET['p'].'.php';
    }
    else include 'dashboard.php';
    ?>
</div>
</body>
</html>