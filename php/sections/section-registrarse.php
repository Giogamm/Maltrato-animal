<body>
    <div class="registrarse">
        <form action="../php/iniciar-sesion.php" method="POST">
            <h1>Registrarse</h1>
            <input type="text" name="usuario" placeholder="Usuario" required class="usuario">
            <input type="email" name="correo" placeholder="Correo" class="correo">
            <input type="password" name="contrasena" placeholder="Contraseña" required class="contraseña">
            <input type="submit" value="Registrarse" class="submit">
            <span>¿Ya tiene una cuenta? <a href="iniciar-sesion.php">Iniciar sesión</a></span>
            <h3><a href="../index.php">Regresar</a></h3>
        </form>
    </div>
</body>