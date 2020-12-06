<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horse;
use App\Models\Better;
use App\Http\Controllers\HorseController;

class RaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $horses = Horse::all()->sortBy("name");
        $betters = Better::all()->sortBy("name");
        return view('index', ['horses'=>$horses,'betters'=>$betters]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $horses = Horse::all();
        // $h = [];
        // foreach ($horses as $key => $horse) {
        //     array_push($h, $horse->id);
        // }
        // $key = (array_rand($h,1));
        // $result =  $h[$key];

        $horse = Horse::inRandomOrder()->first();
        $result = $horse->id;
        Better::updatewin($result);
        Horse::updateafter($result);

        // $horse = Horse::find($result);
        return redirect()->route('race.index')->with('info_message','Lenktynes laimėjo '.$horse->name);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
