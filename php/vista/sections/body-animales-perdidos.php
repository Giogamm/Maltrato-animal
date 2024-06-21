<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../models/establecerConexión.php';

// Obtener la foto de perfil actual del usuario logueado
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$currentPhoto = '';
if ($username) {
    $sql = "SELECT foto_perfil FROM usuarios WHERE nombre='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentPhoto = base64_encode($row['foto_perfil']);
    }
}
?>

<div class="container">
    <a href="user.php">
        <?php
        if ($currentPhoto) {
            echo '<img src="data:image/jpeg;base64,' . $currentPhoto . '" alt="Foto de Perfil" class="user-icon">';
        } else {
            echo '<img src="../../img/userIcon.svg" alt="Foto de Perfil" class="user-icon">'; // Imagen de perfil por defecto
        }
        ?>
    </a>

    <header>
        <a href="../../index.php">
            <img src="../../img/salida.svg" alt="" class="user-icon">
        </a>
        <h1>Animales Perdidos</h1>
        <button id="newPostButton">Realizar una publicación</button>
    </header>

    <!-- Notificaciones -->
    <?php
    if (isset($_SESSION['success_message'])) {
        echo '<div class="alert">' . $_SESSION['success_message'] . '</div>';
        unset($_SESSION['success_message']);
    }
    if (isset($_SESSION['error_message'])) {
        echo '<div class="error">' . $_SESSION['error_message'] . '</div>';
        unset($_SESSION['error_message']);
    }
    ?>

    <div id="sortOptions">
        <label for="sort">Ordenar por:</label>
        <select id="sort" onchange="sortPosts()">
            <option value="recientes" <?= isset($_GET['order']) && $_GET['order'] == 'recientes' ? 'selected' : '' ?>>Más recientes</option>
            <option value="antiguos" <?= isset($_GET['order']) && $_GET['order'] == 'antiguos' ? 'selected' : '' ?>>Más antiguos</option>
        </select>
    </div>

    <div id="postsContainer">
        <?php
        $order = isset($_GET['order']) ? $_GET['order'] : 'recientes';
        $orderQuery = $order === 'antiguos' ? 'ORDER BY fecha_publicacion ASC' : 'ORDER BY fecha_publicacion DESC';
        $query = "SELECT p.usuario_nombre, p.contacto, p.descripcion, p.imagen, p.fecha_publicacion, u.foto_perfil 
                  FROM publicaciones p 
                  JOIN usuarios u ON p.usuario_nombre = u.nombre 
                  $orderQuery";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            // Salida de datos para cada fila
            while ($row = $result->fetch_assoc()) {
                $dateTime = new DateTime($row['fecha_publicacion']);
                $formattedDate = $dateTime->format('d-m-y h:i A');
                $profilePhoto = $row['foto_perfil'] ? 'data:image/jpeg;base64,' . base64_encode($row['foto_perfil']) : '../../img/person.svg';
                echo "<div class='post'>";
                echo "<div class='user-info'>";
                echo '<img src="' . $profilePhoto . '" class="profile-pic" alt="Usuario">';
                echo "<div class='user-details'>";
                echo "<h3>{$row['usuario_nombre']}</h3>";
                echo "<p>Publicado el: {$formattedDate}</p>";
                echo "</div>";  // Close user-details
                echo "</div>";  // Close user-info
                echo "<img src='data:image/jpeg;base64," . base64_encode($row['imagen']) . "' alt='Animal Picture' class='animal-pic'>";
                echo "<p class='description'>{$row['descripcion']}</p>";
                echo "</div>";  // Close post
            }
        } else {
            echo "No hay publicaciones.";
        }

        $conn->close();
        ?>
    </div>
</div>

<!-- Modal para nueva publicación -->
<div id="postModal" class="modal hidden">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Nueva Publicación</h2>
        <form id="postForm" action="../controllers/publicaciones.php" method="POST" enctype="multipart/form-data">
            <label for="contactNumber">Número de contacto o gmail:</label>
            <input type="text" id="contactNumber" name="contactNumber" required>
            <label for="animalPhoto">Foto del animal:</label>
            <input type="file" id="animalPhoto" name="animalPhoto" accept="image/*" required>
            <label for="description">Descripción:</label>
            <textarea id="description" name="description" required></textarea>
            <button type="submit">Publicar</button>
        </form>
    </div>
</div>

<script src="../controllers/script.js"></script>
<script>
    function sortPosts() {
        const sortValue = document.getElementById('sort').value;
        window.location.href = 'animales-perdidos.php?order=' + sortValue;
    }
</script>

</html>