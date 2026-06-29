<?php

include("../conexion/conexion.php");
include("../includes/header.php");

$sql = "SELECT
            citas.id,
            clientes.nombre,
            clientes.telefono,
            servicios.nombre AS servicio,
            citas.fecha,
            citas.hora,
            citas.estado
        FROM citas

        INNER JOIN clientes
        ON citas.cliente_id = clientes.id

        INNER JOIN servicios
        ON citas.servicio_id = servicios.id

        ORDER BY citas.fecha ASC, citas.hora ASC";

$resultado = mysqli_query($conn, $sql);

?>

<div class="container py-5">

    <h2 class="mb-4 text-center">
        Panel de Administración
    </h2>

    <div class="row mb-4">

        <div class="col-md-6">

            <input
                type="text"
                id="buscar"
                class="form-control"
                placeholder="Buscar por nombre o teléfono">

        </div>

    </div>

    <div class="table-responsive">

        <table class="table table-hover table-bordered align-middle" id="tablaCitas">

            <thead>

                <tr>

                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Cliente</th>
                    <th>Servicio</th>
                    <th>Estado</th>
                    <th>Teléfono</th>
                    <th>Acción</th>

                </tr>

            </thead>

            <tbody>

            <?php while($fila = mysqli_fetch_assoc($resultado)){ ?>

                <tr>

                    <td><?= date("d/m/Y", strtotime($fila["fecha"])) ?></td>

                    <td><?= date("g:i A", strtotime($fila["hora"])) ?></td>

                    <td><?= htmlspecialchars($fila["nombre"]) ?></td>

                    <td><?= htmlspecialchars($fila["servicio"]) ?></td>

                    <td>

                        <?php

                        switch($fila["estado"]){

                            case "Pendiente":
                                echo '<span class="badge bg-warning text-dark">Pendiente</span>';
                                break;

                            case "Confirmada":
                                echo '<span class="badge bg-success">Confirmada</span>';
                                break;

                            case "Finalizada":
                                echo '<span class="badge bg-primary">Finalizada</span>';
                                break;

                            case "Cancelada":
                                echo '<span class="badge bg-danger">Cancelada</span>';
                                break;

                            default:
                                echo $fila["estado"];

                        }

                        ?>

                    </td>

                    <td><?= htmlspecialchars($fila["telefono"]) ?></td>

                    <td>

                        <a
                            href="ver_cita.php?id=<?= $fila['id']; ?>"
                            class="btn btn-sm btn-spa">

                            Ver

                        </a>

                    </td>

                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

<?php include("../includes/footer.php"); ?>