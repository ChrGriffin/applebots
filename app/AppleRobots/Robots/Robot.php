<?php

namespace App\AppleRobots\Robots;

use App\AppleRobots\Actions\ActionInterface;
use App\AppleRobots\Grid;

abstract class Robot
{
    /**
     * @const int
     */
    const NORTH = 1;

    /**
     * @const int
     */
    const EAST = 2;

    /**
     * @const int
     */
    const SOUTH = 3;

    /**
     * @const int
     */
    const WEST = 4;

    /**
     * @var Grid
     */
    protected $grid;

    /**
     * @var int
     */
    protected $positionX;

    /**
     * @var int
     */
    protected $positionY;

    /**
     * @param int $positionX
     * @param int $positionY
     * @param Grid $grid
     * @return void
     */
    public function __construct(int $positionX, int $positionY, Grid $grid)
    {
        $this->grid = $grid;
        $this->setPosition($positionX, $positionY);
    }

    /**
     * @return array
     */
    public function getPosition(): array
    {
        return [
            'x' => $this->positionX,
            'y' => $this->positionY
        ];
    }

    /**
     * @param int $positionX
     * @param int $positionY
     * @return Robot
     */
    public function setPosition(int $positionX, int $positionY): Robot
    {
        $this->positionX = $positionX;
        $this->positionY = $positionY;
        return $this;
    }

    abstract function act(): ActionInterface;
}
