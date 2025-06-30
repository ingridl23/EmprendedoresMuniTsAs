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

    document.querySelectorAll(".field-group input").forEach((input) => {
        if (input.value.trim() !== "") {
            input.classList.add("has-value");
        }

        input.addEventListener("input", () => {
            input.classList.toggle("has-value", input.value.trim() !== "");
        });
    });

    /*logica para popup*/
    /*
    document.querySelector("#submitButton").addEventListener("click", (e) => {
        e.preventDefault();
        document.getElementById("overlay").classList.add("open");
        document.getElementById("modal").classList.add("open");
    });
    document.getElementById("closeModal").addEventListener("click", () => {
        document.getElementById("overlay").classList.remove("open");
        document.getElementById("modal").classList.remove("open");
    });

    document.querySelector("#submitButton").addEventListener("submit", (e) => {
        e.preventDefault();
        let $form = $(this);
        $.ajax({
            url: $form.attr("action"),
            method: $form.attr("method"),
            data: $form.serialize(),
            success(data, status, xhr) {
                // Si Laravel devuelve un JSON de éxito o te redirige:
                // puedes forzar la carga del panel admin:
                window.location.href = "{{ route('administradores.form') }}";
            },
            error(xhr) {
                // Si hay validación / credenciales incorrectas,
                // muestra los errores dentro del modal:
                let errors = xhr.responseJSON.errors || {
                    email: [xhr.responseJSON.message],
                };
                Object.keys(errors).forEach(function (field) {
                    let msg = errors[field][0];
                    // Añade aquí código para mostrar msg en tu modal
                    alert(msg);
                });
            },
        });

    });
    */
});
