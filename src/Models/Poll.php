<?php
class Poll {
    public $question;
    public $options;
    public function __construct($question, $options){
        $this->question = $question;
        $this->options = $options;
    }
}
