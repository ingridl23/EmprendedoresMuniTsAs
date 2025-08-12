"use script"

document.addEventListener("DOMContentLoaded", ()=>{
     let contenedorLoader = document.querySelector(".contenedor_loader");
    window.addEventListener('load', ()=>{
        contenedorLoader.style.opacity = 0; 
        contenedorLoader.style.visibility = 'hidden'; 
    })

    
})
