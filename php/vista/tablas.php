<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Giovany Galeana Memije">
    <meta name="description" content="Página para ver la tabla de la base de datos">
    <title>Tabla de las bases de datos</title>

    <link rel="stylesheet" href="../../css/tablas-base-datos.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://bootswatch.com/5/morph/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <section id="database-section" class="database-section">
        <a href="../../index.php" class="btn btn-primary position-absolute top-0 start-0 m-1">Regresar</a>
        <h1 class="text-center mt-3" style="margin-left: 3rem;">Base de datos</h1>

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
                                <input type="text" class="form-control" id="editNombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="editCorreo" class="form-label">Correo</label>
                                <input type="email" class="form-control" id="editCorreo" required>
                            </div>
                            <div class="mb-3">
                                <label for="editContraseña" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="editContraseña" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- fin de la sección del modal de actualización de datos -->

        <!-- sección de notificación de edición de base de datos -->
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
        <!-- fin de la sección de notificación de edición de base de datos -->

        <!-- sección de notificación de eliminación -->
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 5">
            <div id="deleteToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Notificación</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body">
                    <!-- Aquí se mostrará el mensaje de la notificación -->
                </div>
            </div>
        </div>
        <!-- fin de la sección de notificación de eliminación -->

        <!-- sección del modal de confirmar la eliminación -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirmar eliminación</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Alerta personalizada -->
                        <div class="alert alert-dismissible alert-danger d-none" id="deleteErrorAlert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <strong>¡Oh no!</strong> <span id="deleteErrorMessage">Ha ocurrido un error. Inténtalo de nuevo.</span>
                        </div>
                        ¿Estás seguro de que quieres eliminar el registro con ID <span id="deleteId"></span>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="confirmDelete">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- fin de la sección del modal de confirmar la eliminación -->

        <!-- sección de las tablas -->
        <div class="table-responsive">
            <table id="database-table" class="table text-center">
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
                            echo "<button class='btn btn-primary btn-editar me-2 mt-sm-0 mt-1' style='transition: transform 0.3s ease-in-out;'><i class='fa fa-edit'></i></button>";
                            echo "<button class='btn btn-danger btn-eliminar me-2 mt-sm-0 mt-3' style='transition: transform 0.3s ease-in-out;'><i class='fa fa-trash'></i></button>";
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
        $(document).ready(function() {
            var editModal = new bootstrap.Modal(document.getElementById('editModal'));
            var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));

            $(".btn-editar").on("click", function() {
                var row = $(this).closest("tr");
                var id = row.find("td:eq(0)").text();
                var nombre = row.find("td:eq(1)").text();
                var correo = row.find("td:eq(2)").text();
                var contraseña = row.find("td:eq(3)").text();

                $("#editId").val(id);
                $("#editNombre").val(nombre);
                $("#editCorreo").val(correo);
                $("#editContraseña").val(contraseña);

                editModal.show();
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
                        contraseña: contraseña
                    },
                    success: function(response) {
                        var toastEl = document.getElementById('liveToast');
                        var toast = new bootstrap.Toast(toastEl, {
                            delay: 2000
                        });
                        $('.toast-body').text(response);
                        toast.show();
                        $("#row" + id + " .nombre").text(nombre);
                        $("#row" + id + " .correo").text(correo);
                        $("#row" + id + " .contraseña").text(contraseña);
                        editModal.hide();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            });

            $(".btn-eliminar").on("click", function() {
                var row = $(this).closest("tr");
                var id = row.find("td:eq(0)").text();

                $("#deleteId").text(id);
                deleteModal.show();

                $("#confirmDelete").off("click").on("click", function() {
                    $.ajax({
                        url: "../controllers/eliminarUsuario.php",
                        method: "POST",
                        data: {
                            id: id
                        },
                        success: function(response) {
                            row.remove();
                            var toastEl = document.getElementById('deleteToast');
                            var toast = new bootstrap.Toast(toastEl, {
                                delay: 2000
                            });
                            $('.toast-body').text("usuario eliminado correctamente");
                            toast.show();
                            deleteModal.hide();
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            $("#deleteErrorMessage").text("Ha ocurrido un error. Inténtalo de nuevo.");
                            $("#deleteErrorAlert").removeClass("d-none");
                            console.log(textStatus, errorThrown);
                        }
                    });
                });
            });
        });
    </script>
</body>

</html>