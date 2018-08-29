<!DOCTYPE html>
<head>
    <title>Love Letter Archives</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <?php include_once './src/php/stylesheets_part.php'; ?>
</head>
<body>

    <?php
    $currentPage = "stats";
    include_once './src/php/menu_part.php';
    ?>


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
     * @param string $value
     * @return string $title
     */
    function getHtmlOption($value, $title) {
        return '<option value = "' . $value . '">' . $title . '</option>';
    }
    ?>





    <div class="stats container">

        <div class="row">
            <div id="select-sheet-div" class="col s6">

                <!--SELECT SHEET-->
                <label for="select-sheet">Select a sheet</label>
                <select id="select-sheet">
                    <option value = "" disabled selected>Choose your sheet</option>
                    <?php
                    /* créer les balises html pour chaque image */
                    foreach ($images as $image) {
                        if ($image == "." || $image == "..") {
                            continue;
                        }
                        echo getHtmlOption($image, $image);
                    }
                    ?>
                </select>
            </div>

<!--            <div id="select-column-div"class="col s3 hide">
                SELECT COLUMN
                <label for="select-column">Select a column</label>
                <select id="select-column">
                    <option value = "" disabled selected>Choose your column</option>
                </select>
            </div>

            <div id="select-line-div" class="col s3 hide">
                SELECT LINE
                <label for="select-line">Select a line</label>
                <select id="select-line">
                    <option value = "" disabled selected>Choose your line</option>
                </select>
            </div>-->


            <div id="sheet-div" class="col s6"></div>
            <!--<div id="sheet-square-div" class="col s6"></div>-->


        </div>
        <hr>
        <div id="winner" class="col s12">
        <div id="scores" class="col s12">
<!--            <h1>Season XX</h1>
            
            TODO : Choice pertinent stats<br>
            ex:
            <ul>
                <li>Games number : X</li>
                <li>Winner : John Doe (x parts win)</li>
                <li>The most present : Jeanne Doe (x%)</li>
                <li>The most with Zeros: 3eme laron</li>
                <li>etc.</li>
            </ul>-->
        </div>

    </div>

    <?php include_once './src/php/javascripts_part.php'; ?>
    <script type="text/javascript" src="./src/js/ScoreExtractorHelper.js"></script>
    <script type="text/javascript" src="./src/js/stats.js"></script>

</body>
</html>
