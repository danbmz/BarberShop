<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BarberShop Elite</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="build/css/app.css">
</head>
<body>
    <header class="header">
        <div class="header-contenedor contenedor">
            <div class="nav-logo-contendedor">
                <a href="/" class="logo">
                    <p>*</p>
                    <h1>BarberShop</h1>
                </a>
            
                <nav class="nav">
                    <a href="/services">Servicios</a>
                    <a href="/aboutUs">Nosotros</a>
                    <a href="/contact">Contacto</a>
                    <a href="/login" class="login-button">iniciar sesión</a>   
                </nav>

                <div class="menu-despegable">
                    <p>Menu Despegable</p>
                </div>
            </div>
        </div>
    </header>

    <div class="contenedor-app">
        <div class="app">
            <?php echo $contenido; ?>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-contenedor contenedor">
            <div class="enlaces-contenedor">    
                <div class="redes-contenedor">
                    <div class="logo-footer">
                        <!-- Agregar SVG -->
                        <span>BarberShop Elite</span>
                    </div>
                    <p>El destino premium para el cuidado personal masculino. Estilo, elegancia y profesionalismo en cada servicio</p>
                    <div class="redes-sociales">
                        <a href="#">Facebook</a>
                        <a href="#">Instagram</a>
                        <a href="#">Youtube</a>
                    </div>
                </div>
                <div class="servicios-contenedor">
                    <h3>Servicios</h3>
                    <ul>
                        <li><a href="#">Corte de Cabello</a></li>
                        <li><a href="#">Arreglo de Barba</a></li>
                        <li><a href="#">Diseño de Ceja</a></li>
                        <li><a href="#">Tratamiento Facial</a></li>
                    </ul>
                </div>
                <div class="servicios-contenedor">
                    <h3>Enlaces</h3>
                    <ul>
                        <li><a href="/services">Servicios</a></li>
                        <li><a href="/aboutUs">Sobre nosotros</a></li>
                        <li><a href="/login">Reserva una cita</a></li>
                        <li><a href="/contact">¿Quieres trabajar con nosotros?</a></li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>2025 BarberShop Elite. Todos los derechos reservados</p>
            </div>
        </div>
    </footer>
</body>
</html>