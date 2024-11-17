function showMenu() {
    document.getElementById('popup-menu').style.display = 'flex';
}

function hideMenu() {
    document.getElementById('popup-menu').style.display = 'none';
}
// script.js
function toggleMenu() {
    var menu = document.getElementById("dropdown-menu");
    if (menu.style.display === "none" || menu.style.display === "") {
        menu.style.display = "block";
    } else {
        menu.style.display = "none";
    }
}


