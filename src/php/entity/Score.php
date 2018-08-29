<?php
namespace LoveLetter\Entity;

include_once '../entity/Player.php';
use LoveLetter\Entity\Player;

include_once '../entity/Game.php';
use LoveLetter\Entity\Game;


class Score {

    /**
     *
     * @var int $season 
     */
    private $season;

    /**
     * @var Game $game
     */
    private $game;

    /**
     * @var Player $player
     */
    private $player;

    /**
     * @var int $points
     */
    private $points;

    public function __construct() {
        
    }

    function getSeason() {
        return $this->season;
    }

    function getGame() {
        return $this->game;
    }

    function getPlayer() {
        return $this->player;
    }

    function getPoints() {
        return $this->points;
    }

    function setSeason($season) {
        $this->season = $season;
    }

    function setGame(Game $game) {
        $this->game = $game;
    }

    function setPlayer(Player $player) {
        $this->player = $player;
    }

    function setPoints($points) {
        $this->points = $points;
    }

    public function toArray() {

        return array(
            'season' => $this->getSeason(),
            'game' => $this->getGame()->toArray(),
            'player' => $this->getPlayer()->toArray(),
            'points' => $this->getPoints(),
        );
    }

}
