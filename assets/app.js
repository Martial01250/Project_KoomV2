/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */


// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

// require('@fortawesome/fontawesome-free/css/all.min.css')
// require('@fortawesome/fontawesome-free/js/all.js')

const hamburgerToggler = document.querySelector(".hamburger");
const navLinksContainer = document.querySelector(".navlinks-container");

const toggleNav = () => {
    hamburgerToggler.classList.toggle("open");

    const ariaToggle = hamburgerToggler.getAttribute("aria-expanded") === "true" ?  "false" : "true";
    hamburgerToggler.setAttribute("aria-expanded", ariaToggle)

    navLinksContainer.classList.toggle("open");
}
hamburgerToggler.addEventListener("click", toggleNav)



new ResizeObserver(entries => {
    if(entries[0].contentRect.width <= 920){
        navLinksContainer.style.transition = "transform 0.3s ease-out"
    } else {
        navLinksContainer.style.transition = "none"
    }
}).observe(document.body)