<?php

namespace App\AppleRobots\Directions;

class South implements DirectionInterface
{
    /**
     * @param array $position
     * @param int $distance
     * @return array
     */
    public function transformPosition(array $position, int $distance): array
    {
        return [
            'x' => $position['x'],
            'y' => $position['y'] - $distance
        ];
    }
}
