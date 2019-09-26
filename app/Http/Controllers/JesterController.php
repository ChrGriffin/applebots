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
        $jester = new Jester(
            new Position($request->input('x'), $request->input('y')),
            new Grid($request->input('field'))
        );

        return response()->json($jester->act()->toArray());
    }
}
