<?php
include('request_handle.php');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login by oops</title>
</head>

<body>
<div>

<!-- login -->
    <form action="request_handle.php" method="post">
        <input type="text" name="name" id="">
        <input type="password" name="pass">
        <button type="submit" name="login" >login</button>
    </form>


<!-- register -->
       <form action="request_handle.php" method="post">
        <input type="text" name="name" id="">
        <input type="password" name="pass">
        <button type="submit" name="register" >Register</button>
    </form>
</div>
</body>

</html>