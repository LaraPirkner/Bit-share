<html>

    <head>
        <link rel="stylesheet" type="text/css" href="bit-share.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300&display=swap" rel="stylesheet">  
    </head>

    <body>
        <div class="container">

            <div id="header-share">
                <h1 id="share-p-title">Nieuwe Share</h1>
                <a href="bit-share.php"><button>Alle shares</button></a>
            </div>

        <?php
            require 'connection.php';

        if (isset($_POST["submit"])) {
            $title = $_POST['titel'];
            $text = $_POST['text'];
            $uploadOk = 1;

            $check = getimagesize($_FILES["foto"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            } else {
                $randNum = rand(1,9999);
                $var3 = md5($randNum);
                
                $fnm = $_FILES["foto"]["name"];
                $foto = "./uploads/".$var3.$fnm;
                $foto_db = "uploads/".$var3.$fnm;
                if (move_uploaded_file($_FILES["foto"]["tmp_name"], $foto)) {
                    echo "Your post has been uploaded.";
                    $target_file = basename( $foto );
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $image_base64 = base64_encode(file_get_contents( $foto) );
                    $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
                
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
                $datum = date("F j, Y");
                $sql = "INSERT INTO post SET titel=?, text=?, foto=?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$title,$text,$image]);
        } else {
            ?>
            <form action="new-post.php" method="post" enctype="multipart/form-data">
                <label for="titel">Titel:</label><br>
                <input type="text" id="titel" name="titel"><br><br>
                <label for="text">Text:</label><br> 
                <textarea name="text" id="text" placeholder="Describe your experience!" rows="7" cols="60"></textarea><br><br>
                <label for="foto">Afbeelding:</label><br> 
                <input type="file" name="foto" id="upload-photo" /><br/><br/>
                <input type="submit" id="submit" name="submit" value="Share jouw share!">
            </form>
            <?php
        }
        ?>
    </body>
</html>
