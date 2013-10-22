<?php
    require_once "../models/Photo.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            $valid = true;
            $validation_keys = array("name","position");
            foreach( $validation_keys as $validation ){
                if( !array_key_exists($validation, $_POST) ){
                    echo ("<div>Must supply ".$validation."</div>");
                    $valid = false;
                }
            }
            
            $image_file = $_FILES["image_file"];
            if( (!$image_file) || $image_file["error"] > 0 ){
                echo "<div>Error with Photo File: ".$_FILES["image_file"]["error"]."</div>";
                $valid = false;
            }
            
            if( $valid ){
                $new_path = "/photos/".$image_file['name'];
                if( move_uploaded_file($image_file['tmp_name'], $_SERVER["DOCUMENT_ROOT"].$new_path) ){
                    $photo = Photo::create( $_POST['name'], $new_path, intval($_POST['gallery']),  intval($_POST['position']) );

                    echo "<div>New Photo Creation Succeeded</div><a href='/admin/gallery.php?id=".$_POST['gallery']."'>Back to Gallery</a>";
                } else {
                    echo "<div>New Photo Creation Failed. You may have already used this file.";
                }
            }

        ?>
    </body>
</html>
