<?php
 include 'db/conexion.php';

$query_music = mysqli_query($conexion,"SELECT * FROM music");
    while ($row = mysqli_fetch_array($query_music)) {
        $id = $row['id'];
        $ruta = $row['ruta'];

        echo '<h1>'.$id.'</h1>
        <img width="100px" height="100px" src="'.$ruta.'">
        <audio controls>
            <source src="'.$ruta.'" type="audio/ogg">
            <source src="'.$ruta.'" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="name" id="" placeholder="Nombre canción">
        <input type="text" name="artist" id="" placeholder="Nombre del artísta">
        <input type="file" name="image" id="" placeholder="Portada">
        <input type="file" name="file_mp3" id="" placeholder="Archivo de canción">
        <input type="submit" value="envíar" name="guardar">
    </form>


    <?php
    

    if (isset($_POST['guardar'])) {
        $name = $_POST['name'];
        $artist = $_POST['artist'];
        $image = ($_FILES['image']['tmp_name']);
        $musica = ($_FILES['file_mp3']['tmp_name']);

        $ruta = "upload/"; 
        $nombrefinal= trim($_FILES['image']['name']); //Eliminamos los espacios en blanco
        $upload= $ruta . $nombrefinal;  


        if(move_uploaded_file($_FILES['image']['tmp_name'], $upload)) { //movemos el archivo a su ubicacion 
                    
            echo "<b>Upload exitoso!. Datos:</b><br>";  
            echo "Nombre: <i><a href=\"".$ruta . $nombrefinal."\">".$_FILES['image']['name']."</a></i><br>";  
            echo "Tipo MIME: <i>".$_FILES['image']['type']."</i><br>";  
            echo "Peso: <i>".$_FILES['image']['size']." bytes</i><br>";  
            echo "<br><hr><br>";  
                 
            $query = mysqli_query($conexion,"INSERT INTO music (ruta) VALUES
            ('$upload')");
        }

    }
    ?>



</body>
</html>