<?php
    include 'conexion.php';

    $sql = "select * from usuarios";
    $res = $conn->query($sql);
    $rows = array();
    while($r = mysqli_fetch_assoc($res))
    {
        $rows[] = $r;
    }

    header('Content-Type: application/json; charset=utf8');

    echo json_encode($rows, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
?>