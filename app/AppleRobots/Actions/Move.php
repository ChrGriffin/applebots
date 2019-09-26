<?php

namespace App\AppleRobots\Actions;

class Move implements ActionInterface
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
     * @param int $positionX
     * @param int $positionY
     * @return void
     */
    public function __construct(int $positionX, int $positionY)
    {
        $this->positionX = $positionX;
        $this->positionY = $positionY;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'action' => 'move',
            'dest' => [
                'x' => $this->positionX,
                'y' => $this->positionY
            ]
        ];
    }
}
