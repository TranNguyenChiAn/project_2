// Nav bar scroll
let navElement = document.querySelector("nav");
let scrollToTopElement = document.querySelector(".scroll-to-top");
window.addEventListener("scroll", () => {
    if (window.scrollY >= 100) {
        navElement.classList.add("shadow");
        //scroll to top button
        scrollToTopElement.classList.remove("opacity-0");
        scrollToTopElement.classList.remove("invisible");
        scrollToTopElement.classList.add("opacity-100");
    } else {
        navElement.classList.remove("shadow");
        //scroll to top button
        scrollToTopElement.classList.remove("opacity-100");
        scrollToTopElement.classList.add("opacity-0");
        scrollToTopElement.classList.add("invisible");
    }
})

//ScrollReveal
var fadeIn = {
    duration: 1500,
    delay: 100,
    easing: "ease",
};
var fadeInFast = {
    duration: 800,
    delay: 100,
    easing: "ease",
};
var fadeTop = {
    distance: "20%",
    origin: "top",
};
var fadeLeft = {
    distance: "20%",
    origin: "left",
};
var fadeRight = {
    distance: "20%",
    origin: "right",
};
var fadeBottom = {
    distance: "20%",
    origin: "bottom",
};

ScrollReveal().reveal(".home-product-text", fadeIn);

ScrollReveal().reveal(".fade-in", fadeIn);
ScrollReveal().reveal(".fade-left", fadeLeft);
ScrollReveal().reveal(".fade-right", fadeRight);
ScrollReveal().reveal(".fade-top", fadeTop);
ScrollReveal().reveal(".fade-bottom", fadeBottom);





