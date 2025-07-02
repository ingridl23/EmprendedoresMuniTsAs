document.addEventListener("DOMContentLoaded", () => {

    let campoLocalidad=document.querySelector("#localidadesDeLaCiudad");
    let campoCiudad=document.querySelector("#ciudad");
    let labelCiudad=document.querySelector(".direccionEmprendimiento");
    campoCiudad.addEventListener('change',function(){
        const valor=this.value;
        document.querySelector(".localidadesDeLaCiudad").classList.remove("oculto");
        document.querySelector(".localidadesDeLaCiudad").classList.add("mostrar");
        labelCiudad.classList.add("seleccionLocalidad");
        document.querySelector(".localidad").classList.add("seleccionLocalidad");
        mostrarOpcionesSegunCiudad(valor);
    });

    function mostrarOpcionesSegunCiudad(valor){
        const TresArroyos=["Tres Arroyos", "Claromecó", "Orense", "Reta", "Copetonas", "Micaela Cascallares", "San Francisco de Bellocq",
            "San Mayol", "Lin Calel", "Barrow"];
        const AdolfoGonzalesChaves=["Adolfo Gonzales Chaves", "De La Garma", "Juan Elogio Barra", ];
        const BenitoJuarez=["Benito Juarez", "Villa Cacique", "Barker", "Estación López", "Tedín Uriburu"];
        switch(valor){
            case "Tres Arroyos":
                generarOptions(TresArroyos);
                break;
            case "Adolfo Gonzales Chaves":
                generarOptions(AdolfoGonzalesChaves);
                break;
            default:
                generarOptions(BenitoJuarez);
        }
    }
    

    function generarOptions(TresArroyos){
        campoLocalidad.innerHTML='';
        TresArroyos.forEach(function(localidad){
            let card = document.createElement('option');
            card.innerHTML = `
            ${localidad}`;
            campoLocalidad.appendChild(card);
        })
    }

})