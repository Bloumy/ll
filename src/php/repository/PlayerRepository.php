<?php

namespace LoveLetter\Repository;

include_once '../entity/Player.php';
use LoveLetter\Entity\Player;

include_once '../service/CSVReader.php';
use LoveLetter\Service\CSVReader;

class PlayerRepository {

    /**
     *
     * @var Array<Player> 
     */
    private $players;

    public function __construct() {

        $csvReader = new CSVReader();
        
        $playersCsv = $csvReader->read('../../../data/players.csv');

        $this->players = [];
        foreach ($playersCsv as $playerCsv) {

            $player = new Player();

            $player->setId($playerCsv['id']);
            $player->setLastname($playerCsv['lastname']);
            $player->setFirstname($playerCsv['firstname']);
            $player->setSurname($playerCsv['surname']);

            $this->players[] = $player;
        }
    }
    
    public function getPlayerById($id){
          foreach ($this->players as $player){
            if($player->getId() == $id){
                return $player;
            }
        }
        return null;
    }

}
