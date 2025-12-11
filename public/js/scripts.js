console.log("Scripts JS cargado");

window.addEventListener("DOMContentLoaded", (event) => {
    const header = document.querySelector("#header");
    const navbarCollapsible = document.body.querySelector("#mainNav");
    const navbarToggler = document.body.querySelector(".navbar-toggler");
    const navbarResponsive = document.querySelector("#navbarResponsive");

    // Función para cambiar clases al hacer scroll
    const navbarShrink = function() {
        if (!header || !navbarCollapsible) return;

        if (
            window.scrollY === 0 &&
            !navbarResponsive.classList.contains("show")
        ) {
            navbarCollapsible.classList.remove("navbar-shrink");
            header.classList.remove("header-scrolled");
        } else {
            navbarCollapsible.classList.add("navbar-shrink");
            header.classList.add("header-scrolled");
        }
    };

    // Ejecutar al cargar
    navbarShrink();

    // Ejecutar al hacer scroll
    document.addEventListener("scroll", navbarShrink);

    // Activar Bootstrap ScrollSpy
    if (navbarCollapsible && bootstrap.ScrollSpy) {
        bootstrap.ScrollSpy.getOrCreateInstance(document.body, {
            target: "#mainNav",
            rootMargin: "0px 0px -40%",
        });
    }

    // Cerrar menú al hacer click en un link (mobile)
    const responsiveNavItems = document.querySelectorAll(
        "#navbarResponsive .nav-link"
    );
    responsiveNavItems.forEach((item) => {
        item.addEventListener("click", () => {
            if (window.getComputedStyle(navbarToggler).display !== "none") {
                bootstrap.Collapse.getInstance(navbarResponsive) ? .hide();
            }
        });
    });

    // Toggle mobile usando Bootstrap Collapse
    navbarToggler.addEventListener("click", () => {
        if (navbarResponsive.classList.contains("show")) {
            bootstrap.Collapse.getInstance(navbarResponsive) ? .hide();
        } else {
            bootstrap.Collapse.getOrCreateInstance(navbarResponsive).show();
        }
    });

    // Activar SimpleLightbox para portfolio items
    new SimpleLightbox({
        elements: "#portfolio a.portfolio-box",
    });

    // Intersection Observer para animaciones scroll
    const observer = new IntersectionObserver(
        (entries, obs) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("visible");
                    obs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.2 }
    );

    document
        .querySelectorAll(
            ".section-services, .seccion-tenes-emprendimiento, .portfolio-box, .text-white"
        )
        .forEach((el) => observer.observe(el));
});
