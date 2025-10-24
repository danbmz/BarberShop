<main class="contenedor">
    <!-- <h1 class="title">Bienvenido, <?php echo $nombre ?>!</h1>
    <p>Revisa tus citas o agenda una nueva desde aqui</p> -->

    <!-- seccion primera -->
    <section class="sections">
        <div class="container">
            <div class="user-encabezado">
                <div><h2>Información General</h2></div>
                <div class="u-btn"><button class="btn">Nueva reservación</button></div>
            </div>
            <div class="user-details">
                <div class="u-card-info"><p>Tienes 2 citas pendientes</p></div>
                <div class="u-card-info"><p>Tu proxima cita sera el dia:</p></div>
                <div class="u-card-info"><p>Tu barbero favorito es:</p></div>
            </div>
        </div>
    </section>

    <!-- Seccion de proximas reservas -->
    <section class="sections">
        <div class="container">
            <div class="user-encabezado">
                <div><h2>Tus proximas citas:</h2></div>
            </div>
            <div class="user-details-citas">
                <div class="u-card-citas">
                    <div class="u-img">
                        <img src="/build/img/1.webp" alt="Imagen corte">
                    </div>
                    <div class="u-info">
                        <h3>Corte de cabello</h3>
                        <p>Corte clásico con estilo moderno, el corte se realiza con maquinas modernas.</p>
                        <div class="u-p"><p>⏱️ 30 min</p></div>
                    </div>
                </div>
                <div class="u-card-citas">
                    <div class="u-img">
                        <img src="/build/img/1.webp" alt="Imagen corte">
                    </div>
                    <div class="u-info">
                        <h3>Corte de cabello</h3>
                        <p>Corte clásico con estilo moderno, el corte se realiza con maquinas modernas.</p>
                        <div class="u-p"><p>⏱️ 30 min</p></div>
                    </div>
                </div>
                <div class="u-card-citas">
                    <div class="u-img">
                        <img src="/build/img/1.webp" alt="Imagen corte">
                    </div>
                    <div class="u-info">
                        <h3>Corte de cabello</h3>
                        <p>Corte clásico con estilo moderno, el corte se realiza con maquinas modernas.</p>
                        <div class="u-p"><p>⏱️ 30 min</p></div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <!-- Seccion de historial -->
    <section class="sections">
        <div class="container">
            <div class="user-encabezado">
                <div><h2>Historial:</h2></div>
            </div>
            <div class="user-details">
                <div class="u-card"><p>Tienes 2 citas pendientes</p></div>
                <div class="u-card"><p>Tu proxima cita sera el dia:</p></div>
                <div class="u-card"><p>Tu barbero favorito es:</p></div>
            </div>
        </div>
    </section>

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
            <p>Coloca la fecha y hora de tu cita. Recuerda que nuestro horario de atencion es de 9:00am a 20:00pm</p>
            <p id="errorMessage" class="alerta"></p>
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
                    <!-- Campo de ID -->
                    <div class="form-group">
                        <label for="id" class="form-label"></label>
                        <input 
                            type="text" 
                            id="id" 
                            name="id" 
                            class="form-input" 
                            value="<?php echo s($id); ?>" 
                            hidden>
                    </div>
                    <div class="form-group">
                        <label for="fecha" class="form-label">Día:</label>
                        <input 
                            type="date" 
                            id="fecha" 
                            name="fecha" 
                            class="form-input"
                            min="<?php echo date('Y-m-d', strtotime('+1 day')) ?>"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="hora" class="form-label">Hora:</label>
                        <input 
                            type="time" 
                            id="hora" 
                            name="hora" 
                            class="form-input"
                            min="09:00"
                            max="20:00"
                            required>
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
            <div class="reservation-summary"></div>
            <div class="controls space">
                <button class="btn secondary" id="back-3">Atrás</button>
                <button class="btn primary" id="confirm">Confirmar reserva</button>
            </div>
        </div>

    </div>

</main>

<?php 
    $script = "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='/build/js/app.js'></script>
    ";
?>

