<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PROGRAMA PROTEGER</title>
        <link rel="stylesheet" href="<?php echo base_url('css/miestilo.css'); ?>">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    
       <body>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <header>
            <div class="header-top">
                <img src="<?php echo base_url('images/logoproteger.jpg'); ?>" alt="logo de la fundacion">
            </div>
        <p class="importante">Somos personas que habitamos en un tiempo y un espacio y en él vivimos y lo cuidamos</p>
        <nav>
            <ul>
                <li><a href="#dónde">Dónde</a></li>
                <li><a href="#cuando">Cuándo</a></li>
                <li><a href="#quienes">Quienes</a></li>
            </ul>
        </nav>
    </header>            
    <main>
        <div class="content-wrapper">
           <section> <?php echo view('usuarios/crear'); ?> </section>

                <h2>OBJETIVOS</h2>
                <p>Desarrollar una estrategia de mejora en la accesibilidad a políticas Sociales, Sanitarias, Educativas y ambientales de los asentamientos de la ciudad de Corrientes </p>
                <p> Organizar las acciones necesarias para dotar de accesibilidad a los servicios Sociales, Sanitarios, Educativos y Ambientales a 3400 familias; poniendo el foco en la asistencia a mujeres, embarazadas, niños, adolescentes y personas vulnerables.
Mejorar la gobernabilidad en estos territorios. Potenciar capacidades para el desarrollo de la empleabilidad. Capacitar en organización Comunitaria y liderazgo a líderes barriales 
</p>
            </section>
            
            <section id="dónde">
                <h2>CORRIENTES CAPITAL</h2>Asentamientos de los barrios Caridi, Quilmes, Santa Marta, Patono 1 y 2, Galvan 3, La Tosquera, San Jorge, San Roque Este, El Pinal, Fray Jose de la Quintana, Dr. Montaña, Pirayui, Costa Esperanza, Villa Tarima, Ciudades Correntinas, Ponce, Santa Rita Sur, Piragine, Taitalo, Sol de Mayo, Anahi, Bañado Norte y Cichero.
            </section>
            
            <section id="quienes">
                <h2>Quienes Somos</h2>
                <p>Buscamos consolidar los avances en la intervención en el territorio, sumando a la asistencia y gobernabilidad ya consolidada a temáticas que incidan en el desarrollo comunitario y social, sentando las bases de un desarrollo de la economía local, del concepto de ciudadanía y de la integración creciente a la ciudad</p>
                    <img src="images/collage.jpg" alt="collage">
            </section>
        
            <section id="final">
                <h2>Reflexión final</h2>
                <p>somos primates</p>
                <p>somos practicantes de programación</p>
                <a href="https://talentosdigitales.ar/" target="_blank" rel="noopener noreferrer">Talentos Digitales</a>
            </section>
        </div>        
    </main>
    <footer>
        <div class="footer-content">
            <p>Aqui finaliza la web</p> 
            <p>Visita nuestro motor de búsqueda favorito: <a href="https://www.google.com" target="_blank" rel="noopener noreferrer">Google</a></p>
        </div>
    </footer>