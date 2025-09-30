<?php
class Artist {
    public $name;
    public $bio;
    public $image;
    public function __construct($name, $bio, $image){
        $this->name = $name;
        $this->bio = $bio;
        $this->image = $image;
    }
}
