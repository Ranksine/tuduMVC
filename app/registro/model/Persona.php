<?php

class Persona{
    public $nombre,$ano,$edad;
    public function __construct($n="",$a=0,$e=0) {
        $this->nombre= $n;
        $this->edad=$e;
        $this->ano=$a;
    }
}
