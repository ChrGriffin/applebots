<?php

namespace App\Robots;

use App\Grid;

class Jester
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
    private $grid;

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
     * @param Grid $grid
     * @return void
     */
    public function __construct(int $positionX, int $positionY, Grid $grid)
    {
        $this->grid = $grid;
        $this->positionX = $positionX;
        $this->positionY = $positionY;
    }

    /**
     * @return bool
     */
    public function shouldMove(): bool
    {
        return $this->grid->pointIsOccupied($this->positionX, $this->positionY);
    }

    /**
     * @param int $positionX
     * @param int $positionY
     * @return bool
     */
    public function canMoveTo(int $positionX, int $positionY): bool
    {
        return !$this->grid->pointIsOccupied($positionX, $positionY)
            && $this->grid->pointIsWithinBounds($positionX, $positionY);
    }

    /**
     * @return void
     */
    public function moveToRandomUnoccupiedSpot(): void
    {
        $directions = [
            self::NORTH, self::EAST, self::SOUTH, self::WEST
        ];
        shuffle($directions);

        $positionX = $this->positionX;
        $positionY = $this->positionY;

        foreach($directions as $direction) {

            switch($direction) {
                case self::NORTH:
                    info('North');
                    $positionY += 2;
                    break;
                case self::EAST:
                    info('East');
                    $positionX += 2;
                    break;
                case self::SOUTH:
                    info('South');
                    $positionY -= 2;
                    break;
                case self::WEST:
                    info('West');
                    $positionX -= 2;
                    break;
            }

            if($this->canMoveTo($positionX, $positionY)) {
                $this->positionX = $positionX;
                $this->positionY = $positionY;
                break;
            }
        }
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

}
