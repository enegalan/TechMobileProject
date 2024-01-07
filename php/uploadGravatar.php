<?php
    include 'lang/detect_lang.php';
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    if(isset($_FILES['gravatar']) && isset($_SESSION['id'])){
        $gravatar = $_FILES['gravatar'];
        $id = $_SESSION['id'];
        if ($gravatar["error"] === UPLOAD_ERR_OK){
            $tmpName = $gravatar["tmp_name"];
            
            // Obtener la extensión del archivo
            $extension = pathinfo($gravatar["name"], PATHINFO_EXTENSION);
            
            // Ruta de la carpeta donde se guardará la imagen
            $uploadDir = '../images/users/';

            // Ruta a mostrar en la web
            $showDir = './images/users/';
            
            // Nombre del archivo (puedes utilizar el correo electrónico del usuario como nombre)
            $filename = $_SESSION['id'] . '.' . $extension;

            $filenameDir = $_SESSION['id'] . '.' . $extension;
            
            // Ruta completa del archivo
            $uploadPath = $uploadDir . $filename;

            //Ruta completa del archivo a mostrar en web
            $uploadPathWeb = $showDir . $filenameDir;
            
            // Mover el archivo a la carpeta de destino
            if(move_uploaded_file($tmpName, $uploadPath)){
                // Guardar la ruta del archivo en la sesión
                $_SESSION['gravatar'] = $uploadPathWeb;

                include 'conn.php';
                $query = $conn->prepare("UPDATE users SET gravatar = ? WHERE id = ?");
                $query->bind_param("si",$uploadPathWeb,$id);
                $query->execute();
                $query->close();

                $conn->close();
                
                // Redireccionar a la página de perfil
                header('location: ../profile.php');
                exit;
            }else{
                echo $lang['error_uploading_file'];
            }
        }else{
            echo $lang['error_uploading_file'];
        }
    }
?>