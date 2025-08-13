document.addEventListener("DOMContentLoaded", () => {
    const radios = document.querySelectorAll('input[name="subconjuntos"]');

    // Campos comunes (ya visibles)
    const descripcion = document.getElementById("description");

    // Grupos por tipo de usuario
    const grupoEmpresa = document.getElementById("grupo-empresa");
    const grupoEmprendedor = document.getElementById("grupo-emprendedor");
    const grupoDesempleado = document.getElementById("grupo-empleo");

    // Subgrupo de "formación alcanzada"
    const formacionRadios = document.querySelectorAll(
        'input[name="formacion"]'
    );
    const nombreCursoField = document.getElementById("campo-nombre-curso");
    const nombreCursoInput = document.getElementById("nombre_curso");

    // Campos ciudad/localidad
    const ciudadInput = document.getElementById("ciudad");
    const localidadSelect = document.getElementById("localidadesDeLaCiudad");

    document.querySelector("form").addEventListener("submit", function(e) {
        console.log("Formulario se está enviando...");
    });

    function actualizarCampos() {
        const seleccionado = Array.from(radios).find((r) => r.checked);

        // Oculta todos los grupos y quita required a todos los campos internos
        [grupoEmpresa, grupoEmprendedor, grupoDesempleado].forEach((grupo) => {
            grupo.style.display = "none";
            const campos = grupo.querySelectorAll("input, select, textarea");
            campos.forEach((campo) => {
                campo.required = false;
            });
        });

        if (!seleccionado) return;

        const valor = seleccionado.value;

        if (valor === "empresa") {
            grupoEmpresa.style.display = "block";
            grupoEmpresa
                .querySelectorAll("input, select, textarea")
                .forEach((c) => {
                    if (!c.disabled) c.required = true;
                });
        } else if (valor === "emprendedor") {
            grupoEmprendedor.style.display = "block";
            grupoEmprendedor
                .querySelectorAll("input, select, textarea")
                .forEach((c) => {
                    if (!c.disabled) c.required = true;
                });
        } else if (valor === "busqueda de empleo") {
            grupoDesempleado.style.display = "block";
            grupoDesempleado
                .querySelectorAll("input, select, textarea")
                .forEach((c) => {
                    if (!c.disabled) c.required = true;
                });

            // Asegurar el campo de curso según selección
            actualizarCurso();
        }
    }

    function actualizarCurso() {
        const seleccionado = Array.from(formacionRadios).find((r) => r.checked);
        if (seleccionado && seleccionado.value === "curso") {
            nombreCursoField.style.display = "block";
            nombreCursoInput.required = true;
        } else {
            nombreCursoField.style.display = "none";
            nombreCursoInput.required = false;
            nombreCursoInput.value = "";
        }
    }

    radios.forEach((radio) =>
        radio.addEventListener("change", actualizarCampos)
    );
    formacionRadios.forEach((radio) =>
        radio.addEventListener("change", actualizarCurso)
    );

    // Ejecutar al cargar para estado inicial
    actualizarCampos();
    actualizarCurso();

    // --- Localidades por ciudad ---
    const localidadesPorCiudad = {
        "Tres Arroyos": [
            "Tres Arroyos",
            "Claromecó",
            "Orense",
            "Reta",
            "Copetonas",
            "Micaela Cascallares",
            "San Francisco de Bellocq",
            "San Mayol",
            "Lin Calel",
            "Barrow",
        ],
        "Adolfo Gonzales Chaves": [
            "Adolfo Gonzales Chaves",
            "De La Garma",
            "Juan Elogio Barra",
        ],
        "Benito Juarez": [
            "Benito Juarez",
            "Villa Cacique",
            "Barker",
            "Estación López",
            "Tedín Uriburu",
        ],
    };

    function mostrarLocalidades(ciudad) {
        localidadSelect.innerHTML =
            '<option value="" disabled selected>Seleccione una localidad</option>';
        if (!localidadesPorCiudad[ciudad]) return;
        localidadesPorCiudad[ciudad].forEach((localidad) => {
            const opt = document.createElement("option");
            opt.value = localidad;
            opt.textContent = localidad;
            localidadSelect.appendChild(opt);
        });
    }

    ciudadInput.addEventListener("change", function() {
        mostrarLocalidades(this.value);
    });
    if (
        ciudadInput.value &&
        ciudadInput.value !== "" &&
        Object.keys(localidadesPorCiudad).includes(ciudadInput.value)
    ) {
        mostrarLocalidades(ciudadInput.value);
    }
});