<?php
include("conexion/conexion.php");

// Consulta de los servicios
$consulta = "SELECT * FROM servicios ORDER BY id";
$servicios = mysqli_query($conn, $consulta);

include("includes/header.php");
?>

<link rel="stylesheet" href="css/reservar.css">

<main>

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow">

                <!-- Encabezado -->
                <div class="card-header-spa">

                    <h2>Agenda tu cita</h2>

                    <p class="mb-0 text-white">
                        Reserva tu espacio en pocos minutos
                    </p>

                </div>

                <!-- Formulario -->
                <div class="card-body p-5">

                    <form action="guardar.php" method="POST">

                        <!-- Nombre -->
                        <div class="mb-3">

                            <label class="form-label">
                                Nombre completo
                            </label>

                            <input
                                type="text"
                                name="nombre"
                                class="form-control"
                                placeholder="Escribe tu nombre completo"
                                required>

                        </div>

                        <!-- Teléfono -->
                        <div class="mb-3">

                            <label class="form-label">
                                Teléfono
                            </label>

                            <input
                                type="text"
                                name="telefono"
                                class="form-control"
                                placeholder="Número de teléfono"
                                required>

                        </div>

                        <!-- Servicio -->
                        <div class="mb-3">

                            <label class="form-label">
                                Servicio
                            </label>

                            <select name="servicio" class="form-select" required>

                                <option value="">
                                    Selecciona un servicio
                                </option>

                                <?php while($fila = mysqli_fetch_assoc($servicios)){ ?>

                                    <option value="<?php echo $fila['id']; ?>">

                                        <?php echo $fila['nombre']; ?>

                                    </option>

                                <?php } ?>

                            </select>

                        </div>

                        <!-- Fecha y hora -->
                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Fecha
                                </label>
                                <input
							    type="date"
							    name="fecha"
							    class="form-control"
							    min="<?php echo date('Y-m-d'); ?>"
							    required>
							    <small class="text-muted">
								    Horario de atención: lunes a sábado.
								</small>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Hora
                                </label>

                                <select
                                    name="hora"
                                    class="form-select"
                                    required>

                                    <option value="08:00">08:00 AM</option>
                                    <option value="10:00">10:00 AM</option>
                                    <option value="13:00">01:00 PM</option>
                                    <option value="15:00">03:00 PM</option>
                                    <option value="17:00">05:00 PM</option>

                                </select>

                            </div>

                        </div>

                        <!-- Observaciones -->
                        <div class="mb-4">

                            <label class="form-label">
                                Observaciones
                            </label>

                            <textarea
                                name="observaciones"
                                class="form-control"
                                rows="4"
                                placeholder="Información adicional (opcional)"></textarea>

                        </div>

                        <!-- Botón -->
                        <div class="d-grid">

                            <button
                                type="submit"
                                class="btn btn-reservar">

                                Reservar cita

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</main>

<?php include("includes/footer.php"); ?>