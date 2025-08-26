<main class="main-container">
    <section class="login-section">
        <h1 class="login-title">Bienvenido a BarberShop</h1>
        
        <form action="/login" method="POST" class="login-form">
            <!-- Campo de email -->
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

            <!-- Campo de contraseña -->
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

            <!-- Botón de enviar -->
            <div class="form-actions">
                <button type="submit" class="btn-submit">Ingresar</button>
            </div>

            <!-- Links de ayuda -->
            <div class="form-links">
                <a href="/forgot-password" class="link">¿Olvidaste tu contraseña?</a>
                <a href="/register" class="link">Crear una cuenta</a>
            </div>
        </form>
    </section>
</main>