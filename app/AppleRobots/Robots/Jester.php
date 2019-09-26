<?php

namespace App\AppleRobots\Robots;

use App\AppleRobots\Actions\ActionInterface;
use App\AppleRobots\Actions\Move;
use App\AppleRobots\Actions\Plant;
use App\AppleRobots\Directions\DirectionInterface;
use App\AppleRobots\Position;
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

            return new Move($this->position);
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
        return $this->grid->pointIsOccupied($this->position);
    }

    /**
     * @param Position $position
     * @return bool
     */
    public function canMoveTo(Position $position): bool
    {
        return !$this->grid->pointIsOccupied($position)
            && $this->grid->pointIsWithinBounds($position);
    }

    /**
     * @return Jester
     */
    public function moveToRandomUnoccupiedSpot(): Jester
    {
        $directions = $this->directions;
        shuffle($directions);

        /** @var DirectionInterface $direction */
        foreach($directions as $direction) {

            $newPosition = $direction->transformPosition($this->position->toArray(), 2);
            $newPosition = new Position($newPosition['x'], $newPosition['y']);

            if($this->canMoveTo($newPosition)) {
                $this->position->setPosition($newPosition->getPositionX(), $newPosition->getPositionY());
                break;
            }
        }

        return $this;
    }
}
