<?php
// src/Song.php
// Définit la "structure" d'une chanson

class Song {
    public $title;

    public function __construct($title){
        $this->title = $title;
    }
}
?>