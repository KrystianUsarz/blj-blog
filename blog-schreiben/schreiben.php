<?php 
    include '../common/db.php';

$errors = [];

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $Username = htmlspecialchars(trim($_POST['name'] ?? ''));
    $PostTitle = htmlspecialchars(trim($_POST['title'] ?? ''));
    $Context = htmlspecialchars(trim($_POST['text'] ?? ''));
    $PostImageUrl = htmlspecialchars(trim($_POST['url_link'] ?? ''));

    if ($Username === '') {
        $errors[] = 'Bitte geben Sie einen Benutzernamen ein.';
    }

    if ($PostTitle === '') {
        $errors[] = 'Bitte geben Sie einen Titel ein.';
    }

    if ($Context === '') {
        $errors[] = 'Bitte geben Sie ihren Text ein.';
    }

    if (count($errors) === 0) {
        $stmt = $pdo->prepare('INSERT INTO blog (creator, title, url, context, create_date, likes, dislikes)
        VALUES (:Username, :Title, :Url, :Context, now(), 0, 0)');

        $stmt->execute([':Username' => $Username, ':Title' => $PostTitle,':Url'=> $PostImageUrl, ':Context' => $Context]);

    }
}
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Krystians Blog</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel="stylesheet" href="../vorlage/blog-vorlage.css">
        <link rel="stylesheet" href="schreiben-style.css">
    </head>

    <body  id="body">

    <?php include '../vorlage/blog-vorlage.php';?>        

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
    </body>

</html>