<main class="main-container">
    <section class="recover-section">
        <h1 class="recover-title">Recuperar Contraseña</h1>
        <p class="recover-subtitle">
            Ingresa tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.
        </p>
      
        <form action="/forgot-password" method="POST" class="recover-form">
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

            <!-- Botón de enviar -->
            <div class="form-actions">
            <button type="submit" class="btn-submit">Enviar enlace</button>
            </div>

            <!-- Link de regreso -->
            <div class="form-links">
            <a href="/login" class="link">Volver al inicio de sesión</a>
            </div>
        </form>
    </section>
</main>