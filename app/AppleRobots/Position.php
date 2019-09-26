<?php

namespace App\AppleRobots;

class Position
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
        $this->setPosition($positionX, $positionY);
    }

    /**
     * @param int $positionX
     * @param int $positionY
     * @return Position
     */
    public function setPosition(int $positionX, int $positionY): Position
    {
        $this->positionX = $positionX;
        $this->positionY = $positionY;
        return $this;
    }

    /**
     * @return int
     */
    public function getPositionX(): int
    {
        return $this->positionX;
    }

    /**
     * @return int
     */
    public function getPositionY(): int
    {
        return $this->positionY;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'x' => $this->getPositionX(),
            'y' => $this->getPositionY()
        ];
    }
}
