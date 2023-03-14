<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BD Documentales</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1 class="display-4 mt-5 mb-4 text-center">Bases de Datos Documentales</h1>
        <div class="d-flex justify-content-center mb-4">
            <a href="subirarchivo.php" class="btn btn-primary">Agregar Libro</a>
        </div>
        <form class="mb-4" action="" method="post" name="frmbuscador" id="frmbuscador">
            <div class="row">
                <div class="col-sm-8 col-md-6 mx-auto">
                    <div class="input-group">
                        <input type="text" class="form-control" id="inputTxt" name="inputTxt" required>
                        <button class="btn btn-primary" type="submit" id="btnbuscador" name="btnbuscador">Buscar</button>
                    </div>
                </div>
            </div>
        </form>


<?php if (isset($_POST['btnbuscador'])) {
    $valorabuscar = $_POST['inputTxt'];
    //Conexion al Sevidor y a la Base de datos...
    include 'php/conexion.php';
    $linkConexion = conection();

    $sql = "SELECT * FROM detalles_informacion d INNER JOIN informacion i ON i.idinformacion= d.idinformacion WHERE nombrelibro LIKE '%$valorabuscar%'";
    $resultados = mysqli_query($linkConexion, $sql);
    echo '<h5 class="text-center">Resultados obtenidos:</h5>';
    echo '<table class="table table-striped table-hover">';
    echo '<thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Libro</th>
                    <th scope="col">Link</th>
                </tr>
            </thead>
            <tbody>';
    while ($row = mysqli_fetch_array($resultados)) {
        $idinf = $row['idinformacion'];
        $inf = $row['nombrelibro'];
        $inflink = $row['fecha'];
        echo '<tr>';
        echo '<td>' . $idinf . '</td>';
        echo '<td>' . $inf . '</td>';
        echo '<td><a href="archivos/' .
            $inflink .
            '" target="_blank">' .
            $inflink .
            '</a></td>';
        echo '</tr>';
    }
    echo '</tbody></table>';

    //Cerramos la Conexion a la BD
    mysqli_close($linkConexion);
} ?>
    
    </div>
    <!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-T5kKUpvZG8QrVOe7H2LeB2VPgO9jKt0pL7MLJyyLHaOPon/qwY0KdKpQR1Pe6GYb" crossorigin="anonymous"></script>
</body>
</html>