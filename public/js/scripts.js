console.log("Scripts JS cargado");

window.addEventListener("DOMContentLoaded", (event) => {
    const navbarCollapsible = document.body.querySelector("#mainNav");
    const navbarToggler = document.body.querySelector(".navbar-toggler");

    const navbarShrink = function () {
        const header = document.querySelector("#header");
        if (!header) return;

        if (window.scrollY === 0) {
            header.classList.remove("header-scrolled");
            navbarCollapsible.classList.remove("navbar-shrink");
            document.body.classList.add("at-top"); // clase para CSS
        } else {
            header.classList.add("header-scrolled");
            navbarCollapsible.classList.add("navbar-shrink");
            document.body.classList.remove("at-top");
        }
    };

    // Shrink the navbar
    navbarShrink();

    // Shrink the navbar when page is scrolled
    document.addEventListener("scroll", navbarShrink);

    // Activate Bootstrap scrollspy on the main nav element
    const mainNav = document.body.querySelector("#mainNav");
    if (mainNav && bootstrap.ScrollSpy) {
        bootstrap.ScrollSpy.getOrCreateInstance(document.body, {
            target: "#mainNav",
            rootMargin: "0px 0px -40%",
        });
    }

    const responsiveNavItems = [].slice.call(
        document.querySelectorAll("#navbarResponsive .nav-link")
    );

    navbarToggler.addEventListener("click", () => {
        const isExpanded =
            navbarToggler.getAttribute("aria-expanded") === "true";
        if (isExpanded && window.scrollY === 0) {
            navbarCollapsible.classList.add("navbar-shrink");
            header.classList.add("header-scrolled");
        }
        setTimeout(() => {
            if (!isExpanded && window.scrollY === 0) {
                navbarCollapsible.classList.remove("navbar-shrink");
                header.classList.remove("header-scrolled");
            }
        }, 200);
    });

    responsiveNavItems.map(function (responsiveNavItem) {
        responsiveNavItem.addEventListener("click", () => {
            if (window.getComputedStyle(navbarToggler).display !== "none") {
                navbarToggler.click();
            }
        });
    });

    // Activate SimpleLightbox plugin for portfolio items
    new SimpleLightbox({
        elements: "#portfolio a.portfolio-box",
    });

    // ) Intersection Observer para animaciones scroll
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
            ".section-services, .seccion-tenes-emprendimiento, .portfolio-box,.text-white"
        )
        .forEach((el) => observer.observe(el));

    /*   window.addEventListener("load", () => {
        document
            .querySelectorAll(
                ".section-services, .seccion-tenes-emprendimiento, .portfolio-box, .text-white"
            )
            .forEach((el) => {
                const rect = el.getBoundingClientRect();
                if (rect.top < window.innerHeight) {
                    el.classList.add("visible");
                }
            });
    });*/
});
