<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Giovany Galeana Memije">
    <meta name="description" content="pagina para ver la tabla de la base de datos">

    <link rel="stylesheet" href="../../css/tablas-base-datos.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://bootswatch.com/5/morph/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- sección del modal de actualización de datos -->

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <input type="hidden" id="editId">
                        <div class="mb-3">
                            <label for="editNombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="editNombre">
                        </div>
                        <div class="mb-3">
                            <label for="editCorreo" class="form-label">Correo</label>
                            <input type="email" class="form-control" id="editCorreo">
                        </div>
                        <div class="mb-3">
                            <label for="editContraseña" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="editContraseña">
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- fin de la sección del modal de actualización de datos -->

    <!-- sección del modal de notificación -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 5">
        <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="alert alert-dismissible alert-success">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong class="me-auto">Notificación</strong>
                <div class="toast-body">
                    <!-- Aquí se mostrará el mensaje de la notificación -->
                </div>
            </div>
        </div>
    </div>
    <!-- fin de la sección del modal de notificación -->


    <!-- sección de las tablas -->

    <section id="database-section" class="database-section">
        <h1 class="text-center">Base de datos</h1>
        <div class="table-responsive">
            <table id="database-table" class="table text-center"> <!-- Centra el texto -->
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>Contraseña</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../models/establecerConexión.php';
                    $sql = "SELECT * FROM usuarios";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr id='row" . $row['id'] . "'>";
                            echo "<td class='id'>" . $row['id'] . "</td>";
                            echo "<td class='nombre'>" . $row['nombre'] . "</td>";
                            echo "<td class='correo'>" . $row['correo'] . "</td>";
                            echo "<td class='contraseña'>" . $row['contraseña'] . "</td>";
                            echo "<td>";
                            echo "<button class='btn btn-primary btn-editar me-2 mt-sm-0 mt-1'><i class='fa fa-edit'></i></button>";
                            echo "<button class='btn btn-danger  me-2 mt-sm-0 mt-3'><i class='fa fa-trash'></i></button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <script>
        var myModal = document.getElementById('editModal')
        var modal = new bootstrap.Modal(myModal)
        $(document).ready(function() {
            $(".btn-editar").on("click", function() {
                console.log("Botón de editar clickeado"); //puesto para probar si si funciona el botón
                var row = $(this).closest("tr");
                var id = row.find("td:eq(0)").text();
                var nombre = row.find("td:eq(1)").text();
                var correo = row.find("td:eq(2)").text();
                var contraseña = row.find("td:eq(3)").text();

                $("#editId").val(id);
                $("#editNombre").val(nombre);
                $("#editCorreo").val(correo);
                $("#editContraseña").val(contraseña);

                modal.show();
            });

            $("#editForm").on("submit", function(e) {
                e.preventDefault();

                var id = $("#editId").val();
                var nombre = $("#editNombre").val();
                var correo = $("#editCorreo").val();
                var contraseña = $("#editContraseña").val();

                $.ajax({
                    url: "../controllers/editarUsuario.php",
                    method: "POST",
                    data: {
                        id: id,
                        nombre: nombre,
                        correo: correo,
                        contraseña: contraseña,
                    },
                    success: function(response) {
                        var toastEl = document.getElementById('liveToast');
                        var toast = new bootstrap.Toast(toastEl, {
                            delay: 2000
                        }); // que solo tarde 5 segundos en desaparecer
                        $('.toast-body').text(response);
                        toast.show();
                        $("#row" + id + " .nombre").text(nombre);
                        $("#row" + id + " .correo").text(correo);
                        $("#row" + id + " .contraseña").text(contraseña);
                        modal.hide();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        //manejar los errores desde la consola
                        console.log(textStatus, errorThrown);
                    }
                });
            });
        });
    </script>
    <!-- termina la sección de las tablas -->
    </body>

</html>