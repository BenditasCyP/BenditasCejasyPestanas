<?php

include("../conexion/conexion.php");
include("../includes/header.php");

if(!isset($_GET["id"])){

    header("Location: index.php");
    exit();

}

$id = intval($_GET["id"]);

$sql = "SELECT

            citas.id,
            citas.fecha,
            citas.hora,
            citas.observaciones,
            citas.estado,

            clientes.nombre,
            clientes.telefono,

            servicios.nombre AS servicio

        FROM citas

        INNER JOIN clientes
            ON citas.cliente_id = clientes.id

        INNER JOIN servicios
            ON citas.servicio_id = servicios.id

        WHERE citas.id = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("i",$id);

$stmt->execute();

$resultado = $stmt->get_result();

$cita = $resultado->fetch_assoc();

if(!$cita){

    echo "<div class='container py-5'><h3>Cita no encontrada.</h3></div>";

    include("../includes/footer.php");

    exit();

}

?>

<div class="container py-5">

    <div class="card shadow">

        <div class="card-header text-white" style="background:#735355;">

            <h3 class="mb-0">Detalle de la cita</h3>

        </div>

        <div class="card-body">

            <p><strong>Cliente:</strong> <?= htmlspecialchars($cita["nombre"]) ?></p>

            <p><strong>Teléfono:</strong> <?= htmlspecialchars($cita["telefono"]) ?></p>

            <p><strong>Servicio:</strong> <?= htmlspecialchars($cita["servicio"]) ?></p>

            <p><strong>Fecha:</strong> <?= date("d/m/Y",strtotime($cita["fecha"])) ?></p>

            <p><strong>Hora:</strong> <?= date("g:i A",strtotime($cita["hora"])) ?></p>

            <p><strong>Observaciones:</strong><br>

                <?= nl2br(htmlspecialchars($cita["observaciones"])) ?>

            </p>

            <hr>

            <h5>Estado actual</h5>

<?php

switch($cita["estado"]){

    case "Pendiente":
        echo '<span class="badge bg-warning text-dark fs-6">Pendiente</span>';
        break;

    case "Confirmada":
        echo '<span class="badge bg-success fs-6">Confirmada</span>';
        break;

    case "Finalizada":
        echo '<span class="badge bg-primary fs-6">Finalizada</span>';
        break;

    case "Cancelada":
        echo '<span class="badge bg-danger fs-6">Cancelada</span>';
        break;

}

?>

<hr>

<div class="d-flex flex-wrap gap-2">

<a href="cambiar_estado.php?id=<?= $cita['id']; ?>&estado=Confirmada"
class="btn btn-success">

Confirmar

</a>

<a href="cambiar_estado.php?id=<?= $cita['id']; ?>&estado=Finalizada"
class="btn btn-primary">

Finalizar

</a>

<a href="cambiar_estado.php?id=<?= $cita['id']; ?>&estado=Cancelada"
class="btn btn-danger">

Cancelar

</a>

<a href="index.php"
class="btn btn-secondary">

Volver

</a>

</div>

            <hr>

            <a href="index.php" class="btn btn-secondary">

                Volver

            </a>

        </div>

    </div>

</div>

<?php include("../includes/footer.php"); ?>