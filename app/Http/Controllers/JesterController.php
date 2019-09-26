<?php

namespace App\Http\Controllers;

use App\AppleRobots\Grid;
use App\AppleRobots\Position;
use App\AppleRobots\Robots\Jester;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JesterController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function index(Request $request)
    {
        $grid = new Grid($request->input('field'));
        $position = new Position($request->input('x'), $request->input('y'));
        $jester = new Jester($position, $grid);

        return response()->json($jester->act()->toArray());
    }
}
