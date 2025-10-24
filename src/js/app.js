(function () {
    // 1. Elementos para tabs y panel del form
    const tabs = Array.from(document.querySelectorAll(".step"));
    const panels = {
        1: document.getElementById("panel-1"),
        2: document.getElementById("panel-2"),
        3: document.getElementById("panel-3"),
    };
    // Desabilotamos boton
    const btn1 = document.querySelector("#next-1");
    btn1.disabled = true;

    let current = 1;
    // 2. Elementos para las cards del panel Servicios
    const reservation = {
        id: "",
        nombre: "",
        fecha: "",
        hora: "",
        servicios: [],
    };

    // 1. función para cambiar de panel con tabs
    function goTo(step) {
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
            s.querySelector(".step-button").setAttribute(
                "aria-selected",
                "false"
            );
            if (sNum < current) {
                s.classList.add("completed");
                s.querySelector(".step-button").setAttribute(
                    "aria-selected",
                    "false"
                );
            } else if (sNum === current) {
                s.classList.add("active");
                s.querySelector(".step-button").setAttribute(
                    "aria-selected",
                    "true"
                );
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

    // 1. botones siguiente/atrás
    document.getElementById("next-1").addEventListener("click", () => goTo(2));
    document.getElementById("next-2").addEventListener("click", () => {
        const validate = getInfoReservation();
        if (validate.valid) {
            goTo(3);
            reservationSummary();
            console.log(reservation);
        }
    });
    document.getElementById("back-2").addEventListener("click", () => goTo(1));
    document.getElementById("back-3").addEventListener("click", () => goTo(2));
    document.getElementById("confirm").addEventListener("click", () => {
        // Enviar datos al Backend
        submitReservationAPI();
        // Modal de confirmacion
    });

    // 2. CONSULTAS HACIA LA API para traer los servicios
    async function getServicesAPI() {
        try {
            const result = await fetch("http://localhost:3000/api/services");
            const data = await result.json();
            renderServiceCards(data);
        } catch (error) {
            console.log(error);
        }
    }

    // 2. ENVIANDO datos de reservacion a la API
    async function submitReservationAPI() {
        const { id, nombre, fecha, hora, servicios } = reservation;
        const idService = servicios.map((servicio) => servicio.id);

        const datos = new FormData();
        datos.append("usuarioId", id);
        datos.append("fecha", fecha);
        datos.append("hora", hora);
        datos.append("idService", idService);

        const url = "http://localhost:3000/api/reservation";
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

    // 2. RENDERIZAR INFORMACION DE LA API
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

    // 2. SELECCIONAR UN SERVICIO
    function selectService(service) {
        const { id } = service;
        const { servicios } = reservation;
        const cardSelected = document.querySelector(`[data-id="${id}"]`);

        // Verificar si un servicio ya ha sido seleccionado
        if (servicios.some((serviceSelected) => serviceSelected.id === id)) {
            reservation.servicios = servicios.filter(
                (serviceSelected) => serviceSelected.id !== id
            );
            cardSelected.classList.remove("selected");
        } else {
            reservation.servicios = [...servicios, service];
            cardSelected.classList.add("selected");
        }

        // Habilitar boton
        if (reservation.servicios.length > 0) {
            btn1.disabled = false;
        } else {
            btn1.disabled = true;
        }
    }

    // 2. RECOPILAR FECHA Y HORA Y AGREGARLOS AL OBJETO
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

    // 2. VALIDA LOS DATOS DE FECHA Y HORA
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

    // 2. Agrega mensajes de error en la UI
    function showMessageError(message) {
        const div = document.querySelector("#errorMessage");
        div.classList.add("error");
        div.textContent = message;
        setTimeout(() => {
            div.style.display = "none";
        }, 3000);
    }

    //2. MOSTRAR RESUMEN DE LA RESERVACION
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

    // iniciar en paso 1 & el resto de funciones
    goTo(1);
    getServicesAPI();
})();
