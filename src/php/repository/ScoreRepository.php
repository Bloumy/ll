<?php

namespace LoveLetter\Repository;

include_once '../entity/Score.php';

use LoveLetter\Entity\Score;

include_once '../repository/PlayerRepository.php';

use LoveLetter\Repository\PlayerRepository;

include_once '../repository/GameRepository.php';

use LoveLetter\Repository\GameRepository;

include_once '../service/CSVReader.php';

use LoveLetter\Service\CSVReader;

class ScoreRepository {

    private $scores;

    public function __construct() {

        $csvReader = new CSVReader();

        $scoresCsv = $csvReader->read('../../../data/scores.csv');

        $gameRepository = new GameRepository();

        $playerRepository = new PlayerRepository();

        $this->scores = [];
        foreach ($scoresCsv as $scoreCsv) {

            $score = new Score();

            $score->setSeason($scoreCsv['season']);

            $player = $playerRepository->getPlayerById($scoreCsv['player']);
            $score->setPlayer($player);

            $game = $gameRepository->getGameById($scoreCsv['game']);
            $score->setGame($game);

            $score->setPoints($scoreCsv['points']);

            $this->scores[] = $score;
        }
    }

    public function getScoresByPlayerId($playerId) {
        $scores = [];
        foreach ($this->scores as $score) {
            if ($score->getPlayer()->getId() == $playerId) {
                $scores[] = $score;
            }
        }

        return $scores;
    }

    public function getScoresBySeasonId($saisonId) {
        $scores = [];
        foreach ($this->scores as $score) {
            
            if ($score->getSeason() == $saisonId) {
                $scores[] = $score;
            }
        }

        return $scores;
    }

}
