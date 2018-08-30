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
$scoresTotal = array();
$scoresBulles = array();

foreach ($scores as $score) {
    $points = 0;
    if ($score->getPoints() >= 4) {
        $points = 1;
    }
    $scoresTotal[$score->getPlayer()->getId()] += $points;


    $bulles = 0;
    if ($score->getPoints() == 0) {
        $bulles = 1;
    }
    $scoresBulles[$score->getPlayer()->getId()] += $bulles;

    $scoresArray[] = array(
        'player' => $score->getPlayer()->getId(),
        'game' => $score->getGame()->getId(),
        'points' => $score->getPoints()
    );
}

$data['total'] = $scoresTotal;
$data['bulles'] = $scoresBulles;
$data['scores'] = $scoresArray;

echo json_encode($data);
?>