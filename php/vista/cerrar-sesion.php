<?php
session_start(); // Inicia la sesión
session_unset(); // Libera todas las variables de sesión
session_destroy(); // Destruye la sesión

header("Location: ../../index.php"); // Redirige al usuario a la página principal
exit();
