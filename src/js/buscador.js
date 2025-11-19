const fecha = document.querySelector("#fecha");
fecha.addEventListener("input", (e) => {
    const fechaSeleccionada = e.target.value;
    window.location = `?fecha=${fechaSeleccionada}`;
});
