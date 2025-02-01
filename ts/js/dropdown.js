"use strict";
/* When the user clicks on the button, toggle between hiding and showing the dropdown content */
function myFunction() {
    const dropdown = document.getElementById("myDropdown");
    if (dropdown) {
        dropdown.classList.toggle("show");
    }
}
/* Close the dropdown menu if the user clicks outside of it */
window.onclick = function (event) {
    const target = event.target;
    const dropdown = document.getElementById("myDropdown");
    const dropdownButton = document.querySelector(".dropbtn");
    // Verifica si el clic no fue en el botón ni en el menú desplegable
    if (dropdown &&
        dropdownButton &&
        !dropdown.contains(target) &&
        !dropdownButton.contains(target)) {
        dropdown.classList.remove("show");
    }
};
//# sourceMappingURL=dropdown.js.map