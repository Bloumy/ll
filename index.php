<!DOCTYPE html>
<head>
    <title>Love Letter Archives - Overview</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <?php include_once './src/php/stylesheets_part.php'; ?>
</head>
<body>

    <?php
    $currentPage = "score";
    include_once './src/php/menu_part.php';
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
    </div>

    <?php include_once './src/php/javascripts_part.php'; ?>

</body>
</html>
