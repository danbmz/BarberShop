<main class="contenedor">
    <!-- seccion primera -->
    <section class="sections">
        <div class="container">
            <div class="user-encabezado">
                <div><h2>Información General</h2></div>
                <div class="u-btn">
                    <button class="btn" id="new-cita" data-uid="<?php echo $id; ?>" data-nombre="<?php echo $nombre; ?>" >Nueva reservación</button>
                </div>
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

</main>

<?php 
    $script = "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='/build/js/app.js'></script>
    ";
?>

