<?php

namespace LoveLetter\Repository;

include_once '../entity/Game.php';
use LoveLetter\Entity\Game;


include_once '../repository/PlayerRepository.php';
use LoveLetter\Repository\PlayerRepository;

include_once '../repository/SeasonRepository.php';
use LoveLetter\Repository\SeasonRepository;

include_once '../service/CSVReader.php';
use LoveLetter\Service\CSVReader;

class GameRepository {

    public function __construct() {

        $csvReader = new CSVReader();
        $seasonRepository = new SeasonRepository();
        $playerRepository = new PlayerRepository();
        

        $gamesCsv = $csvReader->read('../../../data/games.csv');

        $this->games = [];

        foreach ($gamesCsv as $gameCsv) {

            $game = new Game();

            $game->setId($gameCsv['id']);

            $season = $seasonRepository->getSeasonById($gameCsv['season']);

            $game->setSeason($season);

            $players = array();
            foreach(explode(",",$gameCsv['players']) as $playerId){

                $player = $playerRepository->getPlayerById($playerId);

                $players[]= $player;
            }

            $game->setPlayers($players);

            $this->games[] = $game;
        }
    }

    public function getGamesBySeasonId($id) {
        $games = [];

        foreach ($this->games as $game) {
            if ($game->getSeason() == $id) {
                $games[] = $game;
            }
        }
        return $games;
        
    }
    
    public function getGameById($id) {
      
        foreach ($this->games as $game) {
            if ($game->getId() == $id) {
             return $game;
            }
        }
        return null;
    }

}
