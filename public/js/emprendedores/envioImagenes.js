"use script";

document.addEventListener("DOMContentLoaded", () => {
    let formEditar = document.querySelector("#editarForm");
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    let contenedor = document.getElementById("previousImagen");
    let mostrarElems = contenedor.dataset.mostrar == "true";
    let input = document.getElementById("imagenes");
    const MAX = 5;
    let dtCopia = new DataTransfer();
    let contenedorLoader = document.querySelector(".contenedor_loader");

    let imagenesTotales = []; //Total de imgs (tanto backend como las que se cargan)

    const imagenesJSON = JSON.parse(contenedor.dataset.array || "[]"); // array de imágenes existentes desde el backend (editar emprendimiento)
    if (mostrarElems) {
        imagenesJSON.forEach((img) => {
            imagenesTotales.push({
                tipo: "precargada",
                nombre: img.name,
                url: img.url,
                public_id: img.public_id,
                id: img.id,
            });
        });
    }

    formEditar.addEventListener("submit", (e) => {
        e.preventDefault();
        console.log(imagenesTotales)
        let id = formEditar.dataset.id;
        let formData = new FormData();

        if (imagenesTotales.length > 0) {
            contenedorLoader.style.opacity = 1;
            contenedorLoader.style.visibility = "visible";
            imagenesTotales.forEach((img) => {
                if (img.tipo == "nuevo") {
                    formData.append("imagenes[]", img.file); // archivos reales
                }
            });

            formData.append(
                "imagenes_conservar",
                JSON.stringify(imagenesTotales)
            );


            //Sirve para visualizar en consola los datos guardados en formData
            for (let [key, value] of formData.entries()) {
                console.log(
                    `${key}:`,
                    value instanceof File ? value.name : value
                );
            }

            fetch(`/emprendedores/editarImgs/${id}`, {
                method: "post",
                body: formData,
                headers: { "X-CSRF-TOKEN": csrfToken },
            })
                .then(async (response) => {
                    const data = await response.json();
                    console.log(data);
                    if (!response.ok) {
                         Swal.fire({
                            title: "Error",
                            text: "Hubo un error inesperado en la carga de imagenes, intentelo nuevamente.",
                            icon: "error",
                            confirmButtonColor: "#36be7f",
                        });
                        contenedorLoader.style.opacity = 0;
                        contenedorLoader.style.visibility = "hidden";
                        imagenesTotales = imagenesTotales.filter(img => img.tipo !== "nuevo");
                        input.value = "";
                        modificarVista();
                        throw new Error("Error en el envío de imágenes");
                    }
                    return data;
                })
                .then((data) => {
                    document.querySelector("#editarForm").submit();
                })
                .catch((error) => {
                    console.log(error)
                    contenedorLoader.style.opacity = 0;
                    contenedorLoader.style.visibility = "hidden";
                });
        } else {
            Swal.fire({
                title: "Error",
                text: "Se necesita tener cargado al menos una imagen del emprendimiento.",
                icon: "error",
                confirmButtonColor: "#36be7f",
            });
        }
    });

    // Mostrar al iniciar
    modificarVista();

    //Cuando se decida agregar más imgs
    input.addEventListener("change", () => {
        const nuevosArchivos = Array.from(input.files);
        const espacioDisponible = MAX - imagenesTotales.length;
        if (espacioDisponible <= 0) {
            Swal.fire({
                title: "Error",
                text: `Solo se permiten ${MAX} imágenes en total.`,
                icon: "error",
                confirmButtonColor: "#36be7f",
            });
            input.files = dtCopia;
            return;
        }
        const archivosPermitidos = nuevosArchivos.slice(0, espacioDisponible);
        archivosPermitidos.forEach((file) => {
            imagenesTotales.push({
                tipo: "nuevo",
                nombre: file.name,
                file: file,
                url: URL.createObjectURL(file),
            });
        });

        modificarVista();
    });

    //Para cuando se agrega nuevas imgs y mostrar la vista
    function modificarVista() {
        contenedor.innerHTML = "";
        const dt = new DataTransfer();

        imagenesTotales.forEach((file, index) => {
            const url =
                file.tipo === "nuevo"
                    ? URL.createObjectURL(file.file)
                    : file.url;

            let wrap = document.createElement("div");
            wrap.classList.add("position");
            wrap.dataset.index = index;

            let img = document.createElement("img");
            img.src = url;
            img.alt = file.name;
            img.classList.add("imgEmprendimiento");

            let boton = document.createElement("button");
            boton.type = "button";
            boton.classList.add("cierreEmprendedor");

            let imgCierre = document.createElement("img");
            imgCierre.src = "/assets/img/iconos/close-icon-imgs.png";

            boton.appendChild(imgCierre);

            boton.addEventListener("click", () => {
                imagenesTotales.splice(index, 1);
                modificarVista();
            });

            wrap.appendChild(img);
            wrap.appendChild(boton);
            contenedor.appendChild(wrap);

            if (file.tipo === "nuevo") {
                dt.items.add(file.file);
            }
        });
        input.files = dt.files;
        dtCopia = dt.files;
    }
});
