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
    $currentPage = "score";
    include_once './menu.php';
    ?>

    <div class="container">
        <div class="grid-list">
            <?php
            $imageRepertoryPath = "data/captures/";
            $images = scandir($imageRepertoryPath);

            /**
             * 
             * @param string $season
             * @return number
             */
            function getSeasonNumber($season) {
                $seasonNumber = str_replace("season_", "", $season);
                $seasonNumber = str_replace(".jpg", "", $seasonNumber);
                return $seasonNumber;
            }

            /**
             * 
             * @param string $season
             * @return string
             */
            function getSeasonTitle($season) {
                $seasonTitle = str_replace(".jpg", "", $season);
                $seasonTitle = str_replace("_", " ", $seasonTitle);
                $seasonTitle = ucwords($seasonTitle);
                return $seasonTitle;
            }

            /* Trier les images par numéro de saison */
            usort($images, function($a, $b) {
                return getSeasonNumber($a) - getSeasonNumber($b);
            });

            /**
             * 
             * @param string $imagePath - path of image 
             * @return string $title - Title of image
             */
            function getHtmlForImage($imagePath, $title, $id) {
                $html = '<div class="grid-cell">';
                $html .= '<div class="grid-tile">';
                $html .= '<img id="' . $id . '" class="responsive-img z-depth-3 materialboxed" data-caption="' . $title . '" src="' . $imagePath . '" alt="' . $title . '" />';

                $html .= '</div>';
                $html .= '</div>';

                return $html;
            }

            /* créer les balises html pour chaque image */
            foreach ($images as $image) {
                if ($image == "." || $image == "..") {
                    continue;
                }
                echo getHtmlForImage($imageRepertoryPath . $image, getSeasonTitle($image), getSeasonNumber($image));
            }
            ?>

        </div>

        <!--<canvas id="viewport"></canvas>-->

    </div>
    <script type="text/javascript" src="node_modules/hammerjs/hammer.js"></script>
    <script type="text/javascript" src="node_modules/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="node_modules/materialize-css/dist/js/materialize.min.js"></script>
    <script type="text/javascript" src="node_modules/materialize-grid-list/js/materialize-grid-list.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
   
</body>
</html>
