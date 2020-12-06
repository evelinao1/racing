<?php
use App\Models\Horse;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lažybininkai</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="bg-gray-200">
    <div class="grid grid-cols-12 gap-4 mt-20">
        <div class="col-start-10 col-span-1">
            <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <a href="{{ route('logout') }}"
                                                            onclick="event.preventDefault();
                                                                        this.closest('form').submit();">
                                            {{ __('Logout') }}
                                        </a>
            </form>
        </div>
    </div>
    
    <div class="grid grid-cols-12 gap-4 mt-10">
        <div class="col-start-2 col-span-2">
            <a href="{{ route('better.index') }}">Rodyti lažybibibkus</a>
        </div>
        <div class="col-start-4 col-span-3 xl:col-start-7">
            <form action="{{route('race.create')}}" method="get">
                <x-jet-button class="ml-4">
                                {{ __('Pradėti lenktynes') }}
                            </x-jet-button>
                            @csrf
            </form>       
        </div>
        <div class="col-start-7 col-span-2 xl:col-start-10">
            <a href="{{ route('horse.index') }}">Rodyti žirgus</a>
        </div>
    </div>
    <div class="grid grid-cols-12 gap-4 mt-10">
        <div class="col-start-7 col-span-5">
            @if(session()->has('info_message'))
                <div class="text-purple-900">
                    {{session()->get('info_message')}}
                </div>
            @endif
        </div>
    </div>
    <div class="grid grid-cols-12 gap-4 mt-10">
        <div class="col-start-2 col-span-5">
            <form action="{{route('race.sort')}}" method="post">
                <label id="pusher" for="cars">Rodyti lažybininkus, kurie pasirinko žirgą:</label>
                <select name="horse_id" id="horse_id" class="bg-gray-100 rounded-md">
                    @foreach ($horses as $horse)
                    <option  value="{{$horse->id}}">{{$horse->name}}</option>
                    @endforeach
                </select>
                <x-jet-button class="ml-4">
                                    {{ __('Pasirinkti') }}
                                </x-jet-button>
                @csrf
            </form> 
        </div>
    </div>
    <div class="grid grid-cols-12 gap-4 mt-10">
        <div class="col-start-2 col-span-5">
            <table class="table-auto bg-gray-100 rounded-md">
                <thead>
                
                    <tr>
                    <th class="px-2 py-2">Vardas</th>
                    <th class="px-2 py-2">Pavardė</th>
                    <th class="px-2 py-2">Statymas</th>
                    <th class="px-2 py-2">Laimėjimai</th>
                    <th class="px-2 py-2">Pasirinktas žirgas</th>
                    <th class="px-2 py-2">Dalyvauti lenktynėse</th>
                    
                </thead>
                
                @foreach ($betters as $better)
                
                <tbody>
                    <tr>
                    <td class="border px-2 py-1">{{$better->name}}</td>
                    <td class="border px-2 py-1">{{$better->surname}}</td>
                    <td class="border px-2 py-1">{{$better->bet}}</td>
                    <td class="border px-2 py-1">{{$better->totalbet}}</td>
                    <td class="border px-2 py-1">{!!Horse::where('id', '=', $better->horse_id)->value('name')!!}</td>
                    <td class="border px-2 py-1"></form><form action="{{route('race.edit',$better)}}" method="get">
                            <button type="submit">Dalyvauti</button>
    
                            @csrf
                            </form></td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
        <div class="col-start-2 col-span-4 xl:col-start-8">
            <table class="table-auto bg-gray-100 rounded-md">
                <thead>
                
                    <tr>
                    <th class="px-2 py-2">Vardas</th>
                    <th class="px-2 py-2">Bėgimų skaičius</th>
                    <th class="px-2 py-2">Laimėjimų skaičius</th>
                    <th class="px-2 py-2">Koeficientas</th>
                    <th class="px-2 py-2">Informacija</th>
                    </tr>
                </thead>
                
                @foreach ($horses as $horse)
                
                <tbody>
                    <tr>
                    <td class="border px-2 py-1">{{$horse->name}}</td>
                    <td class="border px-2 py-1">{{$horse->runs}}</td>
                    <td class="border px-2 py-1">{{$horse->wins}}</td>
                    <td class="border px-2 py-1">{{$horse->koeficient}}</td>
                    <td class="border px-2 py-1">{{$horse->about}}</td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
</body>

</html>