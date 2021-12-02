<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP-Grundlagen (MV-Architektur)</title>
</head>
<body>
    
    <?php 
        // abfragen, was der benutzer sehen möchte
        $page = $_GET['page'] ?? '';

        if ($page === '' || $page === 'home') {
            require 'view/view-Homepage.php';
        }
        else if ($page === 'create-Blog') {
            require 'view/view-Blog-schreiben.php';
        }
        else if ($page === 'other-Blogs') {
            require 'view/view-andere-Blogs.php';
        }
        else {
            echo '404 page not found';
        }
        
    ?>
  </body>
</html>