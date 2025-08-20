document.addEventListener("DOMContentLoaded", function () {
    const checkboxes = document.querySelectorAll(".checkbox-cerrado");
    checkboxes.forEach((chk) => {
        chk.addEventListener("change", function () {
            const dia = this.dataset.dia;
            const apertura = document.querySelector(
                `[name="horarios[${dia}][hora_de_apertura]"]`
            );
            const cierre = document.querySelector(
                `[name="horarios[${dia}][hora_de_cierre]"]`
            );
            if (this.checked) {
                document.querySelector(`.cerrado_${dia}`).classList.remove(`oculto`);
                let inputs = document.querySelectorAll(`.ocultarInputsCerrado${dia}`);
                inputs.forEach(input => {
                    input.style.display = "none";
                });
                apertura.disabled = true;
                cierre.disabled = true;

            } else {
                apertura.disabled = false;
                cierre.disabled = false;
                let inputs = document.querySelectorAll(`.ocultarInputsCerrado${dia}`);
                inputs.forEach(input => {
                    input.style.display = "block";
                });
            }
        });

        // Ejecutar al cargar (por si ya está marcado)
        chk.dispatchEvent(new Event("change"));
    });
});
