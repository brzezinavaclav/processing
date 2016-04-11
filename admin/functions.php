<?php
include __DIR__.'/init.php';

/*Get orders*/
if(isset($_GET['get_orders'])){
    if($result = mysqli_query($link, "SELECT * FROM `subscription` ")) {
        $data;
        while($row = mysqli_fetch_assoc($result)){
            !empty($row['transaction']) ? $status = "Paid" : $status = "Not paid";
            !empty($row['confirm']) ? $admin = '<span>'.$row['confirm'].'</span>' : $admin = '<a href="javascript:(confirm('.$row['id'].'));" class="btn btn-sm btn-primary">Confirm</a>';
            $data[] = array(
                'address' => $row['address'],
                'username' => $row['username'],
                'email' => $row['email'],
                'service' => $row['service'],
                'status' => $status,
                'admin' => $admin,
            );
        }
        echo json_encode(array('data' => $data));
    }
    else echo json_encode(array('error' => 'yes', 'message' => '<b>SQL error! </b>' . mysqli_error($link)));
}
if(isset($_GET['confirm'])){
    if($result = mysqli_query($link, "UPDATE `subscription` SET ´confirm´=". date('Y-m-d H:i:s'."WHERE ´id´=".$_GET['id']))){
        echo json_encode(array('error' => 'no', 'timestamp' => date('Y-m-d H:i:s')));
    }
    else echo json_encode(array('error' => 'yes', 'message' => '<b>SQL error! </b>' . mysqli_error($link)));
}