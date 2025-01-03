// JavaScript para manejar el menú desplegable
document.addEventListener('DOMContentLoaded', () => {
    const toggleButton = document.querySelector('.menu-toggle');
    const menu = document.querySelector('nav ul');

    // Cambiar el icono del botón de menú
    toggleButton.addEventListener('click', () => {
        menu.classList.toggle('collapsed');
        if (menu.classList.contains('collapsed')) {
            toggleButton.innerHTML = '✖'; // Icono de menú abierto
        } else {
            toggleButton.innerHTML = '☰'; // Icono de menú cerrado
        }
    });

    // Configuración inicial del icono
    toggleButton.innerHTML = '☰';
});
