(function () {
    // Boton que activa el modal - Nuevo servicio
    const newServiceBtn = document.querySelector("#newServiceBtn");
    newServiceBtn.onclick = openModal;

    // Botones para Actualizar un Servicio
    const editBtns = document.querySelectorAll("#editServiceBtn");
    editBtns.forEach((btn) => {
        btn.addEventListener("click", () => {
            const modal = document.createElement("DIV");
            modal.classList.add("modal");
            // Obtenemos los datos de cada servicio
            const id = btn.dataset.id;
            const nombre = btn.dataset.nombre;
            const precio = btn.dataset.precio;

            // Renderizamos el Formulario y agregamos al contenedor del Modal
            const form = `
            <section class="panel-service">
                <h2>Editar Servicio</h2>
                <p>Agrega los nuevos datos para actualizar el Servicio en la Base de Datos.</p>
                <div id="errorMessage" class="alerta"></div>
                <form method="POST" class="general-form">
                    <div class="form-group">
                        <label for="nombre" class="form-label">Nombre del Servicio:</label>
                        <input 
                            type="text" 
                            id="nombre" 
                            name="nombre" 
                            value="${nombre}"
                            class="form-input" 
                            >
                    </div>
                    <div class="form-group">
                        <label for="precio" class="form-label">Precio:</label>
                        <input 
                            type="number" 
                            id="precio" 
                            name="precio" 
                            value="${precio}"
                            class="form-input" 
                            >
                    </div>
                    </form>
                    <div class="controls">
                        <button class="btn-delete" id='cancelar-btn'>Cancelar</button>
                        <button class="btn" id="confirmacion-btn">Actualizar</button>
                    </div>
            </section>
            `;
            modal.innerHTML = form;

            // Insertamos el modal sobre el BODY
            const body = document.querySelector("body");
            body.classList.add("overflow-hidden");
            body.appendChild(modal);

            // Seleccionamos el boton para Guardar Cambios
            document
                .querySelector("#confirmacion-btn")
                .addEventListener("click", () => {
                    const data = {
                        nombre: document.querySelector("#nombre").value,
                        precio: document.querySelector("#precio").value,
                        id: id,
                    };

                    const validated = validServiceInformation(data);
                    if (!validated.valid) {
                        showMessageError(validated.mensaje);
                    } else {
                        updateService(data);
                    }
                });

            // Seleccionamos el boton Cancelar y agregamos funcion closeModal()
            const btnCancel = document.querySelector("#cancelar-btn");
            btnCancel.onclick = closeModal;
        });
    });

    // Botones para Eliminar un Servicio
    const deleteBtns = document.querySelectorAll("#delSerBtn");
    deleteBtns.forEach((btn) => {
        btn.addEventListener("click", () => {
            const id = btn.dataset.id;
            deleteService(id);
        });
    });

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
                const data = {
                    nombre: document.querySelector("#nombre").value,
                    precio: document.querySelector("#precio").value,
                };

                const validated = validServiceInformation(data);
                if (!validated.valid) {
                    showMessageError(validated.mensaje);
                } else {
                    createService(data);
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
        }, 300);
    }

    function validServiceInformation(data) {
        const { nombre, precio } = data;
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

    async function createService(data) {
        const { nombre, precio } = data;
        const datos = new FormData();
        datos.append("nombre", nombre);
        datos.append("precio", precio);

        const url = `${location.origin}/api/services/create`;
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

    async function updateService(data) {
        const { nombre, precio, id } = data;
        const datos = new FormData();
        datos.append("id", id);
        datos.append("nombre", nombre);
        datos.append("precio", precio);

        const url = `${location.origin}/api/services/update`;
        try {
            const response = await fetch(url, {
                method: "POST",
                body: datos,
            });

            const result = await response.json();

            if (result.respuesta) {
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

    async function deleteService(id) {
        const datos = new FormData();
        datos.append("id", id);

        const url = `${location.origin}/api/services/delete`;
        try {
            const response = await fetch(url, {
                method: "POST",
                body: datos,
            });

            const result = await response.json();

            if (result.respuesta) {
                Swal.fire({
                    title: "Good job!",
                    text: "Servicio Eliminado con exito!",
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
