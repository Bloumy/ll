<?php
namespace LoveLetter\Service;

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
    
    function getSeason(): Season {
        return $this->season;
    }

    function getPlayers(): Array {
        return $this->players;
    }

    function setSeason(Season $season) {
        $this->season = $season;
    }

    function setPlayers(Array $players) {
        $this->players = $players;
    }

}
