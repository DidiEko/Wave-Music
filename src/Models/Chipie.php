<?php
// src/Chipie.php
// Définit la "structure" d'une chipie (actu)

class Chipie {
    public $title;
    public $body;

    public function __construct($title, $body){
        $this->title = $title;
        $this->body = $body;
    }
}
?>