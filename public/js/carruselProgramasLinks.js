"use strict"

document.addEventListener("DOMContentLoaded", function(){
    
    
/*MANEJO DE CARRUSEL DE LINKS INTERNOS*/

const carousel = document.querySelector('.carouselLinks');
const inner = document.querySelector('.carousel-links-inner');
const items = document.querySelectorAll('.carousel-links-item');
const item = items[0];
const prevButton = document.querySelector('.control-prev');
const nextButton = document.querySelector('.control-next');

let currentIndex = 0;


/**
 * Pantalla más grande
 * Se muestran 3 cards al mismo tiempo entonces, faltaba la posibilidad de que, al tocar el botón de Next, muestre la última card con el link interno al programa
 */
if(window.matchMedia("(min-width:650px) and (max-width: 1200px)").matches){
    let scrollPosition=0;
    items.forEach(itemFor=>{
        itemFor.classList.remove('visible');
    });

    //Se encarga de que, si se da siguiente, muestre la última card que queda (son cuatro cards y se muestran tres, entonces solo quedaria una sin mostrar)
    //Si da siguiente y es la última card, llevará al usuario a la primera card
    function goToSlideNextGrande() {
        console.log("Scroll: "+scrollPosition);
        let cardWith=item.clientWidth; /*211px*/
        scrollPosition=scrollPosition + cardWith;
            if(scrollPosition==cardWith){
                 $('.carousel-links-inner').animate({scrollLeft: scrollPosition}, 600);
            }
            else{
                scrollPosition=0;
                 $('.carousel-links-inner').animate({scrollLeft: scrollPosition}, 600);
            }
    }

     //Se encarga de que, si se da al anterior, muestre la card previa a esa
    //Si da anterior y es la primera card, llevará al usuario a la última card
    function goToSlidePreviousGrande() {
        let cardWith=item.clientWidth; /*338.5*/
        scrollPosition=scrollPosition - cardWith;
        if(scrollPosition<0){
            scrollPosition=cardWith;
            $('.carousel-links-inner').animate({scrollLeft: scrollPosition}, 600);
        }else{
            $('.carousel-links-inner').animate({scrollLeft: scrollPosition}, 600);
        }
    }
    prevButton.addEventListener('click', () => goToSlidePreviousGrande());
    nextButton.addEventListener('click', () => goToSlideNextGrande());
}



/**
 * Pantalla intermedia
 * Muestra dos Cards al mismo tiempo
 */
if(window.matchMedia("(min-width:420px) and (max-width: 650px)").matches){
    let scrollPositionGrande=0;
    items.forEach(itemFor=>{
        itemFor.classList.remove('visible');
    });

    //Cuando se da click en Next, deberá moverse una card para adelante para mostrar la siguiente
    //De ser la última, llevará al usuario a la primera cargada (scrollPositionGrande=0)
    function goToSlideNextGrande() {
        let cardWith=item.clientWidth; 
        scrollPositionGrande=scrollPositionGrande + cardWith;
        if(scrollPositionGrande<=(cardWith*2)){
            $('.carousel-links-inner').animate({scrollLeft: scrollPositionGrande}, 600);
        }
        else{
            scrollPositionGrande=0;
            $('.carousel-links-inner').animate({scrollLeft: scrollPositionGrande}, 600);
        }
    }

    //Cuando se da click en el anterior, deberá moverse una card para atrás para mostrar la card previa a esa
    //De ser la primera, llevará al usuario a la última cargada (scrollPositionGrande=cardWidth*2)
    function goToSlidePreviousGrande() {
        let cardWith=item.clientWidth; /*338.5*/
        scrollPositionGrande=scrollPositionGrande - cardWith;
            if(scrollPositionGrande<0){
                scrollPositionGrande=cardWith*2;
                $('.carousel-links-inner').animate({scrollLeft: scrollPositionGrande}, 600);
            }else{
                $('.carousel-links-inner').animate({scrollLeft: scrollPositionGrande}, 600);
            }
    }
    prevButton.addEventListener('click', () => goToSlidePreviousGrande());
    nextButton.addEventListener('click', () => goToSlideNextGrande());
}

/**
 * Pantalla más chica
 * Se muestra de a una card
*/
if(window.matchMedia("(min-width:1px) and (max-width:420px)").matches){
    let scrollPositionChico=0;
    items.forEach(itemFor=>{
        itemFor.classList.remove('visible');
    });

    //Cuando se da click en Next, deberá moverse una card para adelante para mostrar la siguiente
    //De ser la última, llevará al usuario a la primera cargada (scrollPositionChico=0)
    function goToSlideNextChico() {
        let cardWith=item.clientWidth; 
        scrollPositionChico=scrollPositionChico + cardWith;
        if(scrollPositionChico<=(cardWith*3)){
            $('.carousel-links-inner').animate({scrollLeft: scrollPositionChico}, 600);
        }
        else{
            scrollPositionChico=0;
            $('.carousel-links-inner').animate({scrollLeft: scrollPositionChico}, 600);
        }
    }

    //Cuando se da click en el anterior, deberá moverse una card para atrás para mostrar la anterior
    //De ser la primera, llevará al usuario a la última cargada (scrollPositionChico=cardWidth*3)
    function goToSlidePreviousChico() {
        let cardWith=item.clientWidth; /*338.5*/
        scrollPositionChico=scrollPositionChico - cardWith;
            if(scrollPositionChico<0){
                scrollPositionChico=cardWith*3;
                $('.carousel-links-inner').animate({scrollLeft: scrollPositionChico}, 600);
            }else{
                $('.carousel-links-inner').animate({scrollLeft: scrollPositionChico}, 600);
            }
    }
    prevButton.addEventListener('click', () => goToSlidePreviousChico());
    nextButton.addEventListener('click', () => goToSlideNextChico());
}
})