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
                        <a href="/admin/services/update" class="btn" title="Editar">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" role="img" aria-label="Editar" xmlns="http://www.w3.org/2000/svg">
                            <path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1 1 0 0 0 0-1.41l-2.34-2.34a1 1 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                            </svg>
                        </a>
                        <form method="GET">
                            <input type="hidden" name="id" value="<?php echo $servicio->id ?>" class="btn">
                            <input type="submit" value="E" class="btn-delete" title="Eliminar">
                        </form>
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