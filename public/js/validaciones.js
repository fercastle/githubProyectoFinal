

const form = document.getElementById('form-usuario');
const nombre = document.getElementById('nombre');
const fechaNacimiento= document.getElementById('fechaNacimiento');
const apellido = document.getElementById('apellido');
const dui = document.getElementById('dui');
const telefono = document.getElementById('telefono');
const direccion = document.getElementById('direccion');
const usuario = document.getElementById('usuario');
const password1 = document.getElementById('password1');
const password2 = document.getElementById('password2');


form.addEventListener('submit', e => {
	e.preventDefault();
	validarFechaNacimiento();
	validarNombre();
	validarApellido();
	validarDui();
	validarTelefono();
	validarUsuario();
	validarDireccion();
	validarPassword1();
	validarPassword2();

	
	//checkInputs();
});



function validarNombre(){
	const nombreValue = nombre.value.trim();

	if(nombreValue === '') 
		setErrorFor(nombre, 'Ingrese un nombre');
	else if(nombreValue.length > 50)
		setErrorFor(nombre, 'Este campos permite hasta 50 caracteres');
	else 
		setSuccessFor(nombre);
} 


function validarApellido(){
	const apellidoValue = apellido.value.trim();

	if(apellidoValue === '') 
		setErrorFor(apellido, 'Ingrese un apellido');
	else if(apellidoValue.length > 50)
		setErrorFor(apellido, 'El apellido debe de contener menos de 50 caracteres');
	else 
		setSuccessFor(apellido);
}
function validarFechaNacimiento(){
	const fechaNacimientoValue = fechaNacimiento.value.trim();

	if(fechaNacimientoValue === '') 
		setErrorFor(fechaNacimiento, 'Ingrese una fecha');
	else 
		setSuccessFor(fechaNacimiento);
}

function validarDui(){
	const duiValue = dui.value.trim();

	if(duiValue === '') 
		setErrorFor(dui, 'Ingrese un numero de DUI');
	else if(duiValue.length > 10)
		setErrorFor(dui, 'El dui debe de contener menos de 10 caracteres');
	else 
		setSuccessFor(dui);
}


function validarTelefono(){
	const telefonoValue = telefono.value.trim();

	if(telefonoValue === '') 
		setErrorFor(telefono, 'Ingrese un numero de Telefono');
	else if(telefonoValue.length > 10)
		setErrorFor(telefono, 'El telefono no debe ser mayor a 10 digitos');
	else 
		setSuccessFor(telefono);
}


function validarDireccion(){
	const direccionValue = direccion.value.trim();

	if(direccionValue === '') 
		setErrorFor(direccion, 'Ingrese una direccion');
	else if(direccionValue.length < 50)
		setErrorFor(direccion, 'La direccion debe de contener menos de 50 caracteres');
	else 
		setSuccessFor(direccion);
}

function validarUsuario(){
	const usuarioValue = usuario.value.trim();

	if(usuarioValue === '') 
		setErrorFor(usuario, 'Debe completar este campo');
	else if(usuarioValue.length > 10)
		setErrorFor(usuario, 'El nombre debe de contener menos de 50 caracteres');
	else 
		setSuccessFor(usuario);
}

function validarPassword1(){
	const password1Value = password1.value.trim();

	if(password1Value === '') 
		setErrorFor(password1, 'Debe completar este campo');
	else if(password1Value.length > 10)
		setErrorFor(password1, 'El nombre debe de contener menos de 50 caracteres');
	else 
		setSuccessFor(password1);
}

function validarPassword2(){
	const password2Value = password2.value.trim();

	if(password2Value === '') 
		setErrorFor(password2, 'Debe completar este campo');
	else if(password2Value.length > 10)
		setErrorFor(password2, 'El nombre debe de contener menos de 50 caracteres');
	else 
		setSuccessFor(password2);
}

function setErrorFor(input, message) {
	const inputBox = input.parentElement;
	const small = inputBox.querySelector('small');
	inputBox.className = 'inputBox error';
	small.innerText = message;
}

function setSuccessFor(input) {
	const inputBox = input.parentElement;
	inputBox.className = 'inputBox success';
}


