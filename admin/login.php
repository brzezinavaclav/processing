<?php
include 'functions.php';
$error='';
?>
<form action="functions.php" method="post">
    <label>UserName :</label>
    <input id="name" name="username" placeholder="username" type="text">
    <label>Password :</label>
    <input id="password" name="password" placeholder="Password" type="password">
    <input name="login" type="submit">
    <span><?php echo $error; ?></span>
</form>