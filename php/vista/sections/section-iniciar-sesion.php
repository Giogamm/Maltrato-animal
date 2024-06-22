<body>
    <div class="registrarse">

        <h1>Iniciar sesión</h1>
        <form id="loginForm" action="../controllers/login.php" method="post">
            <input type="text" name="usuario" placeholder="Usuario" required class="usuario">
            <input type="password" name="contraseña" placeholder="Contraseña" required class="contraseña">
            <input type="submit" value="Iniciar sesión" class="submit-sesion" id="iniciar-sesion">
            <span>¿no tienes cuenta? <a href="registrarse.php">registrate</a></span>
            <p id="noti" class="noti">hola</p>
        </form>
        <h3><a href="../../index.php">Regresar</a></h3>
    </div>

    <script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(e) {
                e.preventDefault(); // Prevenir el comportamiento de envío por defecto

                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(), // Serializa los datos del formulario para enviar
                    success: function(response) {
                        // Aquí manejas la respuesta. Por ejemplo, mostrar un mensaje
                        $('#noti').show().html('Has ingresado con éxito');
                        setTimeout(function() {
                            location.href = '../../index.php'; // Redirige si es necesario
                        }, 2000);
                    },
                    error: function() {
                        // Manejo de errores
                        $('#noti').show().css({
                            color: '#ffffff',
                            backgroundColor: '#811d1d'
                        }).html('El usuario o contraseña es incorrecta');
                    }
                });
            });
        });
    </script>
</body>


