<?php
    session_start();
    $conn = mysqli_connect("sql309.epizy.com", "epiz_28035304", "z1WwrOjjVntsR", "epiz_28035304_blog") or die ();
    mysqli_set_charset($conn, "utf8");
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $errors = array();
        $data = array();

        if(isset($_POST['email'])&& filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
            $data['email'] = $_POST['email'];
        } else {
            $errors[] = "email";
        }

        if(isset($_POST['password'])) {
            $data['password'] = md5($_POST['password']);
        } else {
            $errors[] = "password";
        }

        if(empty($errors)) {
            $sql = "SELECT * FROM `users` WHERE email= '". $data['email'] ."'" . " AND password= '". $data['password'] ."'";
            $result = mysqli_query($conn, $sql) or die("Lỗi Truy Vấn fetch" . mysqli_error($conn));
            $data = [];
            if ($result) {
                while ($num = mysqli_fetch_assoc($result)) {
                    $data[] = $num;
                }
            }
            if (count($data)> 0) {
                $_SESSION['user'] = $data[0];
                header('Location: index.php');
            }

        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="/style.css">
    <title> The Daily Blog Login/Register </title>
</head>
<body>
<div id="logreg-forms">
    <form class="form-signin" method="post">
        <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Login </h1>

        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="">

        <button class="btn btn-success btn-block" type="submit"><i class="fas fa-sign-in-alt"></i> Sign in</button>
        <a href="register.php" id="forgot_pswd">Sign up New Account</a>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="/script.js"></script>
</body>
</html>
