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
        //imagenCargada referencia en, editar un emprendimiento, cuando el emprendimiento ya tiene una foto
        //y desea cambiar otro dato pero no la foto (el campo input estará vacio si no desea cambiarla, entonces se
        //muestra la imagen que ya estaba cargada.)
        const imagenCargada=document.querySelector(".imagenEmprendimientoFormulario");
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
            || (imagenEmprendimiento === "" && imagenCargada==null) || whatsappEmprendimiento === "") {
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

    $("#Form").on("submit", function(e) {
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
                Object.keys(errors).forEach(function(field) {
                    let msg = errors[field][0];
                    // Añade aquí código para mostrar msg en tu modal
                    alert(msg);
                });
            },
        });
    });
});