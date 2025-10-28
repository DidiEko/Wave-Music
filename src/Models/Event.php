<?php
// src/Event.php
// Définit la "structure" d'un événement

class Event {
    public $title;
    public $location;
    public $date;

    public function __construct($title, $location, $date){
        $this->title = $title;
        $this->location = $location;
        $this->date = $date;
    }
}
?>