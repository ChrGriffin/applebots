<?php

namespace App\AppleRobots\Robots;

use App\AppleRobots\Actions\ActionInterface;
use App\AppleRobots\Directions\DirectionInterface;
use App\AppleRobots\Directions\East;
use App\AppleRobots\Directions\North;
use App\AppleRobots\Directions\South;
use App\AppleRobots\Directions\West;
use App\AppleRobots\Grid;

abstract class Robot
{
    /**
     * @var DirectionInterface[]
     */
    protected $directions = [];

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
        $this->directions = [
            'north' => new North,
            'east'  => new East,
            'south' => new South,
            'west'  => new West
        ];
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
