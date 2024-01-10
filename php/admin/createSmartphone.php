<?php 
    if(session_status() !== PHP_SESSION_ACTIVE && !headers_sent()){
        session_start();
    }
    if(isset($_SESSION['id']) && $_SESSION['is_admin'] === 1){
        $title = $_POST['title'];
        $subtitle1 = $_POST['subtitle1'];
        $subtitle2 = $_POST['subtitle2'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $model = $_POST['model'];
        $width = $_POST['width'];
        $height = $_POST['height'];
        $thick = $_POST['thick'];;
        $weight = $_POST['weight'];
        $display = $_POST['display'];
        $chip = $_POST['chip'];
        $camera = $_POST['camera'];
        $os = $_POST['os'];
        $storage = $_POST['storage'];
        $colors = $_POST['colors'];
        $colorsArray = explode(",",$colors);
        $thumbnail = $_FILES['thumbnail'];
        $image_count = $_POST['image_count'];
        $images = $_FILES['images'];
        $imagesColors = $_POST['imagesColors'];
        $manufacturer_id = $_POST['manufacturer_id'];
        $stock = $_POST['stock'];

        //Get thumbnail name
        $thumbnail_name = strtolower(trim($title));
        //Insert the smartphone
        include '../conn.php';
        $query = $conn->prepare("INSERT INTO smartphones (title, subtitle1, subtitle2, manufacturer_id, price, `description`, width, height, thick, `weight`, display, chip, camera, os, `storage`, colors, thumbnail_name, model, image_count, stock) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $query->bind_param("sssidsddddssssssssii",$title, $subtitle1, $subtitle2, $manufacturer_id, $price, $description, $width, $height, $thick, $weight, $display, $chip, $camera, $os, $storage, $colors, $thumbnail_name, $model, $image_count, $stock);
        $query->execute();
        $query->close();

        /*Upload images*/
        $manufacturer_name = getManufacturerName($manufacturer_id);
        //Thumbnail
        $thumbnail_tmp_name = $thumbnail["tmp_name"];
        $thumbnail_uploadPath = "../../productos/".$manufacturer_name."/img/catalogo/".$thumbnail_name.".png";
        move_uploaded_file($thumbnail_tmp_name,$thumbnail_uploadPath);

        //Images
        $currentColor = '';  // Variable para rastrear el color actual
        $imageCounter = 1;   // Inicializar el contador de imágenes
        $i = 0;
        foreach ($images['name'] as $index => $imageName) {
            $color = $imagesColors[$i];  
            if ($color !== $currentColor) {
                $currentColor = $color;     // Actualizar el color actual
                $imageCounter = 1;          // Reiniciar el contador de imágenes
            }
            $image_tmp_name = $images['tmp_name'][$index];  // Usa $index en lugar de $i
            $image_extension = pathinfo($imageName, PATHINFO_EXTENSION);
            $newImageName = $imageCounter;
            $uploadDir = "../../productos/" . $manufacturer_name . "/img/producto/" . $model . "/" . $color;
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $image_uploadPath = $uploadDir . "/" . $newImageName . "." . $image_extension;
            move_uploaded_file($image_tmp_name, $image_uploadPath);
            $imageCounter++;  // Incrementar el contador de imágenes para el próximo archivo
            $i++;
        }
    }
    
    function getManufacturerName($id){
        include '../conn.php';
        $query = $conn->prepare("SELECT `name` FROM manufacturers WHERE `id` = ?");
        $query->bind_param("i",$id);
        $query->execute();
        $res = $query->get_result();
        $data = array();
        $name = "";
        for($i = 0; $i < $res->num_rows;$i++){
            $data[] = $res->fetch_assoc();
            $name = $data[$i]['name'];
        }
        return $name;
    }
?>