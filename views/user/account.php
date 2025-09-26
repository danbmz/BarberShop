<main class="contenedor">
    <h1 class="title">Bienvenido, <?php echo $nombre ?>!</h1>
    <p>Revisa tus citas o agenda una nueva desde aqui</p>

    <!-- MODULO PARA CREAR NUEVA RESERVACION -->
    <div class="stepper" aria-label="Progreso de 3 pasos">
        <!-- NAV o TABS para navegacion -->
        <nav class="stepper-nav" role="tablist" aria-label="Navegación de pasos">
            <!-- Paso 1 -->
            <div class="step"  data-step="1" role="presentation">
                <div class="step-content">
                        <button class="step-button" role="tab" aria-selected="true" aria-controls="panel-1" id="tab-1">1</button>
                        <div class="step-label">Información</div>
                </div>
            </div>

            <!-- Paso 2 -->
            <div class="step" data-step="2" role="presentation">
                <div class="step-content">
                    <button class="step-button" role="tab" aria-selected="false" aria-controls="panel-2" id="tab-2">2</button>
                    <div class="step-label">Servicios</div>
                </div>
            </div>

            <!-- Paso 3 -->
            <div class="step" data-step="3" role="presentation">
                <div class="step-content">
                    <button class="step-button" role="tab" aria-selected="false" aria-controls="panel-3" id="tab-3">3</button>
                    <div class="step-label">Confirmar</div>
                </div>
            </div>
        </nav>

        <!-- SECCIONES DE CONTENIDO O PASOS  -->
        <div id="panel-1" class="panel" role="tabpanel" aria-labelledby="tab-1">
            <h2>Servicios</h2>
            <p>Elige los servicios que requieres a continuación:</p>
            <div id="services" class="services-list"></div>
            <div class="controls">
                <button class="btn secondary" id="next-1">Siguiente</button>
            </div>
        </div>
        <div id="panel-2" class="panel hidden" role="tabpanel" aria-labelledby="tab-2">
            <h2>Fecha y Hora</h2>
            <p>Coloca la fecha y hora de tu cita:</p>
            <!-- FORMULARIO PARA SELECCIONAR FECHA Y HORARIOS -->
            <div>
                <form method="POST" class="general-form">
                    <!-- Campo de nombre -->
                    <div class="form-group">
                        <label for="nombre" class="form-label"></label>
                        <input 
                            type="text" 
                            id="nombre" 
                            name="nombre" 
                            class="form-input" 
                            value="<?php echo s($nombre); ?>" 
                            hidden>
                    </div>
                    <div class="form-group">
                        <label for="fecha" class="form-label">Día:</label>
                        <input 
                            type="date" 
                            id="fecha" 
                            name="fecha" 
                            class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="hora" class="form-label">Hora:</label>
                        <input 
                            type="time" 
                            id="hora" 
                            name="hora" 
                            class="form-input">
                    </div>
                </form>
            </div>
            <div class="controls space">
                <button class="btn secondary" id="back-2">Atrás</button>
                <button class="btn primary" id="next-2">Siguiente</button>
            </div>
        </div>
        <div id="panel-3" class="panel hidden" role="tabpanel" aria-labelledby="tab-3">
            <h2>Resumen</h2>
            <p>Antes de confirmar, verifica que los datos son correctos.</p>
            <div class="controls space">
                <button class="btn secondary" id="back-3">Atrás</button>
                <button class="btn primary" id="confirm">Confirmar reserva</button>
            </div>
        </div>

    </div>

</main>

<?php 
    $script = "<script src='/build/js/app.js'></script>";
?>

