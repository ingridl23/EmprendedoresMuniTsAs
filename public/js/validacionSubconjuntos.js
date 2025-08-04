/*document.addEventListener("DOMContentLoaded", () => {
    const radios = document.querySelectorAll('input[name="subconjuntos"]');
    const descripcionField = document.getElementById("campo-descripcion");
    const cvField = document.getElementById("campo-cv");

    const textareaDescripcion = document.getElementById("descripcion");
    const inputCV = document.getElementById("cv");

    radios.forEach((radio) => {
        radio.addEventListener("change", () => {
            if (radio.value === "empresa" || radio.value === "emprendedor") {
                // Mostrar descripción, ocultar y limpiar CV
                descripcionField.style.display = "block";
                cvField.style.display = "none";
                inputCV.value = "";

                // Validaciones
                textareaDescripcion.required = true;
                inputCV.required = false;
            } else if (radio.value === "busqueda de empleo") {
                // Mostrar CV, ocultar y limpiar descripción
                descripcionField.style.display = "none";
                cvField.style.display = "block";
                textareaDescripcion.value = "";

                // Validaciones
                textareaDescripcion.required = false;
                inputCV.required = true;
            }
        });
    });
});
*/

document.addEventListener("DOMContentLoaded", () => {
    const radios = document.querySelectorAll('input[name="subconjuntos"]');
    const descripcionField = document.getElementById("campo-descripcion");
    const cvField = document.getElementById("campo-cv");

    const textareaDescripcion = document.getElementById("descripcion");
    const inputCV = document.getElementById("cv");

    function actualizarCampos() {
        const seleccionado = Array.from(radios).find((radio) => radio.checked);

        if (!seleccionado) {
            descripcionField.style.display = "none";
            cvField.style.display = "none";
            textareaDescripcion.required = false;
            inputCV.required = false;
            textareaDescripcion.value = "";
            inputCV.value = "";
            return;
        }

        if (
            seleccionado.value === "empresa" ||
            seleccionado.value === "emprendedor"
        ) {
            descripcionField.style.display = "block";
            cvField.style.display = "none";

            textareaDescripcion.required = true;
            inputCV.required = false;
            inputCV.value = "";
        } else if (seleccionado.value === "busqueda de empleo") {
            descripcionField.style.display = "block";
            cvField.style.display = "block";

            textareaDescripcion.required = true;
            inputCV.required = true;
        }
    }

    radios.forEach((radio) => {
        radio.addEventListener("change", actualizarCampos);
    });

    // Ejecutar al cargar para sincronizar estado inicial
    actualizarCampos();
});
