<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horse extends Model
{
    use HasFactory;

    public static function updateafter($result)
    {
        $id = $result;

        $horse = Horse::find($id);
        $horse->wins = $horse->wins + 1;
        $horse->update();

        $horses = Horse::all();
        foreach ($horses as $key => $horse) {
            $horse->runs = $horse->runs +1;
            $horse->koeficient = round((($horse->runs/($horse->wins+25))+0.01),2);
            $horse->update(); 
        }
        
        
    }
}
