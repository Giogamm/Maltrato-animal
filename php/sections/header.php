<header>
    <nav class="navbar">
        <div class="container">
            <ul class="nav-menu">
                <h1>Maltrato animal</h1>
                <li><a href="index.php" class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'activa' : '' ?>">Inicio</a></li>
                <li><a href="formas-de-maltrato-animal.php" class="<?= basename($_SERVER['PHP_SELF']) == 'formas-de-maltrato-animal.php' ? 'activa' : '' ?>">Formas de maltrato animal</a></li>
                <li><a href="como-ayudar.php" class="<?= basename($_SERVER['PHP_SELF']) == 'como-ayudar.php' ? 'activa' : '' ?>">¿Como ayudar?</a></li>
                <li><a href="poner aqui sobre los animales" class="<?= basename($_SERVER['PHP_SELF']) == 'animales-perdidos.php' ? 'activa' : '' ?>">Animales perdidos</a></li>
                <li><a href="iniciar-sesion.html" class="<?= basename($_SERVER['PHP_SELF']) == 'registrarse.php' ? 'activa': '' ?>">Registrarse o iniciar sesión</a></li>
            </ul>
        </div>
    </nav>
    <div class="empuje"> 
    </div>
</header>