document.addEventListener("DOMContentLoaded", () => {

    if(window.mensajeExito){
        Swal.fire({
            title: "Eliminado!",
            text: window.mensajeExito,
            icon: "success"
        });
    }


    let formularios=document.querySelectorAll(".formEliminar");
    formularios.forEach(formulario => {
        console.log("aca");
        formulario.addEventListener("submit", (e) => {
            e.preventDefault();
            Swal.fire({
                title: "¿Estás seguro de eliminar?",
                text: "¡No se podrá revertir!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#007bff",
                cancelButtonColor: "rgb(148, 0, 0)",
                cancelButtonText: "Cancelar",
                confirmButtonText: "Si, eliminar"
            }).then((result) => {
                if (result.isConfirmed) {
                    formulario.submit();
                }
            });
        });
    });
});
