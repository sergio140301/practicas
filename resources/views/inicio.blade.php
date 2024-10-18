<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite(['resources/js/app.js'])

    <title>Practica 5</title>

    <style>
        body {
            background-color: #000000;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .hero-section {
            background-size: cover;
            background-position: center;
            padding: 50px;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            flex: 1;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .hero-text {
            font-size: 1rem;
            max-width: 600px;
            margin: auto;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>

<body>

        @include('menu')

        <section class="hero-section" style="background-color: #000000;">
            <div class="text-center">
                <h1 class="hero-title">PRACTICA 5</h1>
                <h2 class="hero-subtitle">BIENVENIDO INVITADO <br> INICIA SESION O REGISTRATE</h2>
            </div>
        </section>
        <div class="container my-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Información Importante</h5>
                    <p class="card-text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt nihil hic ipsum, <br>
                        iusto culpa voluptatem laborum vitae iure numquam animi velit rem quam nesciunt officiis <br>
                        magni! Vel quia veritatis dicta?
                    </p>
                    <p class="card-text">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore, officia! Obcaecati, <br>
                        fugit rem molestiae earum maxime eveniet. Consequatur maiores consectetur dolor nostrum. <br>
                        Ullam aut ut incidunt tempora veritatis dolor quaerat.
                    </p>
                </div>
            </div>
        </div>


    @yield('contenido1')

    @include('piedepagina')

    <footer>
        <p>© 2024 Sergio Abraham Valdes Escamilla. Todos los derechos reservados.</p>
    </footer>

</body>

</html>
