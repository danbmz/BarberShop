<main class="main-container">
    <section class="register-section">
        <h1 class="register-title">Crear Cuenta</h1>
        <p class="register-subtitle">
            Completa el formulario para registrarte y acceder al sistema.
        </p>
        
        <form action="/register" method="POST" class="register-form">
            <!-- Nombre -->
            <div class="form-group">
                <label for="name" class="form-label">Nombre completo</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    class="form-input" 
                    placeholder="Tu nombre completo" 
                    required>
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
                    required>
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
                    required>
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
                    required>
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