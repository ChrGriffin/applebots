<?php

namespace App\AppleRobots\Directions;

class West implements DirectionInterface
{
    /**
     * @param array $position
     * @param int $distance
     * @return array
     */
    public function transformPosition(array $position, int $distance): array
    {
        return [
            'x' => $position['x'] - $distance,
            'y' => $position['y']
        ];
    }
}
