// OBTENER LOS CAMPOS DEL FORMULARIO

const correo = document.getElementById("correo");
const password = document.getElementById("password");
const confirmarPassword = document.getElementById("confirmar_password");


// EXPRESIONES REGULARES

const patronCorreo = /^[^\s@]+@inemjose\.edu\.co$/i;

const patronPassword = /^(?=.*[A-Z])(?=.*[0-9]).{8,}$/;


// ========================================
// VALIDAR CORREO
// ========================================

function validarCorreo() {

    // Si está vacío
    if (correo.value.trim() === "") {

        correo.setCustomValidity(
            "El correo electrónico es obligatorio."
        );

        return false;
    }


    // Si no pertenece al dominio institucional
    if (!patronCorreo.test(correo.value.trim())) {

        correo.setCustomValidity(
            "Debes usar tu correo institucional @inemjose.edu.co."
        );

        return false;
    }


    // Si todo está correcto
    correo.setCustomValidity("");

    return true;
}


// Mientras escribe
correo.addEventListener("input", function () {

    validarCorreo();

});


// Cuando sale del campo
correo.addEventListener("blur", function () {

    if (!validarCorreo()) {

        correo.reportValidity();

    }

});


// ========================================
// VALIDAR CONTRASEÑA
// ========================================

function validarPassword() {

    if (!patronPassword.test(password.value)) {

        password.setCustomValidity(
            "La contraseña debe tener mínimo 8 caracteres, una mayúscula y un número."
        );

        return false;
    }


    password.setCustomValidity("");

    return true;
}


// Mientras escribe
password.addEventListener("input", function () {

    validarPassword();

});


// Cuando sale del campo
password.addEventListener("blur", function () {

    if (!validarPassword()) {

        password.reportValidity();

    }

});


// ========================================
// CONFIRMAR CONTRASEÑA
// ========================================

function validarConfirmacion() {

    if (confirmarPassword.value !== password.value) {

        confirmarPassword.setCustomValidity(
            "Las contraseñas no coinciden."
        );

        return false;
    }


    confirmarPassword.setCustomValidity("");

    return true;
}


// Mientras escribe
confirmarPassword.addEventListener("input", function () {

    validarConfirmacion();

});


// Cuando sale del campo
confirmarPassword.addEventListener("blur", function () {

    if (!validarConfirmacion()) {

        confirmarPassword.reportValidity();

    }

});

// ========================================
// MOSTRAR / OCULTAR CONTRASEÑA
// ========================================

const botonesPassword = document.querySelectorAll(".toggle-password");


botonesPassword.forEach(function (boton) {

    boton.addEventListener("click", function () {

        // Obtenemos qué input controla este botón
        const idInput = boton.dataset.target;

        const inputPassword = document.getElementById(idInput);


        // Si actualmente está oculta
        if (inputPassword.type === "password") {

            // Mostrar contraseña
            inputPassword.type = "text";

            // Cambiar al ojo abierto
            boton.classList.add("visible");

            boton.setAttribute(
                "aria-label",
                "Ocultar contraseña"
            );

        } else {

            // Ocultar contraseña
            inputPassword.type = "password";

            // Cambiar al ojo cerrado
            boton.classList.remove("visible");

            boton.setAttribute(
                "aria-label",
                "Mostrar contraseña"
            );

        }

    });

});