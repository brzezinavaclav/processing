<?php
include __DIR__.'/init.php';
session_start();
function logged(){
    if(isset($_SESSION['user'])) return true;
}
if(isset($_POST['login'])){
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username or Password is invalid";
    }
    else{
        $username = mysqli_real_escape_string($link,$_POST['username']);
        $password = mysqli_real_escape_string($link,$_POST['password']);
        if($result = mysqli_query($link, "SELECT * FROM `users` WHERE username='$username' AND password='$password'")) {
            if(mysqli_num_rows($result) == 1) $user = mysqli_fetch_array($result);
            $_SESSION['user'] = $user[1];
            header("Location:$root");
        }
        $error = '<b>SQL error! </b>' . mysqli_error($link);
    }
}
if(isset($_GET['logout'])){
    session_destroy();
}
if(isset($_GET['get_orders'])){
    if($result = mysqli_query($link, "SELECT * FROM `subscription` ")) {
        $data;
        while($row = mysqli_fetch_assoc($result)){
            !empty($row['transaction']) ? $status = "Paid" : $status = "Not paid";
            !empty($row['confirm']) ? $processed = '<span>'.$row['confirm'].'</span>' : $processed = '<a href="javascript:(confirm('.$row['id'].'));" class="btn btn-xs btn-primary">Confirm</a>';
            $actions = '&nbsp;<a href="javascript:delete_order('.$row['id'].');"><span class="glyphicon glyphicon-trash"></span></a>';
            $data[] = array(
                'address' => $row['address'],
                'username' => $row['username'],
                'email' => $row['email'],
                'service' => $row['service'],
                'period' => $row['period'].' month',
                'status' => $status,
                'processed' => $processed,
                'actions' => $actions
            );
        }
        echo json_encode(array('data' => $data));
    }
    else echo json_encode(array('error' => 'yes', 'message' => '<b>SQL error! </b>' . mysqli_error($link)));
}
if(isset($_GET['delete_order'])){
    if($result = mysqli_query($link, "DELETE FROM `subscription` WHERE id=".$_GET['id'])) echo json_encode(array('error' => 'no'));
    else echo json_encode(array('error' => 'yes', 'message' => '<b>SQL error! </b>' . mysqli_error($link)));
}
if(isset($_GET['get_services'])){
    if($result = mysqli_query($link, "SELECT * FROM `services` ")) {
        $data;
        while($row = mysqli_fetch_assoc($result)){
            $data[] = array(
                'service' => $row['service'],
                'price' => $row['price'],
                'actions' => '<a href="javascript:service_modal('.$row['id'].');"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;<a href="javascript:delete_service('.$row['id'].');"><span class="glyphicon glyphicon-trash"></span></a>'
            );
        }
        echo json_encode(array('data' => $data));
    }
    else echo json_encode(array('error' => 'yes', 'message' => '<b>SQL error! </b>' . mysqli_error($link)));
}
if(isset($_GET['get_service'])){
    if($result = mysqli_query($link, "SELECT * FROM `services` WHERE id='".$_GET['id']."' LIMIT 1")) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode(array('service' => $row['service'], 'price' => $row['price']));
    }
    else echo json_encode(array('error' => 'yes', 'message' => '<b>SQL error! </b>' . mysqli_error($link)));
}
if(isset($_GET['delete_service'])){
    if($result = mysqli_query($link, "DELETE FROM `services` WHERE id=".$_GET['id'])) echo json_encode(array('error' => 'no'));
    else echo json_encode(array('error' => 'yes', 'message' => '<b>SQL error! </b>' . mysqli_error($link)));
}
if(isset($_GET['edit_service'])){
    if($result = mysqli_query($link, "UPDATE `services` SET service='".$_GET['service']."', price='".$_GET['price']."' WHERE id='".$_GET['id']."'")) echo json_encode(array('error' => 'no'));
    else echo json_encode(array('error' => 'yes', 'message' => '<b>SQL error! </b>' . mysqli_error($link)));
}
if(isset($_GET['create_service'])){
    if($result = mysqli_query($link, "INSERT INTO `services` VALUES (NULL, '".$_GET['service']."', '".$_GET['price']."')")) echo json_encode(array('error' => 'no'));
    else echo json_encode(array('error' => 'yes', 'message' => '<b>SQL error! </b>' . mysqli_error($link)));
}
if(isset($_GET['confirm'])){
    if($result = mysqli_query($link, "UPDATE `subscription` SET confirm='".date('Y-m-d H:i:s')."' WHERE id=".$_GET['id'])){
        echo json_encode(array('error' => 'no', 'timestamp' => date('Y-m-d H:i:s')));
    }
    else echo json_encode(array('error' => 'yes', 'message' => '<b>SQL error! </b>' . mysqli_error($link)));
}