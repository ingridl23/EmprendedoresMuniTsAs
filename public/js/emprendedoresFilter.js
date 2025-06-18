"use strict"

document.addEventListener('DOMContentLoaded', e => {

    document.getElementById('emprendedores-filter').addEventListener("keyup", filtrarEmprendedor);
    document.getElementById('emprendedores-filter').addEventListener("blur", limpiarContenedor);

    function limpiarContenedor(){
        if(document.getElementById('emprendedores-filter').value==""){
            let container = document.getElementById("emprendedores-container");
            container.innerHTML = "";
        }
    }

    function filtrarEmprendedor(){
        if(document.getElementById('emprendedores-filter').value!=""){
            let search = document.getElementById('emprendedores-filter').value;
            fetch(`api/emprendimientos/buscador?busqueda=${search}`, {
                method: 'get'
            })
            .then(response => response.json())
            .then(data => {
                // document.getElementById("emprendedores-container").innerHTML += data
                // console.log(html);
            showContent(data)

            })
            .catch(error => console.log(error))
        }
        else{
            let container = document.getElementById("emprendedores-container");
            container.innerHTML = "";
        }
    }

    function showContent(results){
        let container = document.getElementById("emprendedores-container");
        container.innerHTML = "";
        if(results.length === 0){
              container.innerHTML += `<p> No se encontraron resultados</p>`;
        }
        results.forEach(emprendimiento => {
            let card = document.createElement('div');
            card.className = 'card';
            let img=document.createElement('img');
            img.alt="Imagen de "+emprendimiento.nombre;
            let url="storage/"+emprendimiento.imagen;
            img.classList.add("card-img-top");
            img.src=url;
           
            card.innerHTML = `
            <div class="card-body">
                <h5 class="card-title">${emprendimiento.nombre}</h5>
                <p class="card-text">${emprendimiento.categoria}</p>
                <a href="/emprendimientos/${emprendimiento.id}" class="btn btn-primary">Go somewhere</a>
            </div>
            </div>`;
            container.appendChild(card);
            card.prepend(img);

        })




    }
});
