console.log("Scripts JS cargado");

window.addEventListener("DOMContentLoaded", (event) => {
    const header = document.querySelector("#header");
    const navbarCollapsible = document.querySelector("#mainNav");
    const navbarToggler = document.querySelector(".navbar-toggler");
    const responsiveNavItems = Array.from(
        document.querySelectorAll("#navbarResponsive .nav-link")
    );

    // Función para manejar el scroll y aplicar clases
    const navbarShrink = () => {
        if (!header) return;

        if (window.scrollY === 0) {
            header.classList.remove("header-scrolled");
            navbarCollapsible.classList.remove("navbar-shrink");
            document.body.classList.add("at-top");
        } else {
            header.classList.add("header-scrolled");
            navbarCollapsible.classList.add("navbar-shrink");
            document.body.classList.remove("at-top");
        }
    };

    // Ejecutar al cargar
    navbarShrink();

    // Ejecutar al hacer scroll
    window.addEventListener("scroll", navbarShrink);

    // Toggle navbar mobile: solo abre/cierra, no modifica clases de scroll
    if (navbarToggler) {
        navbarToggler.addEventListener("click", () => {
            navbarCollapsible.classList.toggle("show");
        });
    }

    // Cerrar navbar al click en link (mobile)
    responsiveNavItems.forEach((item) => {
        item.addEventListener("click", () => {
            if (window.getComputedStyle(navbarToggler).display !== "none") {
                navbarToggler.click();
            }
        });
    });

    // Bootstrap ScrollSpy
    if (navbarCollapsible && bootstrap.ScrollSpy) {
        bootstrap.ScrollSpy.getOrCreateInstance(document.body, {
            target: "#mainNav",
            rootMargin: "0px 0px -40%",
        });
    }

    // SimpleLightbox para portfolio
    new SimpleLightbox({
        elements: "#portfolio a.portfolio-box",
    });

    // Intersection Observer para animaciones
    const observer = new IntersectionObserver(
        (entries, obs) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("visible");
                    obs.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.2 }
    );

    document
        .querySelectorAll(
            ".section-services, .seccion-tenes-emprendimiento, .portfolio-box, .text-white"
        )
        .forEach((el) => observer.observe(el));
});
