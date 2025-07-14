document.addEventListener("DOMContentLoaded", () => {
    const formulario = document.querySelector(".form");
    const submitBtn = formulario.querySelector(".submit");
    const inputOculto = document.getElementById("oculto").value.trim();
    let errorMsg=document.querySelector(".error-msg");

    submitBtn.classList.remove("click", "error");
    //errorMsg.classList.remove("show");
    
    formulario.addEventListener("submit", (e) => {
        e.preventDefault();

        let nombreEmprendimiento = document.getElementById("nombre").value.trim();
        let descripcionEmprendimiento = document.getElementById("descripcion").value.trim();
        let categoriaEmprendimiento = document.getElementById("categoria").value.trim();
        let imagenEmprendimiento = document.getElementById("imagen").value;
        let whatsappEmprendimiento = document.getElementById("whatsapp").value.trim();
        let ciudadEmprendimiento = document.getElementById("ciudad").value.trim();
        let localidadEmprendimiento = document.getElementById("localidadesDeLaCiudad").value.trim();
        let calleEmprendimiento = document.getElementById("calle").value.trim();
        let alturaEmprendimiento = document.getElementById("altura").value.trim();

        //imagenCargada referencia en, editar un emprendimiento, cuando el emprendimiento ya tiene una foto
        //y desea cambiar otro dato pero no la foto (el campo input estará vacio si no desea cambiarla, entonces se
        //muestra la imagen que ya estaba cargada.)
        let imagenCargada = document.querySelector(
            ".imagenEmprendimientoFormulario"
        );
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
        if (nombreEmprendimiento === "" || descripcionEmprendimiento === "" ||
            categoriaEmprendimiento === "" || (imagenEmprendimiento === "" && imagenCargada == null) ||
            whatsappEmprendimiento === "" || ciudadEmprendimiento === "" || 
            alturaEmprendimiento === "" || calleEmprendimiento === "" || localidadEmprendimiento === "") {
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

    
});
