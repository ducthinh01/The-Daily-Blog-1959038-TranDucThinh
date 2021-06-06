<?php
    session_start();
    $conn = mysqli_connect("sql309.epizy.com", "epiz_28035304", "z1WwrOjjVntsR", "epiz_28035304_blog") or die ();
    mysqli_set_charset($conn, "utf8");

    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        if ($user['user_role'] != 1) {
            header('Location: index.php');
        }
    }

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
    <title>Admin Blog 2021</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../../style.css">
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
           <div class="row">
               <div class="col-md-12">
                   <?php if (isset($_SESSION['success'])) : ?>
                       <div class="alert alert-success" role="alert">
                           <?php echo $_SESSION['success'] ?>
                       </div>
                   <?php endif; ?>
                   <?php if (isset($_SESSION['errors'])) : ?>
                       <div class="alert alert-danger" role="alert">
                           <?php echo $_SESSION['errors'] ?>
                       </div>
                   <?php endif; ?>
               </div>
           </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Title</th>
                        <th scope="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datas as $key => $item) : ?>
                        <tr>
                            <th scope="row" style="vertical-align: middle"><?php echo $key + 1 ?></th>
                            <td style="vertical-align: middle" width="180">
                                <img src="../../upload/posts/<?php echo $item['image'] ?>" alt="" class="img-thumbnail" style="width: 150px; height: 150px">
                            </td>
                            <td style="vertical-align: middle"><?php echo $item['title'] ?></td>
                            <td style="vertical-align: middle">
                                <a href="update.php?id=<?php echo $item['id'] ?>"><i class="fa fa-edit" ></i></a>
                                <a href="delete.php?id=<?php echo $item['id'] ?>"><i class="fa fa-trash" ></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>

<?php
    unset($_SESSION['success']);
    unset($_SESSION['errors'])
?>
