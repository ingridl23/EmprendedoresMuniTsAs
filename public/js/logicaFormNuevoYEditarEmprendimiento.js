document.addEventListener("DOMContentLoaded", () => {
    const formulario = document.querySelector(".form");
    const submitBtn = formulario.querySelector(".submit");
    const errorMsg = formulario.querySelector(".error-msg");

    formulario.addEventListener("submit", (e) => {
        e.preventDefault();

        const nombreEmprendimiento = document.getElementById("nombre").value.trim();
        const descripcionEmprendimiento = document.getElementById("descripcion").value.trim();
        const categoriaEmprendimiento = document.getElementById("categoria").value.trim();
        const imagenEmprendimiento = document.getElementById("imagen").value;
        const whatsappEmprendimiento = document.getElementById("whatsapp").value.trim();
        const inputOculto = document.getElementById("oculto").value.trim();

        submitBtn.classList.remove("click", "error");
        errorMsg.classList.remove("show");
    
    //Ver para que no tenga que volver a recargar toda la página para la nuestra de errores
    /*fetch(`/emprendedores/crearEmprendimiento`, {
            method: 'post'
        })
        .then((response) =>{
              if (response.ok) {
                return response.json();
            }
        }).catch(error => {
            if (error.response && error.response.status === 422) {
                const errors = error.response.data.errors;
                // Manejar los errores, por ejemplo:
                Object.keys(errors).forEach(key => {
                    const errorElement = document.getElementById(`error-${key}`);
                    if (errorElement) {
                        errorElement.textContent = errors[key][0];
                    }
                });
            } else {
                // Otro tipo de error
                console.error(error);
            }
    });*/
        // Validar si el campo oculto fue completado (posible bot)
        if (inputOculto !== "") {
            console.log(inputOculto);
            console.warn("Posible bot detectado. Envío cancelado.");
            return; // Cancela el envío silenciosamente
        }

        if (nombreEmprendimiento === "" || descripcionEmprendimiento === "" || categoriaEmprendimiento === ""
            || imagenEmprendimiento === "" || whatsappEmprendimiento === "") {
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
            }, 1500);
            //Se envia el formulario para la carga de datos
            formulario.submit();
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
    document.querySelector(".btn-contact").addEventListener("click", (e) => {
        e.preventDefault();
        document.getElementById("overlay").classList.add("open");
        document.getElementById("modal").classList.add("open");
    });
    document.getElementById("closeModal").addEventListener("click", () => {
        document.getElementById("overlay").classList.remove("open");
        document.getElementById("modal").classList.remove("open");
    });


});