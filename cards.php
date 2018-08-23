<!DOCTYPE html>
<head>
    <title>Love Letter Archives</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="node_modules/materialize-css/dist/css/materialize.min.css" />
    <link type="text/css" rel="stylesheet" href="node_modules/materialize-grid-list/css/materialize-grid-list.css" />
    <link type="text/css" rel="stylesheet" href="css/main.css" />
</head>
<body>

    <?php
    $currentPage = "cards";
    include_once './menu.php';
    ?>

    <div class="container">
        <img class="responsive-img z-depth-3 materialboxed" 
             data-caption="Liste des cartes" 
             src="./img/love-letter-cards.jpg" 
             alt="Liste des cartes" />

    </div>
    
    TODO : image à remplacer, ajouter chaque carte scannée séparément.

    <script type="text/javascript" src="node_modules/hammerjs/hammer.js"></script>
    <script type="text/javascript" src="node_modules/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="node_modules/materialize-css/dist/js/materialize.min.js"></script>
    <script type="text/javascript" src="node_modules/materialize-grid-list/js/materialize-grid-list.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>
