<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <p class="text-2xl">Pakeisti informaciją apie žirgą</p>
        <form action="{{route('horse.update', $horse)}}" method="post">
        <label for="name">Vardas:</label><br>
        <input class="bg-gray-100 rounded-md" type="name" id="name" name="name" value="{{old('name', $horse->name)}}"><br><br>
        <label for="about">Apibūdinimas:</label><br>
        <textarea class="bg-gray-100 rounded-md" rows="4" cols="50" name="about">{{$horse->about}}</textarea>
        
        
        <x-jet-button class="ml-4">
                        {{ __('Pakeisti') }}
                    </x-jet-button>
            @csrf
        </form>
    </div>
</div>

</body>
</html>