<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ActivityController extends Controller
{

    // Também é possível definir um midleware dentro de um Controller, no construtor.
    //public function __construct()
    //{
    //   $this->middleware(...)
    //}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $params = $request->all();


        // Como validar um limite máximo de 20 caracteres no parametro 'filterName'

        // Exemplo 1 - exibe erros na Blade com a variavel $errors
        // $request->validate([
        //     'filterName' => 'max:20',
        // ]);

        // Exemplo 2
        $validator = Validator::make($params, [
            'filterName' => 'max:20',
        ]);

        $filterName = isset($params['filterName']) ? $params['filterName'] : '';

        if($validator->fails())
        {
            $activities = auth()->user()->activities;

            //dd($validator->messages());

            $filterName = $validator->messages();
        }
        elseif($filterName != '')
        {
            $activities = DB::table('activities')
                ->where('user_id', auth()->user()->id)
                ->where('name', 'like', '%' . $filterName . '%')
                ->get();

            //dd($activities);
        }

        return View('myactivities', [
            'username' => auth()->user()->name,
            'activities' => $activities,
            'count' => $activities->count(),
            'filterName' => $filterName,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
