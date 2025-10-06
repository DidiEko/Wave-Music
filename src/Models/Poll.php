<?php
// Définition de la classe Poll (Sondage)
class Poll {
    // Propriétés publiques de la classe
    public $question; // Question du sondage
    public $options;  // Options/réponses possibles du sondage (tableau)

    // Constructeur de la classe pour initialiser un nouvel objet Poll
    public function __construct($question, $options){
        $this->question = $question; // Assigne la question passée en paramètre à la propriété question
        $this->options = $options;   // Assigne le tableau d'options passé en paramètre à la propriété options
    }
}
