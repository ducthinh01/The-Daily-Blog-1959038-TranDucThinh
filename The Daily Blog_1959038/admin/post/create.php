<?php
    $flgErros = false;
    include_once ('../../function.php');
    $conn = mysqli_connect("sql309.epizy.com", "epiz_28035304", "z1WwrOjjVntsR", "epiz_28035304_blog") or die ();
    mysqli_set_charset($conn, "utf8");

    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        if ($user['user_role'] != 1) {
            header('Location: index.php');
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $errors = array();
        $data = array();

        if(!empty($_POST['title'])) {
            $data['title'] = $_POST['title'];
        } else {
            $errors[]= "title";
        }

        if(!empty($_POST['description'])) {
            $data['description'] = $_POST['description'];
        } else {
            $errors[]= "description";
        }

        if(!empty($_POST['contents'])) {
            $data['contents'] = $_POST['contents'];
        } else {
            $errors[]= "contents";
        }

        if ($_FILES) {

            $data['image'] =  uploadImage($_FILES, 'posts');
        } else {
            $data['image'] = "";
        }

        if(empty($errors)) {
            $sql = "INSERT INTO `posts`(`title`, `description`, `image`, `contents`)
                        VALUES ('". $data['title'] ."', '".$data['description'] ."', '".$data['image']."', '". $data['contents'] ."')";
            mysqli_query($conn, $sql) or die("Errors  query  insert ----" .mysqli_error($conn));
            $idRow =  mysqli_insert_id($conn);
            if ($idRow) {
                header('Location: index.php');
            } else {
                $flgErros = true;
            }
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <title>Admin Blog 2021</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../../style.css">
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
</head>
<body>
<div class="row" style="margin: 0px;">
    <div class="col-md-3">
        <div class="parent">
            <div class="main">
                <div class="list">
                    <h2>Category List</h2>
                    <ul>
                        <li><a href="/admin/post/index.php">Posts</a></li>
                        <li><a href="/admin/user/index.php">Users</a></li>
                        <li><a href="../../logout.php">Logout</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-12">
                <a href="/admin/post/create.php" class="btn btn-primary " style="margin: 15px 0px; float: right"> Add Post</a>
            </div>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="university">Tile</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Tile" required>
                </div>
                <div class="form-group">
                    <label for="therank">Description</label>
                    <input type="text" class="form-control" name="description" id="description" placeholder="Description" required>
                </div>

                <div class="form-group">
                    <label for="img_url">Image</label>
                    <input type="file" class="form-control" name="image" id="image" >
                </div>
                <div class="form-group">
                    <label for="num_students">Contents</label>
                    <textarea name="contents" id="contents" class="form-control" cols="30" rows="10"></textarea>
                    <script>
                        CKEDITOR.replace('contents');
                    </script>
                </div>
                <button type="submit" class="btn btn-dark" style="margin-bottom: 15px">Add Post</button>
            </div>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>
