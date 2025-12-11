"use strict";

console.log("Navbar JS cargado");

document.addEventListener("DOMContentLoaded", function () {
    let contenedores = document.querySelectorAll(".containerLinksExternos");
    contenedores.forEach((contenedor) => {
        asignarClase(contenedor);
    });

    window.addEventListener("scroll", function () {
        contenedores.forEach((contenedor) => {
            asignarClase(contenedor);
        });
    });

    function asignarClase(contenedor) {
        let icono = contenedor.querySelector("i"); // solo iconos
        let texto = contenedor.querySelector(".btn-text");

        if (window.pageYOffset > 0) {
            if (icono) icono.classList.add("colorNuevoIcono");
            if (texto) texto.classList.add("colorNuevoTexto");
        } else {
            if (icono) icono.classList.remove("colorNuevoIcono");
            if (texto) texto.classList.remove("colorNuevoTexto");
        }
    }
});
