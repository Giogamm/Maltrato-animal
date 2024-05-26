<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Giovany Galeana Memije">
    <meta name="description" content="pagina para ver la tabla de la base de datos">
    <link rel="stylesheet" href="css/tablas-base-datos.css">
    <title>Tabla de la base de datos</title>
</head>
<body>
    <section id="database-section" class="database-section">
        <h1>base de datos</h1>
         <table id="database-table" class="database-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Contraseña</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once 'php/functions/establecerConexión.php';
                $sql = "SELECT * FROM usuarios";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['usuario'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['password'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No hay registros</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
         </table>
    </section>
</body>
</html>