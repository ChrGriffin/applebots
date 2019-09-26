<?php

namespace App\AppleRobots\Actions;

use App\AppleRobots\Position;

class Move implements ActionInterface
{
    /**
     * @var Position
     */
    private $position;

    /**
     * @param Position $position
     * @return void
     */
    public function __construct(Position $position)
    {
        $this->position = $position;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'action' => 'move',
            'dest' => $this->position->toArray()
        ];
    }
}
