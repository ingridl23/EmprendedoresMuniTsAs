"use strict";

if (window.mensajeExito) {
    Swal.fire({
        title: "Agregado!",
        text: window.mensajeExito,
        icon: "success",
        confirmButtonColor: "#36be7f",
    });
}
asignarCartel();

function asignarCartel() {
    let formularios = document.querySelectorAll(".formEliminar");
    formularios.forEach((formulario) => {
        formulario.addEventListener("submit", (e) => {
            e.preventDefault();
            Swal.fire({
                title: "¿Estás seguro de eliminar?",
                text: "¡No se podrá revertir!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#36be7f",
                cancelButtonColor: "rgb(148, 0, 0)",
                cancelButtonText: "Cancelar",
                confirmButtonText: "Si, eliminar",
            }).then((result) => {
                if (result.isConfirmed) {
                    formulario.submit();
                }
            });
        });
    });
}

export { asignarCartel };
