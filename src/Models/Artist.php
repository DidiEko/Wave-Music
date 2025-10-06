<?php
// Définition de la classe Artist
class Artist {
    // Propriétés publiques de l'artiste
    public $name;  // Nom de l'artiste
    public $bio;   // Biographie de l'artiste
    public $image; // URL ou chemin de l'image de l'artiste

    // Constructeur de la classe pour initialiser un nouvel objet Artist
    public function __construct($name, $bio, $image){
        $this->name = $name;   // Assigne le nom passé en paramètre à la propriété name
        $this->bio = $bio;     // Assigne la biographie passée en paramètre à la propriété bio
        $this->image = $image; // Assigne l'image passée en paramètre à la propriété image
    }
}
