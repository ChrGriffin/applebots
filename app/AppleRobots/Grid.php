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
     * @param int $positionX
     * @param int $positionY
     * @return bool
     */
    public function pointIsOccupied(int $positionX, int $positionY): bool
    {
        return $this->trees
            ->filter(function (Tree $tree) use ($positionX, $positionY) {
                return $tree->occupiesCoordinates($positionX, $positionY);
            })
            ->isNotEmpty();
    }

    /**
     * @param int $positionX
     * @param int $positionY
     * @return bool
     */
    public function pointIsWithinBounds(int $positionX, int $positionY): bool
    {
        return $positionX > 0 && $positionX < $this->width && $positionY > 0 && $positionY < $this->height;
    }
}
