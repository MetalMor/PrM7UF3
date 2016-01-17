<!DOCTYPE html>
<html lang="ca">

<head>
    <title>Gráficos</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <form action='notasAlumno.php' method='post'>
        <table id="notaAlumnes" class="table table-striped table-bordered" cellspacing="0" width="50%">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Curs</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Nombre</th>
                    <th>Curs</th>
                </tr>
            </tfoot>
            <tbody>
                <?php
                    // Cargamos el listado de los alumnos del curso selecionado previamente en el combo
                    // a cada alumno le montamos el componente input para llamar al grafico.
                    // se monta de forma dinamica
                    $mysqli = new mysqli
                    ( "localhost" , "root" , "roflmao1" , "ESCOLA_DB");
                    if ($mysqli -> connect_errno) {
                        echo "problema al connectar MySQL: " . $mysqli -> connect_error;
                    }
                    $sentencia = $mysqli -> prepare("SELECT A.ID_ALUMNE,
                                                    A.NOM_ALUMNE,
                                                    A.COGNOM1_ALUMNE,
                                                    A.COGNOM2_ALUMNE,
                                                    C.NOM_CURS
                                                    FROM ALUMNE A
                                                    INNER JOIN CURS C
                                                    ON C.ID_CURS = A.CURS_ID
                                                    WHERE ID_ALUMNE NOT IN
                                                        (SELECT distinct ALUMNE_ID FROM NOTA);");
                    $sentencia->execute();
                    $sentencia->bind_result($id_alumne, $nom_alumne, $cognom1_alumne, $cognom2_alumne, $nom_curs);
                    while ($sentencia->fetch())
                    {
                        echo "<tr>
                        <th>".$nom_alumne.' '.$cognom1_alumne.' '.$cognom2_alumne."</th>
                        <th>".$nom_curs."</th>
                        <th><input name='notasAl' type='submit' value='Poner notas ".$id_alumne."' class='info btn-info'></th>
                        </tr>";
                    }
                ?>
            </tbody>
        </table>
    </form>
</body>

</html>
