<!DOCTYPE html>
<html lang="ca">

<head>
    <title>Alta Alumno</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
</head>


<body>
    <form action='gestion.php' method='post'>
        <div class="combo">
            <h3>Alta Alumno</h3>
            <?php
                $mysqli = new mysqli
                ( "localhost" , "root" , "roflmao1" , "ESCOLA_DB");
                if ($mysqli -> connect_errno) {
                    echo "problema al connectar MySQL: " . $mysqli -> connect_error;
                }

                $sentencia = $mysqli -> prepare("SELECT NOM_ASSIGNATURA,
                                                        ID_ASSIGNATURA
                                                FROM ASSIGNATURA ASS
                                                INNER JOIN CURS C
                                                    ON ASS.CURS_ID = C.ID_CURS
                                                INNER JOIN ALUMNE AL
                                                    ON AL.CURS_ID = C.ID_CURS
                                                WHERE AL.ID_ALUMNE = ?)");


                $sentencia->bind_param("s", $id_curs);
                $porciones = explode(" ", $_POST['notasAl']);
                $id_curs = $porciones[2];
                $sentencia->execute();
                $sentencia->bind_result($nom_assignatura, $id_assignatura);
                while ($sentencia->fetch())
                {
                    echo '<br>';
                    echo $nom_assignatura;
                    echo '<br>';
                    echo $id_assignatura;
                }
            ?>

                <br>
                <br>
                <input id="altaAlumno" name='altaAlumno' type='submit' value='Guardar' class='btn btn-primary'>
        </div>
    </form>
</body>

</html>
