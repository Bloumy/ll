<?php

namespace LoveLetter\Repository;

include_once '../entity/Season.php';

use LoveLetter\Entity\Season;

include_once '../repository/PlayerRepository.php';
use LoveLetter\Repository\PlayerRepository;


include_once '../service/CSVReader.php';
use LoveLetter\Service\CSVReader;

class SeasonRepository {

    /**
     *
     * @var Array<Saison> $seasons
     */
    private $seasons;

    public function __construct() {

        $csvReader = new CSVReader();

        $playerRepository = new PlayerRepository();

        $seasonsCsv = $csvReader->read('../../../data/seasons.csv');

        $this->seasons = [];
        foreach ($seasonsCsv as $seasonCsv) {

            $season = new Season();
            $season->setId($seasonCsv['id']);
            $player = $playerRepository->getPlayerById($seasonCsv['winner']);
            $season->setWinner($player);

            $this->seasons[] = $season;
            
        }

    }

    public function getSeasonById($id) {
        foreach ($this->seasons as $season) {
            if ($season->getId() == $id) {
                return $season;
            }
        }
        return null;
    }

}
