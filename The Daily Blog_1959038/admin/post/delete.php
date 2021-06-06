<?php
    session_start();
    $conn = mysqli_connect("sql309.epizy.com", "epiz_28035304", "z1WwrOjjVntsR", "epiz_28035304_blog") or die ();
    mysqli_set_charset($conn, "utf8");
    $id = $_GET['id'];
    if ($id) {
        $sql = "DELETE FROM `posts` WHERE id = ".$id;
        mysqli_query($conn ,$sql) or die (" Lỗi Truy Vấn delete   --- " .mysqli_error($conn ));
        $check = mysqli_affected_rows($conn);
        if ($check) {
            $_SESSION['success'] = "Delete success !!!";
        } else {
            $_SESSION['errors'] = "Delete errors !!!";
        }
        header('Location: index.php');
    }
?>
