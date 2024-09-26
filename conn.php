<?php
$host = 'sql111.infinityfree.com';
$user = 'if0_36967665';
$password = 'O960622scar';
$db = 'if0_36967665_data_share';
$conn = new mysqli($host, $user, $password, $db);
mysqli_query($conn, "set names 'UTF8'");
if (!$conn) {
    throw new Error("fail connect");
}
