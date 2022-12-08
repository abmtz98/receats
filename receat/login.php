<?php
    include 'conexion.php';

    $data = $_POST['userData'];
    $sql = "select usuario,passw from usuarios where usuario = ".$data['usuario']." and passw =".$data['passw']."";
    $res = $conn->query($sql);
    $rows = array();
    while($r = mysqli_fetch_assoc($res))
    {
        $rows[] = $r;
    }

    header('Content-Type: application/json; charset=utf8');

    echo json_encode($rows, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
?>