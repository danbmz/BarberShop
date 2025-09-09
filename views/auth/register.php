<main class="main-container">
    <section class="register-section">
        <h1 class="register-title">Crear Cuenta</h1>
        <p class="register-subtitle">
            Completa el formulario para registrarte y acceder al sistema.
        </p>

        <?php include_once __DIR__ . '/../templates/alertas.php';?>
        
        <form action="/register" method="POST" class="register-form">
            <!-- Nombre -->
            <div class="form-group">
                <label for="nombre" class="form-label">Nombre</label>
                <input 
                    type="text" 
                    id="nombre" 
                    name="nombre" 
                    class="form-input" 
                    placeholder="Ingresa tu nombre" 
                    value="<?php echo s($usuario->nombre) ?>"
                    >
            </div>
            
            <!-- Apellido -->
            <div class="form-group">
                <label for="apellido" class="form-label">Apellido</label>
                <input 
                    type="text" 
                    id="apellido" 
                    name="apellido" 
                    class="form-input" 
                    placeholder="Ingresa tu apellido" 
                    value="<?php echo s($usuario->apellido) ?>"
                    >
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email" class="form-label">Correo electrónico</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="form-input" 
                    placeholder="tucorreo@ejemplo.com" 
                    value="<?php echo s($usuario->email) ?>"
                    >
            </div>

            <!-- Telefono -->
            <div class="form-group">
                <label for="telefono" class="form-label">Teléfono</label>
                <input 
                    type="tel" 
                    id="telefono" 
                    name="telefono" 
                    class="form-input" 
                    placeholder="7224089..." 
                    value="<?php echo s($usuario->telefono) ?>"
                    >
            </div>

            <!-- Contraseña -->
            <div class="form-group">
                <label for="password" class="form-label">Contraseña</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="form-input" 
                    placeholder="********" 
                    >
            </div>

            <!-- Confirmar contraseña -->
            <div class="form-group">
                <label for="confirm-password" class="form-label">Confirmar contraseña</label>
                <input 
                    type="password" 
                    id="confirm-password" 
                    name="confirm_password" 
                    class="form-input" 
                    placeholder="********" 
                    >
            </div>

            <!-- Botón -->
            <div class="form-actions">
                <button type="submit" class="btn-submit">Registrarse</button>
            </div>

            <!-- Link -->
            <div class="form-links">
                <a href="/login" class="link">¿Ya tienes cuenta? Inicia sesión</a>
            </div>
        </form>
    </section>
</main>