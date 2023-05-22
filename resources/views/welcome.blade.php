<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('/css/style.css')}}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@400;700&display=swap" rel="stylesheet" />
    <link id="favicon" rel="shortcut icon" type="image/png" href="{{ asset('/imgs/logoPlaydiMin.png')}}">
    <title>Playdi</title>
</head>

<body>
    <header id="home">
        <nav>
            <div class="logo">
                <img src="{{ asset('/imgs/logoPlaydiMin.png')}}" alt="" />
                <h1>Play-D!</h1>
            </div>
            <div class="opciones">
                <div class="link-container"><a href="#hero">Inicio</a></div>
                <div class="link-container"><a href="#tutorial">Tutorial</a></div>
                <div class="link-container"><a href="#equipo">Equipo</a></div>
            </div>
        </nav>
    </header>
    <main>
        <section id="hero">
            <div class="content-hero">
                <div class="col">
                    <h2 class="title">¡Vamos a Jugar!</h2>
                    <p>
                        Es un divertido juego de verdad o reto que puedes
                        personalizar para disfrutar con familiares y Amigos.¿Qué
                        esperas para jugar?Diviértete con PLAY-D!
                    </p>
                    <a class="btn" href="{{ asset('/playdi.apk')}}">
                        Descargar
                    </a>
                </div>
                <div class="col ">
                    <img src="{{ asset('/imgs/iluatrationPlaydi.png')}}" alt="" />
                </div>
            </div>
        </section>
        <section id="tutorial">
            <h2 class="title">Tutorial</h2>
            <div class="card-container">
                <div class="card">
                    <div class="text-col">
                        <p class="numero amarillo">1</p>
                        <h3>Registrarse</h3>
                        <p>
                            Puedes crearte una cuenta para respaldar el
                            contenido personalizado que crees, solo
                            requieres un correo para esto y podrás acceder a
                            tu contenido desde cualquier dispositivo, no es
                            necesario internet para jugar pero sí para
                            registrarse
                        </p>
                    </div>
                    <div class="image-col">
                        <div class="circulo"> <img class="mockup" src=" {{ asset('/imgs/tutorial-1.png')}}" alt="" /></div>
                    </div>
                </div>
                <div class="card">
                    <div class="image-col">
                        <div class="circulo"> <img class="mockup" src=" {{ asset('/imgs/tutorial-1.png')}}" alt="" /></div>
                    </div>
                    <div class="text-col derecha">
                        <p class="numero verde">2</p>
                        <h3>Inicia sesión</h3>
                        <p>
                            Accede a tu cuenta recién creada, podrá acceder al contenido base del juego y empezar a personalizar después de haber iniciado sesión, ya no requieres internet para jugar solo para respaldar tu información, lo cual sucede automáticamente
                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="text-col">
                        <p class="numero morado">3</p>
                        <h3>Crea tus categorías</h3>
                        <p>
                            La creación de distintas categorías para tus retos es una excelente manera de mantener un mayor orden y organización a la hora de jugar. Al clasificar los retos en diferentes categorías, podrás acceder fácilmente a ellos y elegir según la situación.
                        </p>
                    </div>
                    <div class="image-col">
                        <div class="circulo"> <img class="mockup" src=" {{ asset('/imgs/tutorial-1.png')}}" alt="" /></div>
                    </div>
                </div>
                <div class="card">
                    <div class="image-col">
                        <div class="circulo"> <img class="mockup" src=" {{ asset('/imgs/tutorial-1.png')}}" alt="" /></div>
                    </div>
                    <div class="text-col derecha">
                        <p class="numero amarillo">4</p>
                        <h3>Crea tus retos</h3>
                        <p>
                            Una forma emocionante y personalizada de añadir más diversión y desafío a tus juegos es crear tus propios retos y castigos personalizados. Al hacerlo, puedes adaptar los desafíos según tus preferencias y establecer consecuencias únicas para hacerlo más interesantes.
                        </p>
                    </div>

                </div>
            </div>
        </section>
        <div class="play-container">
            <h2>¡A Jugar!</h2>
            <div>
                <div>
                    <div>
                        <h3>Elige categoría</h3>
                    </div>
                    <img src="{{ asset('/imgs/elegir-categoria.png')}}" alt="">
                </div>
                <div>
                    <div>
                        <h3>Añade jugadores</h3>
                    </div>
                    <img src="{{ asset('/imgs/añadir-jugadores.png')}}" alt="">
                </div>
                <div>
                    <div>
                        <h3>Diviertete</h3>
                    </div>
                    <img src="{{ asset('/imgs/jugar.png')}}" alt="">
                </div>
            </div>
        </div>
        <section id="team">

            <h2>Equipo</h2>
            <div class="team-cards">
                <div class="team-card">
                    <p>Yariana Ulate</p>
                    <p>Product Owner</p>
                </div>

                <div class="team-card">
                    <p>Jean Paul Carvajal</p>
                    <p>Scrum Master</p>
                    <p>Desarrollador</p>
                </div>

                <div class="team-card">
                    <p>Jasir Carvajal</p>
                    <p>Desarrollador</p>
                </div>

                <div class="team-card">
                    <p>Naomi Naith</p>
                    <p>QA</p>
                </div>

                <div class="team-card">
                    <p>Scoth Daniel Chavarría</p>
                    <p>Diseñdor</p>
                </div>
            </div>

            <div class="container-play-free">
                <h2>Juega Gratis</h2>
                <p>Personaliza y disfruta jugando con tus amigos y familia a tu manera</p>
                <a href="{{ asset('/playdi.apk')}}">Descargar</a>
            </div>
        </section>
    </main>
    <footer>
        <div>
            <div class="footer-first-container">
                <div class="logo">
                    <img src="{{ asset('/imgs/logoPlaydiMin.png')}}" alt="">
                    <p>PLAY-D!</p>
                </div>
                <p class="contacto">CONTACTO</p>
                <p class="correo">playdi@jeanpidev.com</p>
            </div>
            <p>Este proyecto fue creado bajo <br> el contexto del curso Taller <br> Multimedia de la carrera de <br> Informática y
                Tecnología <br> Multimedia</p>
            <p>Creditos por recursos: <br>
                Mockups templates by <br> zlatko_plamenov on Freepik</p>
        </div>

        <p>© 2022 All Rights Reserved - Playdi</p>

    </footer>

</body>

</html>