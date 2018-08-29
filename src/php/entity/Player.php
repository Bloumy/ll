<?php

namespace LoveLetter\Entity;

class Player {

    /**
     * Identification of player (ex: "CG", "CB", "CDB")
     * @var string $id
     */
    private $id;

    /**
     * @var string $firstname
     */
    private $firstname;

    /**
     * @var string $lastname
     */
    private $lastname;

    /**
     * @var string $surname
     */
    private $surname;

    public function __construct() {
        
    }

    function getId() {
        return $this->id;
    }

    function getFirstname() {
        return $this->firstname;
    }

    function getLastname() {
        return $this->lastname;
    }

    function getSurname() {
        return $this->surname;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    function setSurname($surname) {
        $this->surname = $surname;
    }

    public function toArray() {
        return array(
            'id' => $this->getId(),
            'firstname' => $this->getFirstname(),
            'lastname' => $this->getLastname(),
            'surname' => $this->getSurname(),
        );
    }

}
