<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BarberShop Elite</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>
    <header class="header">
        <div class="header-contenedor contenedor">
            <div class="nav-logo-contendedor">
                <a href="/" class="logo">
                    <svg class="logo-icon" xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-scissors h-8 w-8 text-accent icon"><circle cx="6" cy="6" r="3"></circle><path d="M8.12 8.12 12 12"></path><path d="M20 4 8.12 15.88"></path><circle cx="6" cy="18" r="3"></circle><path d="M14.8 14.8 20 20"></path></svg>
                    <h1>BarberShop</h1>
                </a>
            
                <nav class="nav">
                    <a href="/services">Servicios</a>
                    <a href="/aboutUs">Nosotros</a>
                    <a href="/contact">Contacto</a>
                    <?php if($isLoggedIn){?>
                        <a href="/logout" class="login-button logout">Cerrar Sesión</a>
                    <?php } else {?>
                        <a href="/login" class="login-button">Iniciar Sesión</a>   
                    <?php } ?>
                </nav>

                <div class="menu-despegable">
                    <button>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="lucide lucide-menu w-6 h-6"
                        >
                            <line x1="4" x2="20" y1="12" y2="12"></line>
                            <line x1="4" x2="20" y1="6" y2="6"></line>
                            <line x1="4" x2="20" y1="18" y2="18"></line>
                        </svg>
                    </button>
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
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-scissors h-8 w-8 text-accent icon"><circle cx="6" cy="6" r="3"></circle><path d="M8.12 8.12 12 12"></path><path d="M20 4 8.12 15.88"></path><circle cx="6" cy="18" r="3"></circle><path d="M14.8 14.8 20 20"></path></svg>
                        <span>BarberShop Elite</span>
                    </div>
                    <p>El destino premium para el cuidado personal masculino. Estilo, elegancia y profesionalismo en cada servicio</p>
                    <div class="redes-sociales">
                        <a href="#" class="iconos-rs">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook h-5 w-5"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                        </a>
                        <a href="#" class="iconos-rs">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-instagram h-5 w-5"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line></svg>
                        </a>
                        <a href="#" class="iconos-rs">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-twitter h-5 w-5"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"></path></svg>
                        </a>
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

<?php 
    // Agregamos JS de forma condicional
    echo $script ?? '';
?>

</html>