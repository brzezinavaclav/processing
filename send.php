<?php
include __DIR__.'/init.php';
$wallet = new BitcoinWallet($user, $pass, $server, $port);
$wallet->sendtoaddress($_GET['address'], $_GET['amount']);