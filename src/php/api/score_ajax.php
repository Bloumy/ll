<?php

namespace LoveLetter\Api;

include_once '../repository/SeasonRepository.php';

use LoveLetter\Repository\SeasonRepository;

if (isset($_POST['seasonId'])) {
    $seasonId = $_POST['seasonId'];
} else {
    $seasonId = "1";
}

$seasonRepository = new SeasonRepository();
$season = $seasonRepository->getSeasonById($seasonId);

header('Content-Type: application/json');

$data = array();

if ($season != null) {
    $data['season'] = $season->getId();
    if ($season->getWinner() != null) {
        $data['winner'] = $season->getWinner()->toArray();
    }
}

echo json_encode($data);
?>