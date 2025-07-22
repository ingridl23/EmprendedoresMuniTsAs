document.addEventListener("DOMContentLoaded", () => {
    const formulario = document.querySelector(".form");
    const buttonform = document.querySelector(".submit");

    formulario.addEventListener("submit", (e) => {
        e.preventDefault();
    });
});