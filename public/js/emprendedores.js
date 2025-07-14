"use strict"

document.addEventListener('DOMContentLoaded', e => {
    console.log(window.mensajeExito);
    if(window.mensajeExito){
        Swal.fire({
            title: "Eliminado!",
            text: window.mensajeExito,
            icon: "success"
        });
    }


    asignarCartel();
    
    document.getElementById('emprendedores-filter').addEventListener("keyup", filtrarEmprendedor);
    document.getElementById('emprendedores-filter').addEventListener("blur", limpiarContenedor);
    document.querySelector(".botonFiltro").addEventListener("click", function(e) {
        e.preventDefault();
    });
    let admin=false;

    function limpiarContenedor(){
        if(document.getElementById('emprendedores-filter').value==""){
            let container = document.getElementById("emprendedores-container");
            container.innerHTML = "";
        }
    }

    function filtrarEmprendedor(){
        estaLogueado();
        if(document.getElementById('emprendedores-filter').value!=""){
            let search = document.getElementById('emprendedores-filter').value;
            fetch(`emprendedores/buscador?busqueda=${search}`, {
                method: 'get'
            })
            .then(response => response.json())
            .then(data => {
                // document.getElementById("emprendedores-container").innerHTML += data
                // console.log(html);
                showContent(data, admin);
            })
            .catch(error => console.log(error))
        }
        else{
            let container = document.getElementById("emprendedores-container");
            container.innerHTML = "";
        }
    }
    async function estaLogueado(){
        try {
            const response=await fetch(`emprendedores/user`);
            if(response.ok){
                const data= await response.json();
                admin=data;
            }
            else{
                console.error('Error al verificar el estado del login: ',response.status);
            }
        } catch (error) {
            console.error('Error en la solicitud:', error);
        }
    }
    
    function crearForm(id){
       
        let form=document.createElement('form');
        form.method='POST';
        form.action=`/emprendedor/${id}`;
        form.classList.add("formEliminar");
        
        const csrf = document.createElement('input');
        csrf.type= 'hidden';
        csrf.name='_token';
        csrf.value=document.querySelector('meta[name=csrf-token]').getAttribute('content');
        
        const method = document.createElement('input');
        method.type= 'hidden';
        method.name='_method';
        method.value='DELETE';

        const input= document.createElement('input');
        input.type="submit";
        input.value="Eliminar emprendimiento";
        input.classList.add("inputEliminar");
        
        form.appendChild(csrf);
        form.appendChild(method);
        form.appendChild(input);
        return form;
    }

    function showContent(results){
        let container = document.getElementById("emprendedores-container");
        container.innerHTML = "";
        if(results.length === 0){
              container.innerHTML += `<p> No se encontraron resultados</p>`;
        }
        results.forEach(emprendimiento =>{

            let card = document.createElement('div');
            card.className = 'card';
            let url="storage/"+emprendimiento.imagen;
            let contenido = `
                <div class="portfolio-item">
                    <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal${emprendimiento.id}">
                        <div class="portfolio-hover">
                                <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <img class="img-fluid" src="${url}" alt="${emprendimiento.nombre}" />
                    </a>
                                    <div class="portfolio-caption">
                                        <div class="portfolio-caption-heading">${emprendimiento.nombre}</div>
                                        <div class="portfolio-caption-subheading text-muted">${emprendimiento.categoria}</div>
                                    </div>
                                </div>
                                <div class="portfolio-modal modal fade" id="portfolioModal${emprendimiento.id}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" class="cierreEmprendedor" />
                                            </div>
                                            <div class="container">
                                                <div class="row justify-content-center">
                                                    <div class="col-lg-8">
                                                        <div class="modal-body">
                                                            <h2 class="text-uppercase"> ${emprendimiento.nombre}</h2>
                                                            <img class="img-fluid d-block mx-auto"
                                                                src=${url}
                                                                alt="${emprendimiento.nombre}" />
                                                            <p>${emprendimiento.descripcion}</p>
                                                            <ul class="list-inline">
                                                                <li>
                                                                    <strong> Emprendedor</strong>
                                                                </li>
                                                                <li>
                                                                    <strong>Categoria:</strong>${emprendimiento.categoria}
                                                                </li>
                                                            </ul>
                                                            <button class="btn btn-primary btn-xl text-uppercase detalleEmprendedor"
                                                                data-bs-dismiss="modal" type="button">
                                                                <a href="/emprendedor/${emprendimiento.id}">
                                                                    ver más acerca de ${emprendimiento.nombre}
                                                                </a>
                                                            </button>
                                                            <div class="containerBotonesEmprendedor">`
            if(admin==true){
                contenido+=                                         `<button
                                                                        class="btn btn-primary btn-xl text-uppercase detalleEmprendedor"
                                                                        data-bs-dismiss="modal" type="button">
                                                                        <a
                                                                            href="/emprendedores/formEditarEmprendimiento/${emprendimiento.id}">
                                                                            Editar emprendimiento
                                                                        </a>
                                                                    </button>
                                                                    <button
                                                                        class="btn btn-primary btn-xl text-uppercase detalleEmprendedor botonEliminar eliminar${emprendimiento.id}"
                                                                        data-bs-dismiss="modal" type="button">
                                                                        
                                                                    </button>
            `};
            contenido+=`
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                </div>`;
            let form=crearForm(emprendimiento.id);
            card.innerHTML=contenido;
            container.appendChild(card);
            document.querySelector(`.eliminar${emprendimiento.id}`).appendChild(form);
            asignarCartel();
        })
    }

    
    function asignarCartel(){
        let formularios=document.querySelectorAll(".formEliminar");
        formularios.forEach(formulario => {
            formulario.addEventListener("submit", (e) => {
                e.preventDefault();
                Swal.fire({
                    title: "¿Estás seguro de eliminar?",
                    text: "¡No se podrá revertir!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#007bff",
                    cancelButtonColor: "rgb(148, 0, 0)",
                    cancelButtonText: "Cancelar",
                    confirmButtonText: "Si, eliminar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        formulario.submit();
                    }
                });
            });
        });
    }
    
});