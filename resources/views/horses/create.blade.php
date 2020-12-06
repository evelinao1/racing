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
            <p class="text-2xl">Sukurti naują žirgą</p>
            <form action="{{route('horse.store')}}" method="post">
            <label for="name">Vardas:</label><br>
            <input class="bg-gray-100 rounded-md" type="name" id="name" name="name" value=""><br><br>
            <label for="runs">Bėgimų sk.:</label><br>
            <input class="bg-gray-100 rounded-md" type="runs" id="runs" name="runs" value=""><br><br>
            <label for="wins">Laimėjimų sk.:</label><br>
            <input class="bg-gray-100 rounded-md" type="wins" id="wins" name="wins" value=""><br><br>
            <label for="about">Apibūdinimas:</label><br>
            <input class="bg-gray-100 rounded-md" type="about" id="about" name="about" value=""><br><br>
            
            <x-jet-button class="ml-4">
                            {{ __('Sukurti') }}
                        </x-jet-button>
                @csrf
            </form>
        </div>
    </div>
</body>
</html>