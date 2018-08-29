<?php

namespace LoveLetter\Api;


include_once '../repository/ScoreRepository.php';
use LoveLetter\Repository\ScoreRepository;



if (isset($_POST['searchBy'])) {
    
    if ($_POST['searchBy'] = 'playerId') {
        $playerId = $_POST['value'];

        $scoreRepository = new ScoreRepository();
        $scores = $scoreRepository->getScoresByPlayerId($playerId);
        
    }
    
    if ($_POST['searchBy'] = 'seasonId') {
        $seasonId = $_POST['value'];

        $scoreRepository = new ScoreRepository();
        $scores = $scoreRepository->getScoresBySeasonId($seasonId);
        
    }
}

header('Content-Type: application/json');

$scoresArray = array();
foreach ($scores as $score){
    $scoresArray[] = $score->toArray();
}

$data = $scoresArray;

echo json_encode($data);
?>