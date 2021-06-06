<?php
    if (!function_exists('uploadImage')) {
        function uploadImage( $data, $folder ="",$action =" ")
        {
            if(isset($_FILES['image'])) {

                $allowed = array('image/jpeg', 'image/jpg', 'image/png', 'images/x-png');
                if(in_array(($_FILES['image']['type']), $allowed)) {

                    if(move_uploaded_file($_FILES['image']['tmp_name'], "../../upload/".$folder."/".$_FILES['image']['name'])) {

                    } else {

                        return true;
                    }
                } else {
                    $_SESSION['error'] = "Lỗi không thể up load ảnh (file ảnh bạn úp lên không thuộc định dạng cho phép ).";
                    return false;
                }
            }
            if(isset($_FILES['image']['tmp_name']) && is_file($_FILES['image']['tmp_name']) && file_exists($_FILES['image']['tmp_name']))
            {
                unlink($_FILES['image']['tmp_name']);
            }

            return  $_FILES['image']['name'];

        }
    }
