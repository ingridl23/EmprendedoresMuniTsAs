"use strict"

document.addEventListener('DOMContentLoaded', e => {

    document.getElementById('emprendedores-filter').addEventListener("keyup", filtrarEmprendedor);

    function filtrarEmprendedor(){
        let search = document.getElementById('emprendedores-filter').value;

        console.log(document.getElementById('emprendedores-filter').value)

        fetch(`/emprendimientos/buscador?busqueda=${search}`, {
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

    function showContent(results){
        let container = document.getElementById("emprendedores-container");
        container.innerHTML = "";

        if(results.length === 0){
              container.innerHTML += `<p> No se encontraron resultados</p>`;
        }

        results.forEach(emprendimiento => {
            let card = document.createElement('div');
            card.className = 'card';

            card.innerHTML = `
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">${emprendimiento.nombre}</h5>
                <p class="card-text">${emprendimiento.categoria}</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
            </div>`;
            container.appendChild(card);
        })




    }
});
