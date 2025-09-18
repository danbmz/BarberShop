<main class="form-container">
    <section class="form-section">
        <h2 class="form-title">Restablecer Contraseña</h2>
        <p class="form-subtitle">
            Ingresa tu nueva contraseña a continuación para recuperar el acceso a tu cuenta.
        </p>
        <!-- muestra las alertas -->
        <?php include_once __DIR__ . '/../templates/alertas.php';?>

        <?php if($error) return; ?> <!-- detiene la ejecucion aqui -->

        <form method="POST" class="general-form">
            <!-- Campo de nueva contraseña -->
            <div class="form-group">
                <label for="password" class="form-label">Nueva contraseña</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="form-input" 
                    placeholder="Escribe tu nueva contraseña" 
                    required>
            </div>

            <!-- Campo de confirmar contraseña -->
            <div class="form-group">
                <label for="confirm-password" class="form-label">Confirmar contraseña</label>
                <input 
                    type="password" 
                    id="confirm-password" 
                    name="confirm_password" 
                    class="form-input" 
                    placeholder="Repite tu nueva contraseña" 
                    required>
            </div>

            <!-- Botón de enviar -->
            <div class="form-actions">
                <button type="submit" class="btn">Restablecer contraseña</button>
            </div>

            <!-- Link de regreso -->
            <div class="form-links">
                <a href="/login" class="link">Volver al inicio de sesión</a>
            </div>
        </form>
    </section>
</main>
