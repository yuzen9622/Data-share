<?php
require "conn.php";
$id = $_GET['file_id'];
$sql = "select * from `file` where id='$id'";
$query = mysqli_query($conn, $sql);
$num = mysqli_num_rows($query);
if ($num < 1) die("error");
$row = $query->fetch_assoc();
$name = $row['file_name'];
$data = $row['file_data'];
$type = $row['file_type'];
$size = $row['file_size'];

header("Content-Type:application/octet-stream");
header("Content-Disposition: attachment; filename=$name"); // 设置文件名称
header("Content-Length: " . $size);
echo $data;
