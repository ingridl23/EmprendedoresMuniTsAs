// Varios botones de las vistas son <button><a href="...">Texto</a></button>: solo el texto del enlace
// navegaba y un clic en el resto del botón no hacía nada. Con esto, un clic en cualquier parte del botón
// sigue su enlace. Usa delegación, así también cubre los botones que se generan por JS (buscador de noticias).
document.addEventListener('click', function (evento) {
    if (evento.target.closest('a')) {
        return; // el clic ya fue sobre el enlace: el navegador lo sigue solo
    }
    const boton = evento.target.closest('button');
    const enlace = boton ? boton.querySelector(':scope > a[href]') : null;
    if (enlace) {
        window.location.href = enlace.href;
    }
});
