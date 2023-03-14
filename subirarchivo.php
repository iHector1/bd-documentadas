<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Archivo</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

    <?php if (isset($_POST['subearchivo'])) {
        $nlibro = $_POST['txtlibro'];

        //Conexion al Sevidor y a la Base de datos...
        include 'php/conexion.php';
        $linkConexion = conection();

        //Consultamos el mayor id para sumar uno
        $Sql = 'SELECT MAX(idinformacion) AS mayor FROM informacion';
        $resultados = mysqli_query($linkConexion, $Sql);
        $row = mysqli_fetch_array($resultados);
        $idmayor = $row['mayor'] + 1; //Sumamos uno al id mayor

        //Tomamos el Archivo que viene por el POST ...
        $pdf_libro = $_FILES['archivopdf']['tmp_name'];
        $pdf_Tam_Libro = $_FILES['archivopdf']['size'];

        $nuevoNombre_Libro = 'libro_' . $idmayor . '.pdf';
        //Movemos el Archivo a la ruta especificada ...
        $Libro_pdf = 'archivos/' . $nuevoNombre_Libro;

        //Insertamos los datos en la tabla ...
        $Sql = "INSERT INTO `informacion` (idinformacion, activo, fecha) VALUES ($idmayor, 1, NOW());";
        $resultados = mysqli_query($linkConexion, $Sql);
        $Sql = "INSERT INTO detalles_informacion(idinformacion, nombrelibro) VALUES('$idmayor', '$nuevoNombre_Libro')";
        $resultados = mysqli_query($linkConexion, $Sql);

        //Se mueve el archivo al Servidor ...
        move_uploaded_file($pdf_libro, $Libro_pdf);

        //Cerramos la Conexion a la BD
        mysqli_close($linkConexion);
    } ?>

    <div class="container mt-5">
    <div class="d-flex justify-content-center">
  <div class="card col-md-6">
    <div class="card-header text-center">
      <h3>Agregar libro</h3>
    </div>
    <div class="card-body">
     
      <form action="" method="POST" id="formulario" name="formulario" enctype="multipart/form-data">
        <div class="form-group row mx-3">
          <label for="txtlibro" class="col-sm-3 col-form-label">Libro *</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="txtlibro" name="txtlibro" placeholder="Escribe el nombre del libro" required>
          </div>
        </div>
        <div class="form-group row mx-3 mt-3">
          <label for="archivopdf" class="col-sm-3 col-form-label">Archivo *</label>
          <div class="col-sm-9">
            <input type="file" accept="application/pdf" class="form-control-file" id="archivopdf" name="archivopdf" required>
          </div>
        </div>
        <div class="form-group row mx-3 mt-3">
          <div class="col-sm-3">
            <button type="submit" class="btn btn-success" id="subearchivo" name="subearchivo">Subir Archivo</button> 
          </div>
          <div class="col-sm-3">
            <a href="index.php" class="btn btn-primary mb-3">Regresar</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-T5kKUpvZG8QrVOe7H2LeB2VPgO9jKt0pL7MLJyyLHaOPon/qwY0KdKpQR1Pe6GYb" crossorigin="anonymous"></script>
</body>
</html>