<?php
// Définition de la classe Song (Chanson)
class Song {
    // Propriété publique de la classe
    public $title; // Titre de la chanson

    // Constructeur de la classe pour initialiser un nouvel objet Song
    public function __construct($title){
        $this->title = $title; // Assigne le titre passé en paramètre à la propriété title
    }
}
