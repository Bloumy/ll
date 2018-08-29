<?php

namespace LoveLetter\Entity;

class Game {

    /**
     * @var int $id
     */
    private $id;

    /**
     * @var Season $season
     */
    private $season;

    /**
     * @var Array $players
     */
    private $players;

    public function __construct() {
        
    }

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function getSeason() {
        return $this->season;
    }

    function getPlayers() {
        return $this->players;
    }

    function setSeason(Season $season) {
        $this->season = $season;
    }

    function setPlayers(Array $players) {
        $this->players = $players;
    }

    public function toArray() {
        
        $players = array();
        
        foreach ($this->getPlayers as $player){
           $players[] = $player->toArray();
        }
        
        return array(
            'id' => $this->getId(),
            'season' => $this->getSeason()->toArray(),
            'players' => $players,
        );
    }

}
