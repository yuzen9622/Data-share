<?php
require 'conn.php';
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods:GET, POST, OPTIONS");
header("Access-Control-Allow-Headers:Content-Type");
$file = $_FILES['file'];


if ($file['error'] === 0) {
    $file_name = $file['name'];
    $file_type = $file['type'];
    $file_size = $file['size'];
    $file_datas = "";
    set_time_limit(0);
    if (strpos($file_type, "video") !== false) {
        move_uploaded_file($file['tmp_name'], './video/' . $file_name);
        $file_datas = './video/' . $file_name;
    } else {
        $files = fopen($file['tmp_name'], "rb");
        if ($files) {
            $file_datas = fread($files, filesize($file['tmp_name']));
            if ($file_datas) {
                $file_datas = addslashes($file_datas);
            } else {
                return;
            }
            fclose($files);
        }
    }

    $sql = "insert into `file`(`file_name`,`file_size`,`file_data`,`file_type`) values('$file_name','$file_size','$file_datas','$file_type')";
    $query = mysqli_query($conn, $sql);

    echo $query ? json_encode("upload succseeful") : json_encode("fail upload");
} else {
    echo json_encode("something wrong");
}
