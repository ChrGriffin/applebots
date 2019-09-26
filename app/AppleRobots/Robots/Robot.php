<?php

namespace App\AppleRobots\Robots;

use App\AppleRobots\Actions\ActionInterface;
use App\AppleRobots\Directions\DirectionInterface;
use App\AppleRobots\Directions\East;
use App\AppleRobots\Directions\North;
use App\AppleRobots\Directions\South;
use App\AppleRobots\Directions\West;
use App\AppleRobots\Grid;
use App\AppleRobots\Position;

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
     * @var Position
     */
    protected $position;

    /**
     * @param Position $position
     * @param Grid $grid
     * @return void
     */
    public function __construct(Position $position, Grid $grid)
    {
        $this->grid = $grid;
        $this->directions = [
            'north' => new North,
            'east'  => new East,
            'south' => new South,
            'west'  => new West
        ];
        $this->setPosition($position);
    }

    /**
     * @return Position
     */
    public function getPosition(): Position
    {
        return $this->position;
    }

    /**
     * @param Position $position
     * @return Robot
     */
    public function setPosition(Position $position): Robot
    {
        $this->position = $position;
        return $this;
    }

    abstract function act(): ActionInterface;
}
