"use strict";

document.addEventListener("DOMContentLoaded", function () {
    let contenedores = document.querySelectorAll(".containerLinksExternos");
    contenedores.forEach((contenedor) => {
        asignarClase(contenedor);
    });

    window.addEventListener("scroll", function () {
        if (this.window.pageXOffset == 0) {
            contenedores.forEach((contenedor) => {
                asignarClase(contenedor);
            });
        }
    });

    function asignarClase(contenedor) {
        let hijos = contenedor.children;
        let icono = hijos[0];
        let texto = hijos[1];
        if (window.pageYOffset > 0) {
            icono.classList.add("colorNuevoIcono");
        } else {
            icono.classList.remove("colorNuevoIcono");
        }
        if (window.pageYOffset > 0) {
            texto.classList.add("colorNuevoTexto");
        } else {
            texto.classList.remove("colorNuevoTexto");
        }
    }
});
