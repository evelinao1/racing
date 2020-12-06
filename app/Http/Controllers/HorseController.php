<?php

namespace App\Http\Controllers;

use App\Models\Horse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HorseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $horses = Horse::all()->sortBy("name");
        return view('horses.index',['horses'=>$horses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('horses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'name' => ['required','unique:horses','alpha_num','min:3','max:10'],
            'runs' => ['required','numeric','min:0','max:50'],
            'wins' => ['required','numeric','min:0','max:50','lte:runs'],
        ],
        [
            'name.required' => 'Žirgo vardas privalomas',
            'name.unique' => 'Žirgo vardas turi būti unikalus',
            'name.min' => 'Žirgo vardas per trumpas',
            'name.max' => 'Žirgo vardas per ilgas',
            'name.alpha_num' => 'Žirgo vardas turi būti sudarytas tik iš raidžių ir/arba skaičių',

            'runs.required' => 'Lenktynių skaičius privalomas',
            'runs.numeric' => 'Lenktynių skaičius turi būti išreikštas skaičiais',
            'runs.min' => 'Minimalus lenktynių skaičius yra 0',
            'runs.max' => 'Maksimalus lenktynių skaičius yra 50',

            'wins.required' => 'Laimėtų lenktynių skaičius privalomas',
            'wins.numeric' => 'Laimėtų lenktynių turi būti išreikštas skaičiais',
            'wins.lte' => 'Laimėtų lenktynių  skaičiais turi būti mažesnis už visų lenktynių skaičių',
            'wins.min' => 'Minimalus laimėtų lenktynių yra 0',
            'wins.max' => 'Maksimalus laimėtų lenktynių yra 50',
        ]);
            if($validator->fails()){
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }
        $horse = new Horse();
        $horse->name = ucwords(strtolower($request->name));
        $horse->runs = $request->runs;
        $horse->wins = $request->wins;
        $horse->koeficient = round((($request->runs/($request->wins+25))+0.01),2);
        $horse->about = $request->about;
        $horse->save();
        return redirect()->route('horse.index')->with('info_message','Žirgas pridėtas sėkmingai');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function show(Horse $horse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function edit(Horse $horse)
    {
        return view('horses.edit',["horse" =>$horse]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Horse $horse)
    {
        $validator = Validator::make($request->all(),
        [
            'name' => ['required','alpha_num', 'min:3','max:10'],
           
        ],
        [
            'name.required' => 'Žirgo vardas privalomas',
            // 'name.unique' => 'Žirgo vardas turi būti unikalus',
            'name.min' => 'Žirgo vardas per trumpas',
            'name.max' => 'Žirgo vardas per ilgas',
            'name.alpha_num' => 'Žirgo vardas turi būti sudarytas tik iš raidžių ir/arba skaičių',

            
        ]);
            if($validator->fails()){
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }
        $horse->name = $request->name;
        $horse->about = $request->about;
        $horse->update();
        return redirect()->route('horse.index')->with('info_message','Informacija apie žirgą pakeista sėkmingai');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Horse $horse)
    {
        $horse->delete();
        return redirect()->route('horse.index');
    }
    
    
}
