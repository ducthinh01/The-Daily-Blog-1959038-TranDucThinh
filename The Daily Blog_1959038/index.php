<?php
    session_start();
    $conn = mysqli_connect("sql309.epizy.com", "epiz_28035304", "z1WwrOjjVntsR", "epiz_28035304_blog") or die ();
    mysqli_set_charset($conn, "utf8");

    $sql = "SELECT * FROM `posts`";
    $result = mysqli_query($conn, $sql) or die("Lỗi Truy Vấn fetch" .mysqli_error($conn));

    $datas = [];
    if( $result)
    {
        while ($num = mysqli_fetch_assoc($result))
        {
            $datas[] = $num;
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <title>The Daily Blog 2021</title>
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
                        <a class="nav-link active" href="/admin/post/index.php">Post Management</a>
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
            <h1 class="display-3"></i> News and Life </h1>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php foreach ($datas as $key => $item) : ?>
                <div class="row item-post" style="margin-bottom: 15px">
                    <div class="col-md-4">
                        <a href="detail.php?id=<?= $item['id'] ?>"><img src="../../upload/posts/<?php echo $item['image'] ?>" alt="post img" class="pull-left img-responsive thumb margin10 img-thumbnail img-thumbnail-home"></a>
                    </div>
                    <div class="col-md-8">
                        <a href="detail.php?id=<?= $item['id'] ?>" style="color: black"><h1 class="title-post"><?php echo $item['title'] ?></h1></a>
                        <article class="text-justify">
                            <p><?php echo $item['description'] ?></p>
                        </article>
                        <a class="" href="detail.php?id=<?= $item['id'] ?>">Read more</a>
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
