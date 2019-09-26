<?php

namespace App\AppleRobots\Directions;

interface DirectionInterface
{
    public function transformPosition(array $position, int $distance): array;
}
