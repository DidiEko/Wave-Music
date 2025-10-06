<?php
// Définition de la classe Event
class Event {
    // Propriétés publiques de l'événement
    public $title;    // Titre de l'événement
    public $location; // Lieu de l'événement
    public $date;     // Date de l'événement

    // Constructeur de la classe pour initialiser un nouvel objet Event
    public function __construct($title, $location, $date){
        $this->title = $title;       // Assigne le titre passé en paramètre à la propriété title
        $this->location = $location; // Assigne le lieu passé en paramètre à la propriété location
        $this->date = $date;         // Assigne la date passée en paramètre à la propriété date
    }
}
