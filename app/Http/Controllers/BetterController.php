<?php

namespace App\Http\Controllers;

use App\Models\Better;
use App\Models\Horse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $betters = Better::all()->sortBy("name");
        return view('betters.index',['betters'=>$betters]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => ['required','alpha','min:3','max:15'],
            'surname' => ['required','alpha','min:3','max:50'],
            
        ],
        [
            'name.required' => 'Lažybininko vardas privalomas',
            'name.min' => 'Lažybininko vardas per trumpas, turi būti bent 3 raidės',
            'name.max' => 'Lažybininko vardas per ilgas, turi būti nedaugiau, kaip 50 raidžių',
            'name.alpha' => 'Lažybininko vardas turi būti sudarytas tik iš raidžių',

            'surname.required' => 'Lažybininko pavardė privaloma',
            'surname.min' => 'Lažybininko pavardė per trumpa, turi būti bent 3 raidės',
            'surname.max' => 'Lažybininko pavardė per ilga, turi būti nedaugiau, kaip 50 raidžių',
            'surname.alpha' => 'Lažybininko pavardė turi būti sudaryta tik iš raidžių',
            
        ]);
            if($validator->fails()){
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }
        $better = new Better();
        $better->name = ucwords(strtolower($request->name));
        $better->surname = ucwords(strtolower($request->surname));
        $better->bet = 0;
        $better->totalbet = 0;
        $better->save();
        return redirect()->route('better.index')->with('info_message','Naujas lažybininkas pridėtas sėkmingai');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Better  $better
     * @return \Illuminate\Http\Response
     */
    public function show(Better $better)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Better  $better
     * @return \Illuminate\Http\Response
     */
    public function edit(Better $better)
    {
        
        return view('betters.edit',['better'=>$better]);
    }
    public function editbet(Better $better)
    {
        
        return view('betters.editbet',['better'=>$better]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Better  $better
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Better $better)
    {
        $validator = Validator::make($request->all(),
        [
            'name' => ['required','alpha','min:3','max:15'],
            'surname' => ['required','alpha','min:3','max:50'],
            
        ],
        [
            'name.required' => 'Lažybininko vardas privalomas',
            'name.min' => 'Lažybininko vardas per trumpas, turi būti bent 3 raidės',
            'name.max' => 'Lažybininko vardas per ilgas, turi būti nedaugiau, kaip 50 raidžių',
            'name.alpha' => 'Lažybininko vardas turi būti sudarytas tik iš raidžių',

            'surname.required' => 'Lažybininko pavardė privaloma',
            'surname.min' => 'Lažybininko pavardė per trumpa, turi būti bent 3 raidės',
            'surname.max' => 'Lažybininko pavardė per ilga, turi būti nedaugiau, kaip 50 raidžių',
            'surname.alpha' => 'Lažybininko pavardė turi būti sudaryta tik iš raidžių',
            
        ]);
            if($validator->fails()){
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }
        $better->name = $request->name;
        $better->surname = $request->surname;
        $better->update();
        return redirect()->route('better.index')->with('info_message','Informacija apie lažybininką pakeista sėkmingai');
    }
    public function updatebet(Request $request, Better $better)
    {
        $request->merge(['bet' => str_replace(",",".",$request->bet)]);
        $validator = Validator::make($request->all(),
        [
            'bet' => ['required','numeric','min:1','max:10000'],
            
            
        ],
        [
            'bet.required' => 'Statoma suma privaloma',
            'bet.min' => 'Statoma suma turi būti nors 1 €',
            'bet.max' => 'Statoma suma negali viršyti 10 000 €',
            'bet.numeric' => 'Statoma suma turi būti išreikšta skaičiais',

            
        ]);
            if($validator->fails()){
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }
        $better->bet = str_replace(",",".",$request->bet);
        $better->horse_id = $request->horse_id;
        $better->update();
        return redirect()->route('race.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Better  $better
     * @return \Illuminate\Http\Response
     */
    public function destroy(Better $better)
    {
        $better->delete();
        return redirect()->route('better.index');
    }

    public function sort(Request $request)
    {
        $horses = Horse::all()->sortBy("name");
        $id = $request->horse_id;
        $betters = Better::where('horse_id', '=', $id)-> get();

        return view('index', ['horses'=>$horses,'betters'=>$betters]);
        // return view ('restaurants.sorted',['sortrestaurants' => $sortbetters]);
    }
}
