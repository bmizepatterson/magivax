<?php

class Vaccine 
{
    public $shortname;
    public $longname;

    public function __construct($longname, $shortname)
    {
        $this->longname = $longname;
        $this->shortname = $shortname;
    }
}
