<?php
    session_start();
    $conn = mysqli_connect("sql309.epizy.com", "epiz_28035304", "z1WwrOjjVntsR", "epiz_28035304_blog") or die ();
    mysqli_set_charset($conn, "utf8");
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $errors = array();
        $data = array();

        if(!empty($_POST['name'])) {
            $data['name'] = $_POST['name'];
        } else {
            $errors[]= "name";
        }

        if(isset($_POST['password']) && preg_match('/^[\w\'.-]{2,20}$/i',trim($_POST['password']))) {
            if($_POST['password'] == $_POST['r_password']) {
                $data['password'] = md5($_POST['r_password']);
            } else {
                $errors[] = "password";
            }
        }

        if(empty($_POST['password'])) {
            $errors[] = "password";
        }

        if(empty($_POST['r_password'])) {
            $errors[] = "r_password";
        }

        if(isset($_POST['email'])&& filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
            $data['email'] = $_POST['email'];
        } else {
            $errors[] = "email";
        }
        $data['user_role'] = 0;

        if(empty($errors)) {
            $sql = "INSERT INTO `users`(`name`, `email`, `password`, `user_role`)
                    VALUES ('".$data['name']."','".$data['email']."', '".$data['password']."', ". $data['user_role'] .")";

            mysqli_query($conn, $sql) or die("Errors  query  insert ----" .mysqli_error($conn));
            $idRow =  mysqli_insert_id($conn);
            if ($idRow) {
                header('Location: login.php');
            } else {
                $flgErros = true;
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
    <form action="" method="post">
        <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Sign in</h1>
        <input type="text" id="user-name" name="name" class="form-control" placeholder="Name" required="" autofocus="">
        <input type="email" id="user-email" name="email" class="form-control" placeholder="Email address" required autofocus="">
        <input type="password" id="user-pass" name="password" class="form-control" placeholder="Password" required autofocus="">
        <input type="password" id="user-repeatpass" name="r_password" class="form-control" placeholder="Repeat Password" required autofocus="">

        <button class="btn btn-primary btn-block" type="submit"><i class="fas fa-user-plus"></i> Sign Up</button>
        <a href="login.php" id="cancel_signup"><i class="fas fa-angle-left"></i> Back</a>
    </form>
    <br>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="/script.js"></script>
</body>
</html>
