<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivityController extends Controller
{


    public function index(Request $request)
    {
        $params = $request->all();
        // dd($params);
        $message = isset($params['message']) ? $params['message'] : '';

        return View('myactivities', [
            'username' => auth()->user()->name,
            'activities' => auth()->user()->activities->all(),
            'count' => auth()->user()->activities->count(),
            'message' => $message,
        ]);
    }

}
