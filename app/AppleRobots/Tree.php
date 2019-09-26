<?php

namespace App\AppleRobots;

class Tree
{
    /**
     * @var Position
     */
    private $position;

    /**
     * @var float
     */
    private $radius;

    /**
     * @param Position $position
     * @param float $radius
     * @return void
     */
    public function __construct(Position $position, float $radius)
    {
        $this->position = $position;
        $this->radius = $radius;
    }

    /**
     * @param Position $position
     * @return bool
     */
    public function occupiesPosition(Position $position): bool
    {
        return (($position->getPositionX() - $this->position->getPositionX())
            * ($position->getPositionX() - $this->position->getPositionX()) +
            ($position->getPositionY() - $this->position->getPositionY())
            * ($position->getPositionY() - $this->position->getPositionY())
            <= $this->radius * $this->radius);
    }
}
