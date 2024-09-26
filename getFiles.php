<?php
require "conn.php";

header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods:GET, POST, OPTIONS");
header("Access-Control-Allow-Headers:Content-Type");
$sql = "select * from `file`";

$query = mysqli_query($conn, $sql);
if (!$query) return json_decode("no files");
$res = array();

while ($row = $query->fetch_assoc()) {
    array_push(
        $res,
        [
            'id' => $row['id'],
            'file_name' => $row['file_name'],
            'file_size' => $row['file_size']
        ]

    );
}
$json = $res != null ? [
    'ok' => true,
    'data' => $res

] : [
    'ok' => false
];

echo json_encode($json);
