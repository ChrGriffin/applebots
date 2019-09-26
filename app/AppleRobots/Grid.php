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
     * @param int $width
     * @param int $height
     * @param array $trees
     * @return void
     */
    public function __construct(int $width, int $height, array $trees)
    {
        $this->width = $width;
        $this->height = $height;
        $this->trees = collect($trees)
            ->map(function (array $tree) {
                return new Tree(
                    new Position($tree['position']['x'], $tree['position']['y']),
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
                return $tree->occupiesPosition($position);
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
