<?php
use App\Models\Horse;
$horses = Horse::all()->sortBy("name");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sukurti žirgą</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-200">
<div class="grid grid-cols-12 gap-4 mt-5">
        <div class="col-start-5 col-span-5">
            @if ($errors->any())
                <div class="text-red-500">
                    <ul class="list-group">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
        </div>
</div>               
<div class="grid grid-cols-12 gap-4 mt-5">
        <div class="col-start-5 col-span-5">
            <p class="text-2xl">Pasirinkti žirgą ir statomą sumą</p>
            <form action="{{route('race.updatebet', $better)}}" method="post">
            <label for="bet">Satymas:</label><br>
            <input class="bg-gray-100 rounded-md" type="bet" id="bet" name="bet" value="{{ old('bet') }}"><br><br>
            <label for="horse_id">Pasirinkti žirgą:</label><br>
            <select class="bg-gray-100 rounded-md" id="horse_id" name="horse_id">
                    <?php foreach ($horses as $horse){ 
                        
                    ?>
                    
                    <option value="<?=$horse->id?>"><?php echo $horse->name?></option>
                <?php }?>
                </select>            
            <x-jet-button class="ml-4">
                            {{ __('Statyti') }}
                        </x-jet-button>
                @csrf
            </form>
        </div>
    </div>
</body>
</html>