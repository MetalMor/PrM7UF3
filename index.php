<!DOCTYPE html>
<html lang="ca">

<head>
    <title>Gráficos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
</head>


<body>
    <?php
spl_autoload_register(function ($classe) {
                            include $classe . '.php';
                        });
?>
        <form action='parametros.php' method='post'>
            <div class="combo">
                <h3>Graficos por parámetors</h3>
                <select id="curso" name="curso" class="selectpicker">
                    <?php
                    //Cargamos la combo con una consulta a la BD recuperando los nombres de los cursos
                        try{
                            $gbd = new PDO ( 'mysql:host=localhost;dbname=ESCOLA_DB' , 'root' , 'roflmao1' );
                            foreach( $gbd -> query ("SELECT NOM_CURS from CURS") as $fila ) {
                               echo "<option>".$fila["NOM_CURS"]."</option>";
                            }
                            $gbd = null ;
                        } catch ( PDOException $e ) {
                            print "¡Error!: " . $e -> getMessage () . "<br/>" ;
                            die();
                        }
                    ?>
                </select>
                <br>
                <br>
                <br>
                <input id="parametros" name='parametros' type='submit' value='Buscar' class='btn btn-primary'>
            </div>
        </form>
        <div class="combo">
            <br>
            <form action='altaCurs.php' method='post'>
                <input id="altaCurso" name='altaCurso' type='submit' value='Alta Curso' class='info btn-primary'>
            </form>
            <form action='altaAlumno.php' method='post'>
                <input id="altaAlumno" name='altaAlumno' type='submit' value='Alta Alumno' class='info btn-primary'>
            </form>
            <form action='notas.php' method='post'>
                <input id="notasAlumno" name='notasAlumno' type='submit' value='Notas Alumno' class='info btn-primary'>
            </form>
        </div>
        <form action='grafics.php' method='post'>
            <!-- Inicio Botonera Lateral -->
            <div id="botones">
                <input id='allNoteAlumns' name='aceptar' type='submit' value='Todas las notas' class='btn btn-primary'>
                <br>
                <?php
                //Cargamos los botones de la barra lateral de forma dinamica montando el componente input
                //con una consulta a la BD recuperando los nombres de los cursos
                    try{
                        $gbd = new PDO ( 'mysql:host=localhost;dbname=ESCOLA_DB' , 'root' , 'roflmao1' );
                        foreach( $gbd -> query ("SELECT NOM_CURS from CURS") as $fila ) {
                            echo "<input id='cursNoteAlumns".$fila["NOM_CURS"]."' name='aceptar' type='submit' value='Notas Curso ".$fila["NOM_CURS"]."' class='btn btn-primary'>";
                            echo "<br>";
                        }
                        $gbd = null ;
                    } catch ( PDOException $e ) {
                        print "¡Error!: " . $e -> getMessage () . "<br/>" ;
                        die();
                    }

                 //Cargamos los botones de la barra lateral de forma dinamica montando el componente input
                //con una consulta a la BD recuperando los nombres de los cursos y de las asignatura
                // EL boton es nombre curso y asignatura del curso
                    try{
                        $gbd = new PDO ( 'mysql:host=localhost;dbname=ESCOLA_DB' , 'root' , 'roflmao1' );
                        foreach( $gbd -> query ("SELECT ASI.NOM_ASSIGNATURA, C.NOM_CURS from ASSIGNATURA ASI INNER JOIN CURS C ON C.ID_CURS = ASI.CURS_ID ") as $fila ) {
                            echo "<input id='cursNoteAlumnsAssignature".$fila["NOM_ASSIGNATURA"]."' name='aceptar' type='submit' value='Notas Curso ".$fila["NOM_CURS"]." Asignatura ".$fila["NOM_ASSIGNATURA"]."' class='btn btn-primary'>";
                            echo "<br>";
                        }
                        $gbd = null ;
                    } catch ( PDOException $e ) {
                        print "¡Error!: " . $e -> getMessage () . "<br/>" ;
                        die();
                    }
                ?>
            </div>
            <!-- FIN Botonera Lateral -->
        </form>
</body>

</html>
