<?php

namespace App\AppleRobots\Robots;

use App\AppleRobots\Actions\ActionInterface;
use App\AppleRobots\Actions\Move;
use App\AppleRobots\Actions\Plant;
use Exception;

class Jester extends Robot
{
    /**
     * @return ActionInterface
     * @throws Exception
     */
    public function act(): ActionInterface
    {
        if($this->shouldMove()) {

            for($i = 0; $i < random_int(4, 5); $i++) {
                $this->moveToRandomUnoccupiedSpot();
            }

            return new Move($this->positionX, $this->positionY);
        }
        else {
            return new Plant;
        }
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
                    $positionY += 2;
                    break;
                case self::EAST:
                    $positionX += 2;
                    break;
                case self::SOUTH:
                    $positionY -= 2;
                    break;
                case self::WEST:
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
}
