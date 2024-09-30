<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dobrodošli na KupujemProdajem Repliku</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-gray-100">

<div class="min-h-screen flex flex-col items-center justify-center bg-gray-100">
    <div class="max-w-lg w-full mx-auto text-center">
        <h1 class="text-4xl font-bold text-gray-900 mb-6">Dobrodošli na KupujemProdajem!</h1>
        <p class="text-gray-700 text-lg mb-8">
            Postavite oglase, pronađite najbolje ponude i povežite se sa drugim korisnicima.
        </p>

        @if (Route::has('login'))
            <div class="flex justify-center space-x-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700">
                        Prijava
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg shadow-md hover:bg-green-700">
                            Registracija
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</div>

</body>
</html>
