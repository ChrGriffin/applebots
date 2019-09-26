<?php

namespace App\AppleRobots;

class Tree
{
    /**
     * @var int
     */
    private $positionX;

    /**
     * @var int
     */
    private $positionY;

    /**
     * @var float
     */
    private $radius;

    /**
     * @param int $x
     * @param int $y
     * @param float $radius
     * @return void
     */
    public function __construct(int $x, int $y, float $radius)
    {
        $this->positionX = $x;
        $this->positionY = $y;
        $this->radius = $radius;
    }

    /**
     * @param int $positionX
     * @param int $positionY
     * @return bool
     */
    public function occupiesCoordinates(int $positionX, int $positionY): bool
    {
        return (($positionX - $this->positionX) * ($positionX - $this->positionX) +
            ($positionY - $this->positionY) * ($positionY - $this->positionY) <= $this->radius * $this->radius);
    }
}
