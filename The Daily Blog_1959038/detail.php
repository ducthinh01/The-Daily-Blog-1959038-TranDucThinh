<?php
    session_start();
    $conn = mysqli_connect("sql309.epizy.com", "epiz_28035304", "z1WwrOjjVntsR", "epiz_28035304_blog") or die ();
    mysqli_set_charset($conn, "utf8");
    $id = $_GET['id'];
    if ($id) {
        $sql = "SELECT * FROM `posts` WHERE id =". $id;
        $result = mysqli_query($conn, $sql) or die("Lỗi Truy Vấn fetch" . mysqli_error($conn));

        $data = [];
        if ($result) {
            while ($num = mysqli_fetch_assoc($result)) {
                $data[] = $num;
            }
        }
        $post = $data[0];

    } else {
        header('Location: index.php');
    }
    $sqlNew = "SELECT * FROM `posts` ORDER BY id LIMIT 10";
    $resultNew = mysqli_query($conn, $sqlNew) or die("Lỗi Truy Vấn fetch" . mysqli_error($conn));
    $posts = [];
    if ($resultNew) {
        while ($num = mysqli_fetch_assoc($resultNew)) {
            $posts[] = $num;
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user'])) {

        $errors = array();
        $data = array();
        $user = $_SESSION['user'];

        if(!empty($_POST['message'])) {
            $data['message'] = $_POST['message'];
        } else {
            $errors[]= "message";
        }

        $data['post_id'] = $id;
        $data['user_id'] = $user['id'];

        if(empty($errors)) {
            $sql = "INSERT INTO `comments`(`user_id`, `post_id`, `message`)
                        VALUES (". $data['user_id'] .", ".$data['post_id'] .", '".$data['message']."')";

            mysqli_query($conn, $sql) or die("Errors  query  insert ----" .mysqli_error($conn));
            $idRow =  mysqli_insert_id($conn);
            if ($idRow) {
                header('Location: detail.php?id='. $id);
            } else {
                $flgErros = true;
            }
        }
    }

    $sqlComment = "SELECT * FROM `comments` INNER JOIN `users` ON comments.user_id = users.id WHERE post_id=". $id;
    $resultComment = mysqli_query($conn, $sqlComment) or die("Lỗi Truy Vấn fetch" . mysqli_error($conn));
    $comments = [];
    if ($resultComment) {
        while ($num = mysqli_fetch_assoc($resultComment)) {
            $comments[] = $num;
        }
    }

?>

<!doctype html>
<html lang="en">
<head>
    <title>The Daily Blog</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="index.php"></i> THE DAILY BLOG </a>
        <ul class="nav">
            <?php if (isset($_SESSION['user'])) : ?>
                <?php $user = $_SESSION['user'] ?>
                <li class="nav-item">
                    <a class="nav-link active" href="">Hello : <?php echo $user['name'] ?></a>
                </li>
                <?php if ($user['user_role']) : ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="/admin/post/index.php">Đăng bài</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link active" href="logout.php">Log out</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link active" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="register.php">Register</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
<div class="jumbotron text-white front">
    <div class="container">
        <h1 class="display-3"></i>News and Life</h1>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <h1><?php echo $post['title'] ?></h1>
            <article class="text-justify">
                <p><?php echo $post['description'] ?></p>
            </article>
            <article class="text-justify" style="margin-bottom: 50px">
                <?php echo $post['contents'] ?>
            </article>
            <hr>
            <div class="comments">
              <h3>Comment: </h3>
                <?php foreach ($comments as $key => $comment) : ?>
                <div class="item-comment">
                    <h2 style="font-size: 15px; margin-left: 0px; font-weight: bold;"><?php echo $comment['name'] ?></h2>
                    <p><?php echo $comment['message'] ?></p>
                </div>
                <?php endforeach; ?>
            </div>

            <?php if (isset($_SESSION['user'])) : ?>
            <div class="col-md-12" style="padding: 0px; margin-top: 50px">
                <form class="form-signin" method="post">
                    <div class="form-group">
                        <label for="num_students">Message</label>
                        <textarea name="message" id="message" class="form-control" cols="30" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Send comment</button>
                    </div>
                </form>
            </div>
            <?php endif; ?>
        </div>
        <div class="col-md-3">
            <?php foreach ($posts as $key => $item) : ?>
            <div class="item-post" style="margin-top: 15px">
                <div class="row">
                    <div class="col-md-4">
                        <a href="detail.php?id=<?= $item['id'] ?>"><img src="../../upload/posts/<?php echo $item['image'] ?>" alt="post img" class="pull-left img-responsive thumb margin10 img-thumbnail img-thumbnail-detail"></a>
                    </div>
                    <div class="col-md-8">
                        <a href="detail.php?id=<?= $item['id'] ?>" style="color: black"><h1 style="font-size: 14px"><?php echo $item['title'] ?></h1></a>
                        <a class="" href="detail.php?id=<?= $item['id'] ?>">Read more</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<footer style="background:black;padding: 1%; color:white; text-align: center;">
    <h4 class="font-weight-thin">Copyright © 2021 Duc Thinh </h4>
</footer>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>
