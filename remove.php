<?php
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods:GET, POST, OPTIONS");
header("Access-Control-Allow-Headers:Content-Type");
require "conn.php";
$content = trim(file_get_contents("php://input"));
$decoded = json_decode($content, true);
$user = $decoded['user'];
$pass = $decoded['pass'];
$file_id = $decoded['file_id'];

if (isset($user) && isset($pass) && $user === "oscar" && $pass === "O48079scar") {
    $sq = "select * from `file` where `id`='$file_id'";
    $q = mysqli_query($conn, $sq);
    $row = $q->fetch_assoc();
    if (strpos($row['file_type'], "video") !== false) {
        unlink($row['file_data']);
    }
    $sql = "delete from `file` where `id`='$file_id'";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        echo json_encode("delete successful");
    }
} else {
    echo json_encode("user or password error!");
}
