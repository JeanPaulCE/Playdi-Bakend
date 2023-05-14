<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/style.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@400;700&display=swap" rel="stylesheet">
    <title>Playdi</title>
</head>

<body>
    <header>
        <section>
            <nav>
                <img class="small" src="{{ asset('/imgs/logoPlaydi.png')}}">
            </nav>

            <div class="inner-col">
                <div class="mg">
                    <h1 class="title">¡Vamos a Jugar!</h1>
                    <p>Es un divertido juego de verdad o reto que puedes personalizar para disfrutar con familiares y Amigos.<br>
                        ¿Qué esperas para jugar?<br>
                        Diviértete con <span class="playdi">PLAY-D!</span></p>
                    <a href="{{ asset('playdi.apk') }}"> Descargar</a>
                </div>

                <div><img class="medium" src="{{ asset('imgs/iluatrationPlaydi.png') }}"></div>
            </div>
        </section>
    </header>
</body>

</html>