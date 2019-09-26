<?php

namespace App;

class Tree
{
    private $positionX;
    private $positionY;
    private $radius;

    public function __construct($x, $y, $radius)
    {
        $this->positionX = $x;
        $this->positionY = $y;
        $this->radius = $radius;
    }

    public function occupiesCoordinates($positionX, $positionY)
    {
        return (($positionX - $this->positionX) * ($positionX - $this->positionX) +
            ($positionY - $this->positionY) * ($positionY - $this->positionY) <= $this->radius * $this->radius);
    }
}
