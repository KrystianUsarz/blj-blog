<?php  include './models/model-Blog-schreiben.php' ?>        

<!DOCTYPE html>
<html>

    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Krystians Blog</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel="stylesheet" href="./CSS/Blog-Vorlage-Style.css">
        <link rel="stylesheet" href="./CSS/Blog-schreiben-Style.css">
    </head>

    <body  id="body">

    <?php  include 'view-Blog-Vorlage.php' ?>        

         <!-- Fehler aus Formular anzeigen -->
         <?php if (count($errors) > 0) { ?>
            <div class="error-box">
                <ul>
                    <?php foreach ($errors as $error) { ?>
                        <li><?= $error ?></li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>

        <div class="formularLayout">
            <div class="formular">
                <form action="schreiben.php" method="post">
                    <h1 id="title">Blogeintrag erstellen</h1>
                    
                    <div> 
                        <label for="name">Bloggername</label>
                        <input type="text" id="name" name="name" value="<?= $Username ?? '' ?>">
                    </div>
                   
                    <div>
                        <label for="title">Blogtitel</label>
                        <input type="text" id="title" name="title" value="<?= $Title ?? '' ?>">
                    </div>

                    <div>
                        <label for="url_link">Link zum Bild</label>
                        <input type="url" id="url_link" name="url_link" pattern="data:image/.*" value="<?= $Url_Picture ?? '' ?>">
                    </div>

                    <div class="LayoutimFormular">
                        <label for="text">Blogtext</label>
                        <textarea class="TextBox" name="text" id="text" cols="30" rows="10"></textarea>
                    </div>

                    <input class="btnPublish" type="submit" value="Blogeintrag publizieren">
                </form>
            </div>
        </div>
        <div class="footer">
            <?php  include 'view-footer.php'; ?>
        </div>
    </body>

</html>