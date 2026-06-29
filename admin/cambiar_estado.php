<?php

include("../conexion/conexion.php");

if(isset($_GET["id"]) && isset($_GET["estado"])){

    $id = intval($_GET["id"]);

    $estado = $_GET["estado"];

    $permitidos = ["Pendiente","Confirmada","Finalizada","Cancelada"];

    if(in_array($estado,$permitidos)){

        $sql = "UPDATE citas
                SET estado=?
                WHERE id=?";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param("si",$estado,$id);

        $stmt->execute();

    }

}

header("Location: ver_cita.php?id=".$id);

exit();

?>