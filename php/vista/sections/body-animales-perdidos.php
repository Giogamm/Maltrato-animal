

<body>
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
        <div id="postsContainer"></div> <!-- Se dejará este espacio para cargar las publicaciones desde JavaScript -->
    </div>

    <!-- Modal para nueva publicación -->
    <div id="postModal" class="modal hidden">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Nueva Publicación</h2>
            <form id="postForm" action="../controllers/publicaciones.php" method="POST" enctype="multipart/form-data">
                <label for="contactNumber">Número de contacto:</label>
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
