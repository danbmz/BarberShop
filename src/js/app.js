(function () {
    // Boton para mostrar el modal reserva
    const newBtn = document.querySelector("#new-cita");
    newBtn.onclick = abrirModal;

    // Funcion para abrir el modal
    function abrirModal() {
        // Accedemos al nombre y ID
        const id = newBtn.dataset.uid;
        const nombre = newBtn.dataset.nombre;

        // Creamos el modal y agregamos dentro la estructura
        const modal = document.createElement("DIV");
        modal.classList.add("modal");
        modal.innerHTML = `
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
                    <button class="btn-delete" id="next-0">Cancelar</button>
                    <button class="btn secondary" id="next-1">Siguiente</button>
                </div>
            </div>
            <div id="panel-2" class="panel hidden" role="tabpanel" aria-labelledby="tab-2">
                <h2>Fecha y Hora</h2>
                <p>Coloca la fecha y hora de tu cita. Recuerda que nuestro horario de atencion es de 9:00am a 20:00pm</p>
                <div id="errorMessage"></div>
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
                                value="${nombre}" 
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
                                value="${id}" 
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
        `;

        // Seleccionamos el body e injectamos el modal
        const body = document.querySelector("body");
        body.classList.add("overflow-hidden");
        body.appendChild(modal);

        // Botones siguiente/atrás que permiten movernos entre paneles
        document.getElementById("next-1").addEventListener("click", () => goTo(2));
        document.getElementById("next-2").addEventListener("click", () => {
            const validate = getInfoReservation();
            if (validate.valid) {
                goTo(3);
                reservationSummary();
            }
        });
        document.getElementById("back-2").addEventListener("click", () => goTo(1));
        document.getElementById("back-3").addEventListener("click", () => goTo(2));
        document.getElementById("confirm").addEventListener("click", () => {
            submitReservationAPI();
        });

        // Renderizamos los servicios extraidos del Back
        getServicesAPI();
        // Desabilitamos el boton del primer panel
        document.querySelector("#next-1").disabled = true;

        // Boton para cerrar el modal de reserva
        const closeBtn = document.querySelector("#next-0");
        closeBtn.onclick = cerrarModal;
    }

    // Funcion para cerrar modal
    function cerrarModal() {
        const modal = document.querySelector(".modal");
        modal.classList.add("fade-Out");
        setTimeout(() => {
            modal?.remove();
            const body = document.querySelector("body");
            body.classList.remove("overflow-hidden");
        }, 300);
    }

    // Objeto para ir guardando los datos que van agregando a la reserva
    const reservation = {
        id: "",
        nombre: "",
        fecha: "",
        hora: "",
        servicios: [],
    };

    let current = 1;
    // Función que cambia entre panels con los botones-tabs
    function goTo(step) {
        // Recuperamos los elementos para tabs y panel del form
        const tabs = Array.from(document.querySelectorAll(".step"));
        const panels = {
            1: document.getElementById("panel-1"),
            2: document.getElementById("panel-2"),
            3: document.getElementById("panel-3"),
        };

        if (step < 1 || step > 3) return;
        current = step;

        // mostrar/ocultar panels
        Object.keys(panels).forEach((k) => {
            panels[k].classList.toggle("hidden", Number(k) !== current);
        });

        // actualizar estados en step elements
        tabs.forEach((s) => {
            const sNum = Number(s.dataset.step); // Transformamos en NUMERO
            s.classList.remove("active", "completed");
            s.querySelector(".step-button").setAttribute("aria-selected", "false");
            if (sNum < current) {
                s.classList.add("completed");
                s.querySelector(".step-button").setAttribute("aria-selected", "false");
            } else if (sNum === current) {
                s.classList.add("active");
                s.querySelector(".step-button").setAttribute("aria-selected", "true");
            }
        });
    }

    // 1. listeners en los botones de los pasos (para navegación directa entre panels)
    // document.querySelectorAll(".step-button").forEach((btn) => {
    //     btn.addEventListener("click", (e) => {
    //         const parent = e.target.closest(".step");
    //         if (!parent) return;
    //         const step = Number(parent.dataset.step);
    //         goTo(step);
    //     });
    // });

    // CONSULTA HACIA LA API para traer los servicios
    async function getServicesAPI() {
        try {
            const result = await fetch(`/api/services`);
            const data = await result.json();
            renderServiceCards(data);
        } catch (error) {
            console.log(error);
        }
    }

    // ENVIA LOS DATOS RECOPILADOS AL BACK-API
    async function submitReservationAPI() {
        const { id, nombre, fecha, hora, servicios } = reservation;
        const idService = servicios.map((servicio) => servicio.id);

        const datos = new FormData();
        datos.append("usuarioId", id);
        datos.append("fecha", fecha);
        datos.append("hora", hora);
        datos.append("idService", idService);

        const url = `${location.origin}/api/reservation/create`;
        try {
            const response = await fetch(url, {
                method: "POST",
                body: datos,
            });

            const result = await response.json();
            if (result.respuesta.resultado) {
                Swal.fire({
                    title: "Good job!",
                    text: "Tu reservación ha sido creada!",
                    icon: "success",
                    button: "OK",
                }).then(() => {
                    window.location.reload();
                });
            }
        } catch (error) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Algo salio mal! Intentalo de nuevo.",
            });
        }
    }

    // RENDERIZAR EN CARDS LOS SERVICIOS
    function renderServiceCards(data) {
        const container = document.querySelector(".services-list");

        data.forEach((service) => {
            const { id, nombre, precio } = service;
            const card = document.createElement("div");
            card.classList.add("card");
            card.dataset.id = id;

            card.innerHTML = `
            <div class="card-content">
                <h3><span class="icon">✂️</span>${nombre}</h3>
                <p>Cortes modernos y clásicos adaptados a tu estilo personal</p>
                <div class="details">
                    <span>⏱️ 45 min</span>
                    <span>💲 Desde $${precio}</span>
                </div>
            </div>
            `;
            card.onclick = () => {
                selectService(service);
            };

            container.appendChild(card);
        });
    }

    // PERMITE COLOREAR LA CARD DE UN SERVICIO
    function selectService(service) {
        const { id } = service;
        const { servicios } = reservation;
        const cardSelected = document.querySelector(`[data-id="${id}"]`);

        // Verificar si un servicio ya ha sido seleccionado
        if (servicios.some((serviceSelected) => serviceSelected.id === id)) {
            reservation.servicios = servicios.filter((serviceSelected) => serviceSelected.id !== id);
            cardSelected.classList.remove("selected");
        } else {
            reservation.servicios = [...servicios, service];
            cardSelected.classList.add("selected");
        }

        // Habilitar boton
        if (reservation.servicios.length > 0) {
            document.querySelector("#next-1").disabled = false;
        } else {
            document.querySelector("#next-1").disabled = true;
        }
    }

    // RECOPILAR NOMBRE, ID ADEMAS DE FECHA Y HORA PARA AGREGARLOS AL OBJETO
    function getInfoReservation() {
        // Obtenemos el nombre y id y los agregamos al objeto
        reservation.nombre = document.querySelector("#nombre").value;
        reservation.id = document.querySelector("#id").value;

        const date = document.querySelector("#fecha").value;
        const hour = document.querySelector("#hora").value;

        const result = validateDateTime(date, hour);
        if (result.valid) {
            reservation.fecha = date;
            reservation.hora = hour;
        } else {
            showMessageError(result.message);
        }
        return result;
    }

    // VALIDA LOS DATOS DE FECHA Y HORA
    function validateDateTime(date, time) {
        const minTime = "09:00";
        const maxTime = "20:00";
        const today = new Date();
        today.setHours(0, 0, 0, 0); // Normalizamos a inicio del día

        const inputDate = new Date(date);
        inputDate.setHours(0, 0, 0, 0);

        // 1. Validar que la fecha no sea anterior a hoy
        if (inputDate < today || time < minTime || time > maxTime) {
            return {
                valid: false,
                message: "Elige una fecha y hora correcta.",
            };
        }

        // ✅ Si pasa todas las validaciones
        return { valid: true, message: "Fecha y hora válidas." };
    }

    // Agrega mensajes de error en la UI
    function showMessageError(message) {
        const div = document.querySelector("#errorMessage");
        div.style.display = "block";
        div.classList.add("error", "alerta");
        div.textContent = message;
        setTimeout(() => {
            div.style.display = "none";
        }, 3000);
    }

    // MOSTRAR RESUMEN DE LA RESERVACION
    function reservationSummary() {
        const { nombre, fecha, hora, servicios } = reservation;
        const container = document.querySelector(".reservation-summary");
        // Limpiar el HTML
        container.innerHTML = "";
        // Creamos contenedor para la card del resumen
        const card = document.createElement("DIV");
        card.classList.add("reservation-card");
        // Formateamos Fecha
        const date = new Date(fecha);
        date.setMinutes(date.getMinutes() + date.getTimezoneOffset());
        const fechaFormateada = date.toLocaleDateString("es-MX", {
            dateStyle: "long",
        });
        // Formateamos nombre
        const name = nombre.split(" ")[0];
        const nombreFormateado = name.slice(0, 1).toUpperCase() + name.slice(1);
        card.innerHTML = `
        <div class="summary-section">
            <p id="summaryDate">${nombreFormateado} tu próxima cita será el día <span class="summary-span">${fechaFormateada} a las ${hora} horas</span>. Los servicios que seleccionaste son los siguientes:</p>
        </div>
        `;

        servicios.forEach(({ nombre, precio }) => {
            const div = document.createElement("DIV");
            div.classList.add("card-content");
            div.innerHTML = `
            <h3><span class="icon">✂️</span>${nombre}</h3>
            <div class="details">
                <span>💲 ${precio}</span>
            </div>
            `;
            card.appendChild(div);
        });
        container.appendChild(card);
    }
})();
