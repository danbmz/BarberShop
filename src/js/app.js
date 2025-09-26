(function () {
    // 1. Elementos para tabs y panel del form
    const tabs = Array.from(document.querySelectorAll(".step"));
    const panels = {
        1: document.getElementById("panel-1"),
        2: document.getElementById("panel-2"),
        3: document.getElementById("panel-3"),
    };
    let current = 1;
    // 2. Elementos para las cards del panel Servicios
    const reservation = {
        nomrbe: "",
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
    document.querySelectorAll(".step-button").forEach((btn) => {
        btn.addEventListener("click", (e) => {
            const parent = e.target.closest(".step");
            if (!parent) return;
            const step = Number(parent.dataset.step);
            goTo(step);
        });
    });

    // 1. botones siguiente/atrás
    document.getElementById("next-1").addEventListener("click", () => goTo(2));
    document.getElementById("next-2").addEventListener("click", () => goTo(3));
    document.getElementById("back-2").addEventListener("click", () => goTo(1));
    document.getElementById("back-3").addEventListener("click", () => goTo(2));
    document.getElementById("confirm").addEventListener("click", () => {
        // Logica para mostrar mensaje de confirmacion y enviar formulario
        alert("Reserva confirmada (ejemplo).");
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

        console.log(reservation);
    }

    // iniciar en paso 1 & el resto de funciones
    goTo(1);
    getServicesAPI();
})();
