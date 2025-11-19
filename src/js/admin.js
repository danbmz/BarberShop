(function () {
    // Recuperar boton que activa el modal
    const newServiceBtn = document.querySelector("#newServiceBtn");
    newServiceBtn.onclick = openModal;

    function openModal() {
        const modal = document.createElement("DIV");
        modal.classList.add("modal");

        // Renderizamos el Formulario y agregamos al contenedor del Modal
        const form = `
        <section class="panel-service">
            <h2>Nuevo Servicio</h2>
            <p>Agrega los datos para registrar un nuevo Servicio en la Base de Datos.</p>
            <div id="errorMessage" class="alerta"></div>
            <form method="POST" class="general-form">
                <div class="form-group">
                    <label for="nombre" class="form-label">Nombre del Servicio:</label>
                    <input 
                        type="text" 
                        id="nombre" 
                        name="nombre" 
                        class="form-input" 
                        >
                </div>
                <div class="form-group">
                    <label for="precio" class="form-label">Precio:</label>
                    <input 
                        type="number" 
                        id="precio" 
                        name="precio" 
                        class="form-input" 
                        >
                </div>
                </form>
                <div class="controls">
                    <button class="btn-delete" id='cancelar-btn'>Cancelar</button>
                    <button class="btn" id="confirmacion-btn">Registrar</button>
                </div>
        </section>
        `;
        modal.innerHTML = form;

        // Insertamos el modal sobre el BODY
        const body = document.querySelector("body");
        body.classList.add("overflow-hidden");
        body.appendChild(modal);

        // Seleccionamos el boton y Validamos el contenido del formulario y si es correcto enviamos
        document
            .querySelector("#confirmacion-btn")
            .addEventListener("click", () => {
                const nombre = document.querySelector("#nombre").value;
                const precio = document.querySelector("#precio").value;

                const validated = getServiceInformation(nombre, precio);
                if (!validated.valid) {
                    showMessageError(validated.mensaje);
                } else {
                    saveServiceInformation(nombre, precio);
                }
            });

        // Seleccionamos el boton Cancelar y agregamos funcion closeModal()
        const btnCancel = document.querySelector("#cancelar-btn");
        btnCancel.onclick = closeModal;
    }

    function closeModal() {
        const modal = document.querySelector(".modal");
        modal.classList.add("fade-Out");
        setTimeout(() => {
            modal?.remove(); // ?: verifica si existe el elemento 'modal', y si si existe, lo elimina.
            const body = document.querySelector("body");
            body.classList.remove("overflow-hidden");
        }, 500);
    }

    function getServiceInformation(nombre, precio) {
        if (nombre.trim() === "" || precio.trim() === "") {
            return {
                valid: false,
                mensaje: "No puedes mandar campos vacios",
            };
        }

        const regex = /[<>]/g;
        if (regex.test(nombre)) {
            return {
                valid: false,
                mensaje: "El nombre contiene caracteres no permitidos",
            };
        }

        return { valid: true };
    }

    async function saveServiceInformation(nombre, precio) {
        const data = new FormData();
        data.append("nombre", nombre);
        data.append("precio", precio);

        const url = "http://localhost:3000/api/services/save";
        try {
            const response = await fetch(url, {
                method: "POST",
                body: data,
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

    function showMessageError(message) {
        const div = document.querySelector("#errorMessage");
        div.classList.add("error");
        div.textContent = message;
        setTimeout(() => {
            div.style.display = "none";
        }, 3000);
    }
})();
