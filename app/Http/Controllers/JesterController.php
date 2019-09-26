<?php

namespace App\Http\Controllers;

use App\AppleRobots\Grid;
use App\AppleRobots\Robots\Jester;
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

        return response()->json($jester->act());
    }
}
