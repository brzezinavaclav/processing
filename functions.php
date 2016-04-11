<?php
include __DIR__.'/init.php';
$wallet = new BitcoinWallet($user, $pass, $server, $port);

if(isset($_GET['get_services'])){
    if($result = mysqli_query($link, "SELECT * FROM `services` ")) {
        $data;
        while($row = mysqli_fetch_assoc($result)){
            $data[] = array(
                'id' => $row['id'],
                'service' => $row['service'],
                'price' => $row['price'],
            );
        }
        echo json_encode($data);
    }
    else echo json_encode(array('error' => 'yes', 'message' => '<b>SQL error! </b>' . mysqli_error($link)));
}
if(isset($_GET['create_subscription'])){
    $address = $wallet->getnewaddress();
    $service = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `services` WHERE id='".$_GET['service']."' LIMIT 1"));
    if($result = mysqli_query($link, "INSERT INTO `subscription` VALUES (NULL,'".$address."', '".$_GET['username']."', '".$_GET['email']."', '".$service['service']."', '".$_GET['period']."', ".$service['price']*$_GET['period'].", NULL, NULL, NULL)")) {
        echo json_encode(array('error' => 'no', 'data' => array(
            'id' => mysqli_insert_id($link),
            'address' => $address,
            'price' => $service['price']*$_GET['period']
        )));
    }
    else echo json_encode(array('error' => 'yes', 'message' => '<b>SQL error! </b>' . mysqli_error($link)));
}
if(isset($_GET['check_payment'])){
    foreach($wallet->listtransactions('', 10000) as $transaction){
        if ( $transaction['category'] == 'receive' && $transaction['address'] == $_GET['address'] && $transaction['amount'] == $_GET['amount']) {
            if($result = mysqli_query($link, "UPDATE `subscription` SET transaction='". $transaction['txid'] ."' WHERE id=".$_GET['id'])) {
                echo json_encode(array('error' => 'no'));
            }
            else echo json_encode(array('error' => 'yes', 'message' => '<b>SQL error! </b>' . mysqli_error($link)));
        }
    }
}
