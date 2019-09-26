<?php

namespace App\AppleRobots;

use Illuminate\Support\Collection;

class Grid
{
    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;

    /**
     * @var Collection
     */
    private $trees;

    /**
     * @param array $field
     * @return void
     */
    public function __construct(array $field)
    {
        $this->width = $field['fieldSize']['width'];
        $this->height = $field['fieldSize']['height'];
        $this->trees = collect($field['trees'])
            ->map(function (array $tree) {
                return new Tree(
                    $tree['position']['x'],
                    $tree['position']['y'],
                    $tree['radius']
                );
            });
    }

    /**
     * @param Position $position
     * @return bool
     */
    public function pointIsOccupied(Position $position): bool
    {
        return $this->trees
            ->filter(function (Tree $tree) use ($position) {
                return $tree->occupiesCoordinates($position->getPositionX(), $position->getPositionY());
            })
            ->isNotEmpty();
    }

    /**
     * @param Position $position
     * @return bool
     */
    public function pointIsWithinBounds(Position $position): bool
    {
        return $position->getPositionX() > 0 && $position->getPositionX() < $this->width
            && $position->getPositionY() > 0 && $position->getPositionY() < $this->height;
    }
}
