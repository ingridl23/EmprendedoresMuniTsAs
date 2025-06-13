document.addEventListener("DOMContentLoaded", () => {
    const formulario = document.querySelector(".form");
    const submitBtn = formulario.querySelector(".submit");
    const errorMsg = formulario.querySelector(".error-msg");

    formulario.addEventListener("submit", (e) => {
        e.preventDefault();

        const telefono = document.getElementById("phone").value.trim();
        const email = document.getElementById("email").value.trim();
        const mensaje = document.getElementById("descripcion").value.trim();
        const inputOculto = document.getElementById("oculto").value.trim();

        submitBtn.classList.remove("click", "error");
        errorMsg.classList.remove("show");

        // Validar si el campo oculto fue completado (posible bot)
        if (inputOculto !== "") {
            console.warn("Posible bot detectado. Envío cancelado.");
            return; // Cancela el envío silenciosamente
        }

        if (telefono === "" || email === "" || mensaje === "") {
            // Mostrar cruz roja y mensaje de error
            submitBtn.classList.add("error");
            errorMsg.classList.add("show");
        } else {
            // Mostrar tilde verde
            submitBtn.classList.add("click");
            submitBtn.disabled = true;

            setTimeout(() => {
                submitBtn.classList.remove("click");
                submitBtn.disabled = false;
                formulario.reset();
            }, 2000);
        }
    });
});