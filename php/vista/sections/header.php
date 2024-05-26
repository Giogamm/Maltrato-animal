<?php
$rutaBase = (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'php/vista/' : '';
?>

<header>
    <nav class="navbar">
        <div class="container">
            <ul class="nav-menu">
                <h1>Maltrato animal</h1>
                <li><a href="../../index.php" class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'activa' : '' ?>">Inicio</a></li>
                <li><a href="<?= $rutaBase ?>formas-de-maltrato-animal.php" class="<?= basename($_SERVER['PHP_SELF']) == 'formas-de-maltrato-animal.php' ? 'activa' : '' ?>">Formas de maltrato animal</a></li>
                <li><a href="<?= $rutaBase ?>como-ayudar.php" class="<?= basename($_SERVER['PHP_SELF']) == 'como-ayudar.php' ? 'activa' : '' ?>">¿Como ayudar?</a></li>
                <li><a href="<?= $rutaBase ?>animales-perdidos.php" class="<?= basename($_SERVER['PHP_SELF']) == 'animales-perdidos.php' ? 'activa' : '' ?>">Animales perdidos</a></li>
                <li><a href="<?= $rutaBase ?>registrarse.php" class="<?= basename($_SERVER['PHP_SELF']) == 'registrarse.php' ? 'activa' : '' ?>">Registrarse o iniciar sesión</a></li>
                <li><a href="<?= $rutaBase ?>tablas.php" class="<?= basename($_SERVER['PHP_SELF']) == 'tablas.php' ? 'activa' : '' ?>">Tablas-test</a></li>
            </ul>
        </div>
    </nav>
    <div class="empuje">
    </div>
</header>