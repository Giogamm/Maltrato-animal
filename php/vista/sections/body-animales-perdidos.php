
    <div class="container">
        <a href="../user.php">
            <img src="../../img/userIcon.svg" alt="" class="user-icon">
        </a>

        <header>
            <a href="../../index.php">
                <img src="../../img/salida.svg" alt="" class="user-icon">
            </a>
            <h1>Animales Perdidos</h1>
            <button id="newPostButton">Realizar una publicación</button>
        </header>
        <div id="sortOptions">
            <label for="sort">Ordenar por:</label>
            <select id="sort">
                <option value="recientes">Más recientes</option>
                <option value="antiguos">Más antiguos</option>
            </select>
        </div>
    
        <div id="postsContainer">
            <?php
            session_start();
                    include '../models/establecerConexión.php';
        
                    $sql = "SELECT usuario_nombre, contacto, descripcion, imagen, fecha_publicacion FROM publicaciones ORDER BY fecha_publicacion DESC";
                    $result = $conn->query($sql);
        
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '<div class="post">';
                            echo '<div class="user-info">';
                            echo '<img src="../../img/person.svg" class="profile-pic" alt="Usuario">'; // Ajusta esta ruta a la imagen de perfil por defecto
                            echo '<div class="user-details">';
                            echo '<h3>' . $row["usuario_nombre"] . '</h3>';
                            echo '<p>Publicado el: ' . $row["fecha_publicacion"] . '</p>';
                            echo '</div></div>';
                            echo '<p class="description">' . $row["descripcion"] . '</p>';
                            echo '<img src="data:image/jpeg;base64,' . base64_encode($row['imagen']) . '" class="animal-pic"/>';
                            echo '<p>Contacto: ' . $row["contacto"] . '</p>';
                            echo '</div>';
                        }
                    } else {
                        echo "<p>No hay publicaciones aún.</p>";
                    }
                    $conn->close();
                    ?>
        </div>
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
 
</body>



</html>