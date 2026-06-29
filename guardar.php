<?php

include("conexion/conexion.php");

// Verificar que el formulario fue enviado por POST
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: reservar.php");
    exit();
}

// Obtener datos del formulario
$nombre = trim($_POST["nombre"]);
$telefono = trim($_POST["telefono"]);
$servicio = $_POST["servicio"];
$fecha = $_POST["fecha"];
$hora = $_POST["hora"];
$observaciones = trim($_POST["observaciones"]);


// Validar que la fecha no sea anterior a hoy
$hoy = date("Y-m-d");

if ($fecha < $hoy) {

    echo "
    <script>
        alert('No puedes reservar una fecha anterior al día de hoy.');
        window.history.back();
    </script>
    ";

    exit();

}


// Validar que no sea domingo
$diaSemana = date("w", strtotime($fecha));

if ($diaSemana == 0) {

    echo "
    <script>
        alert('No atendemos los domingos. Selecciona otro día.');
        window.history.back();
    </script>
    ";

    exit();

}

// Verificar si el horario ya está ocupado
$sql = "SELECT id
        FROM citas
        WHERE fecha = ?
        AND hora = ?
        AND estado <> 'Cancelada'";

$stmt = $conn->prepare($sql);

$stmt->bind_param("ss", $fecha, $hora);

$stmt->execute();

$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {

    echo "
    <script>
        alert('Lo sentimos, ese horario ya está ocupado.');
        window.history.back();
    </script>
    ";

    exit();

}

$stmt->close();

// Buscar si el cliente ya existe por teléfono
$sqlBuscar = "SELECT id FROM clientes WHERE telefono = ?";

$stmt = $conn->prepare($sqlBuscar);

$stmt->bind_param("s", $telefono);

$stmt->execute();

$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {

    $cliente = $resultado->fetch_assoc();

    $cliente_id = $cliente["id"];

} else {

    $stmt->close();

    $sqlCliente = "INSERT INTO clientes (nombre, telefono)
                   VALUES (?, ?)";

    $stmt = $conn->prepare($sqlCliente);

    $stmt->bind_param("ss", $nombre, $telefono);

    $stmt->execute();

    $cliente_id = $conn->insert_id;

}

$stmt->close();


// 2. Guardar la cita
$sqlCita = "INSERT INTO citas
(cliente_id, servicio_id, fecha, hora, observaciones, estado)
VALUES (?, ?, ?, ?, ?, 'Pendiente')";

$stmt = $conn->prepare($sqlCita);
$stmt->bind_param(
    "iisss",
    $cliente_id,
    $servicio,
    $fecha,
    $hora,
    $observaciones
);

if ($stmt->execute()) {

    echo "
    <script>
        alert('¡Tu cita fue agendada correctamente!');
        window.location='index.php';
    </script>
    ";

} else {

    echo "
    <script>
        alert('Ocurrió un error al guardar la cita.');
        window.history.back();
    </script>
    ";

}

$stmt->close();
$conn->close();

?>