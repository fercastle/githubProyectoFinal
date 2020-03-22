// Accediendo al contenedor activo de la clase contenedor
const contenedor = document.querySelector('#contenedor');
// Accediendo al boton menu y detectar cuando se de un click
document.querySelector('#boton-menu').addEventListener('click', () => {
    contenedor.classList.toggle('active');
});

function toggle(){
    var blur = document.getElementById('blur');
    blur.classList.toggle('active');
    // popup-usuario
    var popup = document.getElementById('popup');
    //popup-usuario
    popup.classList.toggle('active');
}
