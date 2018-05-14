<?php
/**
 * Created by PhpStorm.
 * User: Arafeh
 * Date: 5/14/2018
 * Time: 10:47 PM
 */

if (!empty($_POST['password']) && $_POST['password'] === 'admin') {
    header('location: admin.php');
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
            integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
            crossorigin="anonymous"></script>
</head>
<body style="text-align: center">
<div style="position: absolute;width: 300px; height: 200px;z-index: 15;
  top: 50%;
  left: 50%;
  margin: -100px 0 0 -150px;
  padding: 16px;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  text-align: center;
  ">
    <h3 style="color:#17a2b8;">Welcome to <b>WAVES</b></h3>
    <form style="text-align: center;height: 100%;margin-top: 20px;" method="post">
        <div style="width: 260px;margin: auto">
            <label for="password" class="label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <input type="submit" class="btn btn-info" style="margin-top: 8px">
    </form>
</div>
</body>
</html>
