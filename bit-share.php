<html>
    <head>
        <link rel="stylesheet" type="text/css" href="bit-share.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300&display=swap" rel="stylesheet">  
    </head>
    <body>    
    <div class="container">

        <div id="header">
        <img id="logo" src="https://i.imgur.com/vYnQR1n.png">
            <a href="new-post.php"><button id="share-butt" >Nieuwe share</button></a>
        </div>
            <?php
                require 'connection.php';
            
                $data = $pdo->prepare("SELECT * FROM post");
                $data->execute();
                $post = $data->fetchAll();
            foreach ($post as $row) {

                    echo "<div class='post'>";                    
                    echo "<h1>" . $row['titel'] . "</h1>";
                    echo "<div class='inhoud'>";
                    echo "<img id='foto' src=" . $row['foto'] . ">";
                    echo "<p id='text'>" . $row['text'] . "</p>";
                    echo "</div>";
                    echo "<p>" . $row['datum'] . "</p>"; 
                    echo "</div>";
            };
                
            ?>
        </div>
    </body>
</html>
