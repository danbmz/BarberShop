<main class="contenedor">
    <section class="sections nav-encabezado">
        <?php require_once __DIR__ . '/../templates/nav-admin.php'; ?>
        <h2>Servicios</h2>
    </section>
    <section class="admin-services">
        <div class="card-cont">
            <?php foreach($servicios as $servicio) {?>
                <div class="admin-card">
                    <div class="card-info">
                        <h3><?php echo $servicio->nombre; ?></h3>
                        <span>$<?php echo $servicio->precio; ?></span>
                    </div>
                    <div class="card-btns">
                        <button class="btn" title="Editar" id="editServiceBtn" data-id="<?php echo $servicio->id; ?>" data-nombre="<?php echo $servicio->nombre; ?>" data-precio="<?php echo $servicio->precio; ?>">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" role="img" aria-label="Editar" xmlns="http://www.w3.org/2000/svg">
                            <path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1 1 0 0 0 0-1.41l-2.34-2.34a1 1 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                            </svg>
                        </button>
                        <button class="btn-delete" title="Eliminar" id="delSerBtn" data-id="<?php echo $servicio->id; ?>">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" role="img" aria-label="Eliminar" xmlns="http://www.w3.org/2000/svg">
                            <path fill="currentColor" d="M9 3v1H4v2h16V4h-5V3H9zm1 6v8h2V9H10zm4 0v8h2V9h-2zM7 9v8h2V9H7zM6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V8H6v11z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="new-service">
            <button class="btn" title="Nuevo Servicio" id="newServiceBtn"> + </button>
        </div>
    </section> 
</main>
<?php $script = "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script src='/build/js/admin.js'></script>"; 
?>