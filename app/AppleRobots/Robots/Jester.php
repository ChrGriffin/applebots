<?php

namespace App\AppleRobots\Robots;

use App\AppleRobots\Actions\ActionInterface;
use App\AppleRobots\Actions\Move;
use App\AppleRobots\Actions\Plant;
use App\AppleRobots\Directions\DirectionInterface;
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
     * @return Jester
     */
    public function moveToRandomUnoccupiedSpot(): Jester
    {
        $directions = $this->directions;
        shuffle($directions);

        $position = [
            'x' => $this->positionX,
            'y' => $this->positionY
        ];

        /** @var DirectionInterface $direction */
        foreach($directions as $direction) {

            $newPosition = $direction->transformPosition($position, 2);

            if($this->canMoveTo($newPosition['x'], $newPosition['y'])) {
                $this->setPosition($newPosition['x'], $newPosition['y']);
                break;
            }
        }

        return $this;
    }
}
