<?php

namespace App;

class Grid
{
    private $width;
    private $height;
    private $trees;

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

    public function pointIsOccupied($positionX, $positionY)
    {
        return $this->trees
            ->filter(function (Tree $tree) use ($positionX, $positionY) {
                return $tree->occupiesCoordinates($positionX, $positionY);
            })
            ->isNotEmpty();
    }

    public function pointIsWithinBounds($positionX, $positionY)
    {
        return $positionX > 0 && $positionX < $this->width && $positionY > 0 && $positionY < $this->height;
    }
}
