<?php

$ruta = "";

if (strpos($_SERVER['PHP_SELF'], "/admin/") !== false) {
    $ruta = "../";
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sistema de Agendamiento de Citas</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Estilos -->
    <link rel="stylesheet" href="<?php echo $ruta; ?>css/estilos.css">

    <?php

    $pagina = basename($_SERVER["PHP_SELF"]);

    if($pagina == "reservar.php"){
        echo '<link rel="stylesheet" href="'.$ruta.'css/reservar.css">';
    }

    if(strpos($_SERVER["PHP_SELF"], "/admin/") !== false){
        echo '<link rel="stylesheet" href="'.$ruta.'css/admin.css">';
    }

    ?>

</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg shadow">

    <div class="container">

        <a class="navbar-brand fw-bold" href="<?php echo $ruta; ?>index.php">

            <i class="bi bi-calendar-check"></i>

            Agenda de Citas

        </a>

    </div>

</nav>