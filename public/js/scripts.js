window.addEventListener("DOMContentLoaded", (event) => {
    // Navbar shrink function
    var navbarShrink = function() {
        const navbarCollapsible = document.body.querySelector("#mainNav");
        const header = document.querySelector("#header");

        if (!navbarCollapsible) return;
        if (!header) return;

        if (window.scrollY === 0) {
            navbarCollapsible.classList.remove("navbar-shrink");
            header.classList.remove("header-scrolled");
        } else {
            navbarCollapsible.classList.add("navbar-shrink");
            header.classList.add("header-scrolled");
        }
    };

    // Shrink the navbar
    navbarShrink();

    // Shrink the navbar when page is scrolled
    document.addEventListener("scroll", navbarShrink);

    // Activate Bootstrap scrollspy on the main nav element
    const mainNav = document.body.querySelector("#mainNav");
    if (mainNav) {
        new bootstrap.ScrollSpy(document.body, {
            target: "#mainNav",
            rootMargin: "0px 0px -40%",
        });
    }

    // Collapse responsive navbar when toggler is visible
    const navbarToggler = document.body.querySelector(".navbar-toggler");
    const responsiveNavItems = [].slice.call(
        document.querySelectorAll("#navbarResponsive .nav-link")
    );
    responsiveNavItems.map(function(responsiveNavItem) {
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

    // ) Intersection Observer para animaciones
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
            ".section-services, .seccion-tenes-emprendimiento, .portfolio-box,.text-white"
        )
        .forEach((el) => observer.observe(el));
});
