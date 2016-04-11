<?php
include __DIR__.'/init.php';
$wallet = new BitcoinWallet($user, $pass, $server, $port);

/*Generování adresy*/
if(isset($_GET['create_subscription'])){
    $address = $wallet->getnewaddress();
    $price = 0.0001;
    if($result = mysqli_query($link, "INSERT INTO `subscription` VALUES (NULL,'".$address."', '".$_GET['username']."', '".$_GET['email']."', '".$_GET['service']."', '".$_GET['period']."', ".$price.", NULL, NULL, NULL)")) {
        echo json_encode(array('error' => 'no', 'data' => array(
            'address' => $address,
            'price' => $price
        )));
    }
    else echo json_encode(array('error' => 'yes', 'message' => '<b>SQL error! </b>' . mysqli_error($link)));
}
if(isset($_GET['check_payment'])){
    foreach($wallet->listtransactions('', 10000) as $transaction){
        if ( $transaction['category'] == 'receive' && $transaction['address'] == $_GET['address'] && $transaction['amount'] == $_GET['amount']) {
            if($result = mysqli_query($link, "UPDATE `subscription` SET `transaction`='". $transaction['txid'] ."'")) {
                echo json_encode(array('error' => 'no'));
            }
            else echo json_encode(array('error' => 'yes', 'message' => '<b>SQL error! </b>' . mysqli_error($link)));
        }
    }
}
