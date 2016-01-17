<!DOCTYPE html>
<html lang="ca">

<head>
    <title>Alta</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <a href="index.php">
        <input type='submit' value='Pagina principal' class='info btn-primary'>
    </a>
</body>

</html>

<?php
if (isset($_POST['altaCurso'])) {
    altaCurso();
} else if (isset($_POST['altaAlumno'])) {
    altaAlumno();
}

/*
* Funcion alta de alumnos
*/
function altaAlumno(){
    $mysqli = new mysqli( "localhost" , "root" , "roflmao1" , "ESCOLA_DB");
    if ($mysqli->connect_errno) {
        echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

    // Esta query nos devuelve el siguiente id de la tabla ya que las tablas no se han hecho autoincrementales
    $id=0;
    $resultat = $mysqli -> query("SELECT MAX(ID_ALUMNE)+1 as ID_ALUMNE from ALUMNE" );
    while($fila=$resultat->fetch_assoc()){
        $id = $fila["ID_ALUMNE"];
    }

    //recuperamos el ID de curso que estamos dando de alta al alumno
    //para luego poder insertarlo
    $curs_id = 0;
    $sql = "SELECT ID_CURS from CURS where NOM_CURS = '".$_POST['curso']."'";
    $resultat = $mysqli -> query($sql);
    while($fila=$resultat->fetch_assoc()){
        $curs_id = $fila["ID_CURS"];
    }

    try {
        $gbd = new PDO ( 'mysql:host=localhost;dbname=ESCOLA_DB' , 'root' , 'roflmao1' );
    } catch ( Exception $e ) {
        die( "problema de connexio: " . $e -> getMessage ());
    }

    //hacemos el insert de los datos que hemos recuperado del formulario
    $sentencia = $gbd -> prepare ( "INSERT INTO ALUMNE (ID_ALUMNE, NOM_ALUMNE, COGNOM1_ALUMNE, COGNOM2_ALUMNE, CURS_ID)
    VALUES (:id, :nom_alumne, :cognom1_alumne, :cognom2_alumne, :curs_id)");

    $sentencia -> bindParam ( ':id', $id );
    $sentencia -> bindParam ( ':curs_id', $curs_id );
    $sentencia -> bindParam ( ':nom_alumne', $nom_alumne );
    $sentencia -> bindParam ( ':cognom1_alumne', $cognom1_alumne );
    $sentencia -> bindParam ( ':cognom2_alumne', $cognom1_alumne );
    $nom_alumne = $_POST['name'];
    $cognom1_alumne = $_POST['ap1'];
    $cognom2_alumne = $_POST['ap2'];
    $sentencia -> execute ();
}

function altaCurso(){
    $mysqli = new mysqli( "localhost" , "root" , "roflmao1" , "ESCOLA_DB");
    if ($mysqli->connect_errno) {
        echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

    // Esta query nos devuelve el siguiente id de la tabla ya que las tablas no se han hecho autoincrementales
    $id=0;
    $resultat = $mysqli -> query("SELECT MAX(ID_CURS)+1 as ID_CURS from CURS" );
    while($fila=$resultat->fetch_assoc()){
        $id = $fila["ID_CURS"];
    }

    try {
        $gbd = new PDO ( 'mysql:host=localhost;dbname=ESCOLA_DB' , 'root' , 'roflmao1' );
    } catch ( Exception $e ) {
        die( "problema de connexio: " . $e -> getMessage ());
    }

    //hacemos el insert de los datos que hemos recuperado del formulario
    $sentencia = $gbd -> prepare ( "INSERT INTO CURS (ID_CURS, NOM_CURS, NOM_RESPONSABLE) VALUES (:id, :nom_curs, :nom_responsable)" );

    $sentencia -> bindParam ( ':id', $id );
    $sentencia -> bindParam ( ':nom_curs', $nom_curs );
    $sentencia -> bindParam ( ':nom_responsable', $nom_responsable );
    $nom_curs = $_POST['nameCurs'];
    $nom_responsable = $_POST['responsable'];
    $sentencia -> execute ();
}

?>
