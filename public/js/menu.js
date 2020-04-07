// Accediendo al contenedor activo de la clase contenedor
const contenedor = document.querySelector('#contenedor');
// Accediendo al boton menu y detectar cuando se de un click
document.querySelector('#boton-menu').addEventListener('click', () => {
    contenedor.classList.toggle('active');
});

function abrirNuevoUsu() {
    document.getElementById('nuevo-usuario').style.display="block";
    display = document.querySelector("#blur");
    display.classList.toggle('active');

}
function eliminarUsu(){
    document.getElementById('eliminar-usuario').style.display="block";
    display = document.querySelector("#blur");
    display.classList.toggle('active');
}
function cerrar(){
    document.getElementById('eliminar-usuario').style.display="none";
    document.getElementById('activar-usuario').style.display="none";
    document.getElementById('editar-usuario').style.display="none";
    document.getElementById('nuevo-usuario').style.display="none";
    document.getElementById('blur').classList.remove('active');
    
}