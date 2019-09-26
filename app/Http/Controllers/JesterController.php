<?php

namespace App\Http\Controllers;

use App\Grid;
use App\Robots\Jester;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JesterController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $grid = new Grid($request->input('field'));
        $jester = new Jester($request->input('x'), $request->input('y'), $grid);
        if($jester->shouldMove()) {

            for($i = 0; $i < random_int(4, 5); $i++) {
                $jester->moveToRandomUnoccupiedSpot();
            }

            return response()->json([
                'action' => 'move',
                'dest' => $jester->getPosition()
            ]);
        }
        else {
            return response()->json([
                'action' => 'plant'
            ]);
        }
    }
}
