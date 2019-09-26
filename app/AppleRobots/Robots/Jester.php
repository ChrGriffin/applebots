<?php

namespace App\AppleRobots\Robots;

use Exception;

class Jester extends Robot
{
    /**
     * @return array
     * @throws Exception
     */
    public function act(): array
    {
        if($this->shouldMove()) {

            for($i = 0; $i < random_int(4, 5); $i++) {
                $this->moveToRandomUnoccupiedSpot();
            }

            return [
                'action' => 'move',
                'dest' => $this->getPosition()
            ];
        }
        else {
            return [
                'action' => 'plant'
            ];
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
}
