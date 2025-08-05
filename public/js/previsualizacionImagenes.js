"use script"

document.addEventListener("DOMContentLoaded", function(){

    document.getElementById('imagenes').addEventListener('change', function(e){
        let files = e.target.files;
        let contenedor = document.getElementById('previousImagen');
        contenedor.textContent="";
        for (let index = 0; index < 5; index++) {
            const file = files[index];
            const reader= new FileReader(); //Leer archivo y mostrar

            reader.onload=function(){
                let img=document.createElement('img');
                img.src= reader.result;
                img.style.display="block";
                contenedor.appendChild(img);
            }

            reader.readAsDataURL(file);
        }
        
    })

})