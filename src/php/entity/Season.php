<?php

namespace LoveLetter\Entity;

include_once '../entity/Player.php';

use LoveLetter\Entity\Player;

class Season {

    /**
     * Identification of season 
     * @var int $id
     */
    private $id;

    /**
     * Winner of the season
     * @var Player 
     */
    private $winner;

    public function __construct() {
        
    }

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function getWinner() {
        return $this->winner;
    }

    function setWinner(Player $winner) {
        $this->winner = $winner;
    }

    public function toArray() {

        return array(
            'id' => $this->getId(),
            'winner' => $this->getWinner()->toArray(),
        );
    }

}
