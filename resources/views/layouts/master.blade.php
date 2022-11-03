<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Amber van Ham is an Antwerp based artist who tries to grasp the blurry field of tension, objective experiences and the subjective values which derive from it." />
    <meta name="keywords" content="artist, Antwerp, drawing, pencil, pencildrawing, art, belgian art, black and white, pencil on paper">
    <meta name="author" content="Vic Denys">

    <title>
        Amber van Ham - 
    </title>

    <x-favicon></x-favicon>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">


    <script src="{{ mix('js/app.js') }}" defer></script>

</head>


<body class="antialiased cursor-none noscrollbar bg-white">

    <div class=" h-full font-bazovy" @resize.window="menuOpen = false">
        @include('layouts.navigation-guest', ['isDarkTheme' => isset($isDarkTheme), 'isAboutNav' => false])



        <!-- Page Content -->
        <main>
            @yield('content')
        </main>



    </div>

    <div id="mouse" class="fixed z-[1000] transform -translate-x-1/2 -translate-y-1/2 w-4 h-4  rounded-full pointer-events-none bg-red-500">

    </div>



</body>

</html>