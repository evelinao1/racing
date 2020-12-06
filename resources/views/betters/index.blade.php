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
        <div class="col-start-5 col-span-2">
            <a href="{{ route('horse.index') }}">Rodyti žirgus</a>
        </div>
        <div class="col-start-7 col-span-2">
            <a href="{{ route('race.index') }}">Rodyti lenktynes</a>
        </div>
    </div>
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
                    @if(session()->has('info_message'))
                        <div class="text-purple-900">
                            {{session()->get('info_message')}}
                        </div>
                    @endif            
                        
            </div>
    </div>           
    <div class="grid grid-cols-12 gap-4 mt-5">
        <div class="col-start-2 col-span-5 lg:col-start-5">
            <p class="text-xl">Sukurti naują lažybininką</p>
            <form action="{{route('better.store')}}" method="post">
            <label for="name">Vardas:</label>
            <input class="bg-gray-100 rounded-md" type="name" id="name" name="name" value="{{ old('name') }}">
            <label for="surname">Pavardė:</label>
            <input class="bg-gray-100 rounded-md" type="surname" id="surname" name="surname" value="{{ old('surname') }}">
                        
            <x-jet-button class="ml-4">
                            {{ __('Sukurti') }}
                        </x-jet-button>
                @csrf
            </form>
        </div>
    </div>
    
    <div class="grid grid-cols-12 gap-4 mt-10">
        <div class="col-start-2 col-span-5 lg:col-start-5">
            <table class="table-auto bg-gray-100 rounded-md">
                <thead>
                
                    <tr>
                    <th class="px-2 py-2">Vardas</th>
                    <th class="px-2 py-2">Pavardė</th>
                    <th class="px-2 py-2">Statymas</th>
                    <th class="px-2 py-2">Laimėjimai</th>
                    <th class="px-2 py-2">Pasirinktas žirgas</th>
                    <th class="px-2 py-2">Redaguoti</th>
                    <th class="px-2 py-2">Trinti</th>
                </thead>
                
                @foreach ($betters as $better)
                
                <tbody>
                    <tr>
                    <td class="border px-2 py-1">{{$better->name}}</td>
                    <td class="border px-2 py-1">{{$better->surname}}</td>
                    <td class="border px-2 py-1">{{$better->bet}}</td>
                    <td class="border px-2 py-1">{{$better->totalbet}}</td>
                    <td class="border px-2 py-1">{{$better->horse_id}}</td>
                    <td class="border px-2 py-1"></form><form action="{{route('better.edit',$better)}}" method="get">
                            <button type="submit">Redaguoti</button>
                    <td class="border px-2 py-1"></form><form action="{{route('better.destroy',$better)}}" method="post">
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