<main class="form-container">
    <section class="form-section">
        <h2 class="form-title">Bienvenido a BarberShop</h2>

        <?php include_once __DIR__ . '/../templates/alertas.php';?>
        
        <form action="/login" method="POST" class="general-form">
            <!-- Campo de email -->
            <div class="form-group">
                <label for="email" class="form-label">Correo electrónico</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="form-input" 
                    placeholder="tucorreo@ejemplo.com" 
                    value="<?php echo s($auth->email) ?>"
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
                <button type="submit" class="btn">Ingresar</button>
            </div>

            <!-- Links de ayuda -->
            <div class="form-links">
                <a href="/forgot-password" class="link">¿Olvidaste tu contraseña?</a>
                <a href="/register" class="link">Crear una cuenta</a>
            </div>
        </form>
    </section>
</main>