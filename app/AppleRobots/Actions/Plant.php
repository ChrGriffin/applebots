<?php

namespace App\AppleRobots\Actions;

class Plant implements ActionInterface
{

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'action' => 'plant'
        ];
    }
}
