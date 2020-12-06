<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Horse;

class Better extends Model
{
    use HasFactory;

    public static function updatewin($result)
    {
        $id = $result;
        $horse = Horse::find($id);
        $k = $horse->koeficient;
        $betters = Better::all();
        foreach ($betters as $key => $better) {
            if($better->horse_id ==$id){
                $better->totalbet = $better->totalbet + ($better->bet*$k);
                $better->bet = 0;
                $better->horse_id = null;
                $better->update();
        }else {
                $better->bet = 0;
                $better->horse_id = null;
                $better->update();
        }
        }
        
    }
}
