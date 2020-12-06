<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurants</title>
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
        <div class="col-start-5 col-span-3">
            <a href="{{ route('horse.create') }}">Sukurti naują arklį</a>
        </div>
        <div class="col-start-8 col-span-2">
            <a href="{{ route('better.index') }}">Rodyti lažybininkus</a>
        </div>
    </div>
    <div class="grid grid-cols-12 gap-4 mt-10">
        <div class="col-start-5 col-span-5">
                @if(session()->has('info_message'))
                    <div class="text-purple-900">
                        {{session()->get('info_message')}}
                    </div>
                @endif
        </div>
    </div>    
    <div class="grid grid-cols-12 gap-4 mt-10">
        <div class="col-start-2 col-span-5 lg:col-start-5">
            <table class="table-auto bg-gray-100 rounded-md">
                <thead>
                
                    <tr>
                    <th class="px-2 py-2">ID</th>
                    <th class="px-2 py-2">Vardas</th>
                    <th class="px-2 py-2">Bėgimų skaičius</th>
                    <th class="px-2 py-2">Laimėjimų skaičius</th>
                    <th class="px-2 py-2">Koeficientas</th>
                    <th class="px-2 py-2">Informacija</th>
                    <th class="px-2 py-2">Redaguoti</th>
                    <th class="px-2 py-2">Trinti</th>
                </thead>
                
                @foreach ($horses as $horse)
                
                <tbody>
                    <tr>
                    <td class="border px-2 py-1">{{$horse->id}}</td>
                    <td class="border px-2 py-1">{{$horse->name}}</td>
                    <td class="border px-2 py-1">{{$horse->runs}}</td>
                    <td class="border px-2 py-1">{{$horse->wins}}</td>
                    <td class="border px-2 py-1">{{$horse->koeficient}}</td>
                    <td class="border px-2 py-1">{{$horse->about}}</td>
                    <td class="border px-2 py-1"></form><form action="{{route('horse.edit',$horse)}}" method="get">
                            <button type="submit">Redaguoti</button>
                    <td class="border px-2 py-1"></form><form action="{{route('horse.destroy',$horse->id)}}" method="post">
                            <button type="submit">Trinti</button>
                            @csrf
                            </form></td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
</body>

</html>