<?php
// Définition de la classe Chipie
class Chipie {
    // Propriétés publiques de la classe
    public $title; // Titre de l'objet Chipie
    public $body;  // Contenu ou texte principal de l'objet Chipie

    // Constructeur de la classe pour initialiser un nouvel objet Chipie
    public function __construct($title, $body){
        $this->title = $title; // Assigne le titre passé en paramètre à la propriété title
        $this->body = $body;   // Assigne le contenu passé en paramètre à la propriété body
    }
}
