<?php
if (session_status() !== PHP_SESSION_ACTIVE && !headers_sent()) {
    session_start();
}
if (isset($_SESSION['id']) && $_SESSION['is_admin'] === 1) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $subtitle1 = $_POST['subtitle1'];
    $subtitle2 = $_POST['subtitle2'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $model = $_POST['model'];
    $width = $_POST['width'];
    $height = $_POST['height'];
    $thick = $_POST['thick'];
    $weight = $_POST['weight'];
    $display = $_POST['display'];
    $chip = $_POST['chip'];
    $camera = $_POST['camera'];
    $os = $_POST['os'];
    $storage = $_POST['storage'];
    $colors = $_POST['colors'];
    $colorsArray = explode(",", $colors);
    $image_count = $_POST['image_count'];
    $manufacturer_id = $_POST['manufacturer_id'];
    $stock = $_POST['stock'];
    $manufacturer_name = getManufacturerName($manufacturer_id);

    if (isset($_FILES['images']) && isset($_POST['imagesColors'])) {
        $images = $_FILES['images'];
        $imagesColors = $_POST['imagesColors'];
    }
    if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['size'] > 0) {
        $thumbnail = $_FILES['thumbnail'];
        //Get thumbnail name
        $thumbnail_name = strtolower(trim($title));

        // Remove existing thumbnail (if any)
        $existingThumbnailPath = "../../productos/" . $manufacturer_name . "/img/catalogo/" . $thumbnail_name . ".png";
        if (file_exists($existingThumbnailPath)) {
            unlink($existingThumbnailPath);
        }

        //Insert the smartphone
        include '../conn.php';
        $query = $conn->prepare("UPDATE smartphones SET title = ?, subtitle1 = ?, subtitle2 = ?, manufacturer_id = ?, price = ?, `description` = ?, width = ?, height = ?, thick = ?, `weight` = ?, display = ?, chip = ?, camera = ?, os = ?, `storage` = ?, colors = ?, thumbnail_name = ?, model = ?, image_count = ?, stock = ? WHERE `id` = ?");
        $query->bind_param("sssidsddddssssssssiii", $title, $subtitle1, $subtitle2, $manufacturer_id, $price, $description, $width, $height, $thick, $weight, $display, $chip, $camera, $os, $storage, $colors, $thumbnail_name, $model, $image_count, $stock, $id);
        $query->execute();
        $query->close();

        // Upload new thumbnail
        $thumbnail_tmp_name = $thumbnail["tmp_name"];
        $thumbnail_uploadPath = "../../productos/" . $manufacturer_name . "/img/catalogo/" . $thumbnail_name . ".png";
        move_uploaded_file($thumbnail_tmp_name, $thumbnail_uploadPath);
    } else {

        //Insert the smartphone
        include '../conn.php';
        $query = $conn->prepare("UPDATE smartphones SET title = ?, subtitle1 = ?, subtitle2 = ?, manufacturer_id = ?, price = ?, `description` = ?, width = ?, height = ?, thick = ?, `weight` = ?, display = ?, chip = ?, camera = ?, os = ?, `storage` = ?, colors = ?, model = ?, image_count = ?, stock = ? WHERE `id` = ?");
        $query->bind_param("sssidsddddsssssssiii", $title, $subtitle1, $subtitle2, $manufacturer_id, $price, $description, $width, $height, $thick, $weight, $display, $chip, $camera, $os, $storage, $colors, $model, $image_count, $stock, $id);
        $query->execute();
        $query->close();
    }

    /*Upload images*/
    // Images
    if (isset($images) && isset($imagesColors)) {
        echo "Existe images y imagesColors";
        $currentColor = ''; // Variable to track the current color
        $i = 0;
        foreach ($images['name'] as $index => $imageName) {
            $color = $imagesColors[$i];
            if ($color !== $currentColor) {
                echo "color !== currentcolor";
                $currentColor = $color; // Update the current color
                // Remove existing images for this color
                $existingImagesDir = "../../productos/" . $manufacturer_name . "/img/producto/" . $model . "/" . $color;
                if (file_exists($existingImagesDir)) {
                    echo "dir exists";
                    $existingImages = scandir($existingImagesDir);
                    foreach ($existingImages as $existingImage) {
                        if ($existingImage != '.' && $existingImage != '..') {
                            echo "removed";
                            unlink($existingImagesDir . "/" . $existingImage);
                        }
                    }
                }
            }
            $image_tmp_name = $images['tmp_name'][$index];
            $uploadDir = "../../productos/" . $manufacturer_name . "/img/producto/" . $model . "/" . $color;
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $image_extension = pathinfo($imageName, PATHINFO_EXTENSION);
            $newImageName = count(scandir($uploadDir)) - 1; // Calculate the new image name based on existing files
            $image_uploadPath = $uploadDir . "/" . $newImageName . "." . $image_extension;
            move_uploaded_file($image_tmp_name, $image_uploadPath);
            $i++;
        }
    }
}

function getManufacturerName($id)
{
    include '../conn.php';
    $query = $conn->prepare("SELECT `name` FROM manufacturers WHERE `id` = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $res = $query->get_result();
    $data = array();
    $name = "";
    for ($i = 0; $i < $res->num_rows; $i++) {
        $data[] = $res->fetch_assoc();
        $name = $data[$i]['name'];
    }
    return $name;
}
