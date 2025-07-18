"use scrict"
document.addEventListener('DOMContentLoaded', e=>{
    document.getElementById('noticias-filter').addEventListener("keyup", filtrarEmprendedor);
    document.getElementById('noticias-filter').addEventListener("blur", limpiarContenedor);
    document.querySelector(".botonFiltro").addEventListener("click", function(e) {
        e.preventDefault();
    });
    let admin=false;

    function limpiarContenedor(){
        if(document.getElementById('noticias-filter').value==""){
            let container = document.getElementById("noticias-container");
            container.innerHTML = "";
        }
    }

    function filtrarEmprendedor(){
        if(document.getElementById('noticias-filter').value!=""){
            let search = document.getElementById('noticias-filter').value;
            fetch(`noticias/buscador?busqueda=${search}`, {
                method: 'get'
            })
            .then(response => response.json())
            .then(data => {
                showContent(data, admin);
            })
            .catch(error => console.log(error))
        }
        else{
            let container = document.getElementById("noticias-container");
            container.innerHTML = "";
        }
    }

     function showContent(results){
        let container = document.getElementById("noticias-container");
        container.innerHTML = "";
        if(results.length === 0){
              container.innerHTML += `<p> No se encontraron resultados</p>`;
        }
        results.forEach(noticia =>{
            let fecha = new Date(noticia.updated_at);
            let soloFecha = fecha.toISOString().split('T')[0];
            let card = document.createElement('div');
            let url="storage/"+noticia.imagen;
            let contenido = `
                <div class="card mb-3">
                    <img src="${url}" class="card-img-top1"
                        alt="...">
                    <div class="card-body">
                        <h5 class="card-title">${noticia.titulo}</h5>
                        <p class="card-text">${noticia.categoria}</p>
                        <div class="container-vermas">
                            <p class="card-text actualizacionFecha"><small class="text-body-secondary">Última actualización: ${soloFecha}</small></p>
                            <a href="/noticias/${noticia.id}">
                                <button class="vermas">Ver más</button>
                            </a>
                        </div>
                    </div>
                </div>`;
            card.innerHTML=contenido;
            container.appendChild(card);
                
        });
        let linea = document.createElement('hr');

        container.appendChild(linea);
    }

})