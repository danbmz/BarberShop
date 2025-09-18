<main class="form-container">
    <section class="form-section">
        <h2 class="form-title">Recuperar Contraseña</h2>
        <p class="form-subtitle">
            Ingresa tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.
        </p>
      
        <?php include_once __DIR__ . '/../templates/alertas.php';?>

        <form action="/forgot-password" method="POST" class="general-form">
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
            <button type="submit" class="btn">Enviar enlace</button>
            </div>

            <!-- Link de regreso -->
            <div class="form-links">
            <a href="/login" class="link">Volver al inicio de sesión</a>
            </div>
        </form>
    </section>
</main>