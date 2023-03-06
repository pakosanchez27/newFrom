// Esto se ejecuta cuando todo el documento html se halla cargado

document.addEventListener('DOMContentLoaded', function () {


    // Creamos un objeto para validar los campos que esten vacios

    const campos = {
        nombre: '',
        apellido: '',
        email: '',
        fecha: '',
        carrera: '',
        comentario: '',
        sexo: '',
        conocimiento: []
    }

    // Seleccionamos los elementos de la interfaz

    const InputNombre = document.querySelector('#nombre');
    const InputApellido = document.querySelector('#apellido');
    const InputEmail = document.querySelector('#email');
    const InputFecha = document.querySelector('#fecha');
    const InputHombre = document.querySelector('#hombre');
    const InputMujer = document.querySelector('#mujer');
    const InputCarrera = document.querySelector('#carrera');
    const Inputcheks = document.querySelectorAll('.checkbox-input');
    const InputComentario = document.querySelector('#comentario');
    const btnEnviar = document.querySelector("#enviar");
    const btnLimpiar = document.querySelector("#limpiar");
    const spinner = document.querySelector('#spinner');


    // Seleccionamos el Formulario para agregar alertas
    const formulario = document.querySelector('#formulario');

    // Agregamos eventos a los elementos

    // Eventos blur
    InputNombre.addEventListener('blur', validar);
    InputApellido.addEventListener('blur', validar);
    InputEmail.addEventListener('blur', validar);
    InputFecha.addEventListener('blur', validar);
    InputCarrera.addEventListener('blur', validar);
    InputComentario.addEventListener('blur', validar);

    // Eventos change
    InputHombre.addEventListener('change', validarSexo);
    InputMujer.addEventListener('change', validarSexo);

    // Como este es  arreglos se ocupa el ArrayMEthod forEach
    Inputcheks.forEach(skills => {
        skills.addEventListener('click', validarSkills);
    });


    // Evento para enviar la informacion{
    formulario.addEventListener('submit', enviarInfo);

    btnLimpiar.addEventListener('change', function (e) {
        e.preventDefault();

        // Reiniciar el objeto

        campos.nombre = '';
        campos.apellido = '';
        campos.email = '';
        campos.fecha = '';
        campos.carrera = '';
        campos.comentario = '';
        campos.sexo = '';
        campos.conocimiento = '';

        formulario.reset();
        comprobarCampos();
    })




    // Cramos Funciones


    // funcion de validar Inputs de tipo text

    function validar(e) {
        if (e.target.value.trim() === '') {
            mostrarAlerta(`El ${e.target.id} es obligatorio`, e.target.parentElement);
            campos[e.target.name] = '';
            comprobarCampos();
            return;
        }

        if (e.target.id === 'email' && !validarEmail(e.target.value)) {
            mostrarAlerta('El email no es valido', e.target.parentElement);
            campos[e.target.name] = '';
            comprobarCampos();
            return;
        }


        limpiarAlerta(e.target.parentElement);

        // Asignar valores al objeto
        campos[e.target.name] = e.target.value.trim().toLowerCase();


    }
    // funcion de validar Inputs de tipo radio
    function validarSexo(e) {
        if (!InputHombre.checked && !InputMujer.checked) {
            mostrarAlerta('El genero es obligatorio', e.target.parentElement);
            campos[e.target.name] = '';
            comprobarCampos();
            return;
        }
        limpiarAlerta(e.target.parentElement);

        // Asignar valor al objeto
        campos[e.target.name] = e.target.value.trim();
    }
    // funcion de validar Inputs de tipo check box
    function validarSkills(e) {
        
        let contador = 0;

        Inputcheks.forEach(function(checkbox) {
            if (checkbox.checked) {
              contador++;
            }
          });

          console.log(contador);

          if(contador === 0){
            mostrarAlerta('selecciona al menos 1', e.target.parentElement);
            campos[e.target.name] = '';
            comprobarCampos();
           
          }else{
            limpiarAlerta(e.target.parentElement);
            campos[e.target.name] = true;
            comprobarCampos();
       
          }
          
    
       
    }
    // Funcion para mostrar alerta

    function mostrarAlerta(mensaje, referencia) {
        limpiarAlerta(referencia);

        // Generamos un elemento HTML que muestre el msj de error

        const error = document.createElement('P');
        error.textContent = mensaje;
        error.classList.add('alerta');


        // Inyectar el elemento al html

        referencia.appendChild(error);
    }

    function limpiarAlerta(referencia) {
        // Hacer que no se repita las alertas
        const alerta = referencia.querySelector('.alerta');
        if (alerta) {
            alerta.remove();
        }
    }

    // Funcion para validar el email con una expresion regular
    function validarEmail(email) {
        const regex = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
        const resultado = regex.test(email);
        return resultado;

    }

    // funcion para validar que ningun campo este vacio

    function comprobarCampos() {
        console.log(Object.values(campos));
        console.log(Object.values(campos));
        // esta linea "Object.values(campos).includes('')" verifica que no haya campos vacios 
        if (Object.values(campos).includes('')) {
            btnEnviar.classList.add('opacity50');
            btnEnviar.disabled = true;
        } else {
            btnEnviar.classList.remove('opacity50');
            btnEnviar.disabled = false;
        }
    }

    function enviarInfo(e) {

        e.preventDefault();
        spinner.classList.remove('hidden');

        setTimeout(() => {
            spinner.remove();
            formulario.submit();
        }, 3000);


    }


});
