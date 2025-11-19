<main class="contenedor">
    <section class="sections">
        <?php require_once __DIR__ . '/../templates/nav-admin.php'; ?>

        <!-- Input del buscador -->
        <div class="admin-encabezado">
            <h2>Buscar Citas</h2>
            <form>
                <div class="form-group">
                    <label for="fecha" class="form-label">Fecha:</label>
                <input type="date" id="fecha" name="fecha" value="<?php echo s($fecha); ?>" class="form-input" >
                </div>
            </form>
        </div>

        <!-- Mostramos mensaje si no existen citas -->
         <?php if(count($datos) === 0){
            echo "<p class='mensaje-0'> No hay citas para esta fecha. </p>";
         } ?>

        <!-- COMIENZA PARTE DONDE MOSTRAMOS LAS CITAS -->
         <div class="admin-citas-list">
            <div class="admin-citas">
                    <?php 
                        $clientId = 0;
                        $count = 0;
                        foreach($datos as $key => $cita){ 
                            if($clientId !== $cita->id){ ?>
                                <div class="citas-card">
                                    <p><span>Cliente:</span> <?php echo s($cita->cliente)?></p>
                                    <div style="display:none">
                                        <p><span>Correo:</span> <?php echo s($cita->email)?></p>
                                        <p><span>Telefono:</span> <?php echo s($cita->telefono)?></p>
                                    </div>
                                    <p><span>Hora de la cita:</span> <?php echo s($cita->hora)?></p>
                                </div>
                                <p class="citas-title">Servicios</p>
                                <?php 
                                $clientId = $cita->id;
                            } // finaliza el If?>
                                    <div class="citas-servicios">
                                        <p><?php echo $cita->servicio ?></p>
                                        <p><?php echo $cita->precio?></p>
                                    </div>
                            <?php 
                                $actual = $cita->id;
                                $next = $datos[$key + 1]->id ?? 0;
                                $count = $count + $cita->precio;


                                $last = isLast($actual, $next);
                                if($last){
                                    ?>
                                    <div class="total-div">
                                        <span class="total">Total: $<?php echo $count?></span>
                                    </div>
                                    <!-- Boton para eliminar la cita -->
                                    <div class="div-delete">
                                        <form method="post" action="/api/delete">
                                            <input type="hidden" value="<?php echo s($cita->id) ?>" name="id">
                                            <input type="submit" value="Eliminar" class="btn-delete">
                                        </form>
                                    </div>
                                    <?php 
                                    $count = 0;
                                }?>
                    <?php } // Finaliza el foreach?>
            </div>
         </div>

    </section>
</main>

<?php 
    $script = "<script src='/build/js/buscador.js'></script>"
?>