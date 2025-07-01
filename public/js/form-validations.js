console.log("✅ form-validations.js cargado");

document.addEventListener("DOMContentLoaded", function () {
    
    //Text UpperCase
    document.querySelectorAll(".uppercase").forEach(function (input) {
        input.addEventListener("input", function () {
            this.value = this.value.toUpperCase();
        });
    });

    // Validation for numbers
    const numbersInputs = document.querySelectorAll(
        'input[data-tipo="numbers"]'
    );
    numbersInputs.forEach(function (input) {
        input.addEventListener("keypress", function (e) {
            const key = e.key;
            if (!/^[0-9\s]$/.test(key)) {
                e.preventDefault();
            }
        });

        input.addEventListener("paste", function (e) {
            const pastedData = (
                e.clipboardData || window.clipboardData
            ).getData("text");
            if (/[\d]/.test(pastedData)) {
                e.preventDefault();
            }
        });
    });

    // Validation for school enrollment number
    const matriculaInput = document.getElementById("matricula");
    if (matriculaInput) {
        matriculaInput.addEventListener("keypress", function (e) {
            if (!/^\d$/.test(e.key)) {
                e.preventDefault();
            }
            if (matriculaInput.value.length >= 9) {
                e.preventDefault();
            }
        });

        matriculaInput.addEventListener("paste", function (e) {
            const pastedData = (
                e.clipboardData || window.clipboardData
            ).getData("text");
            if (!/^\d+$/.test(pastedData)) {
                e.preventDefault();
            }
        });
    }

    // Validation for text
    const textInputs = document.querySelectorAll('input[data-tipo="text"]');
    textInputs.forEach(function (input) {
        input.addEventListener("keypress", function (e) {
            const key = e.key;
            if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]$/.test(key)) {
                e.preventDefault();
            }
        });

        input.addEventListener("paste", function (e) {
            const pastedData = (
                e.clipboardData || window.clipboardData
            ).getData("text");
            if (/[\d]/.test(pastedData)) {
                e.preventDefault();
            }
        });
    });

    // Validation for email
    const emailInputs = document.querySelectorAll('input[data-tipo="email"]');
    emailInputs.forEach(function (input) {
        input.maxLength = 64;

        input.addEventListener("keypress", function (e) {
            const key = e.key;
            if (!/^[a-zA-Z0-9&Ññ]$/.test(key)) {
                e.preventDefault();
                return;
            }

            if (input.value.length >= 18) {
                e.preventDefault();
            }
        });

        input.addEventListener("paste", function (e) {
            const pastedData = (
                e.clipboardData || window.clipboardData
            ).getData("text");

            if (!/^[a-zA-Z0-9&Ññ]*$/.test(pastedData)) {
                e.preventDefault();
                return;
            }

            if ((input.value + pastedData).length > 18) {
                e.preventDefault();
            }
        });

        input.addEventListener("blur", function () {
            const emailValue = input.value.trim().toUpperCase();

            const emailRegex = /^[A-ZÑ&]{3,4}\d{6}[A-Z0-9]{3}$/;
        });
    });

    // Validation for CURP
    const curpInputs = document.querySelectorAll('input[data-tipo="curp"]');
    curpInputs.forEach(function (input) {
        input.maxLength = 18;

        input.addEventListener("keypress", function (e) {
            const key = e.key;
            if (!/^[a-zA-Z0-9&Ññ]$/.test(key)) {
                e.preventDefault();
                return;
            }

            if (input.value.length >= 18) {
                e.preventDefault();
            }
        });

        input.addEventListener("paste", function (e) {
            const pastedData = (
                e.clipboardData || window.clipboardData
            ).getData("text");

            if (!/^[a-zA-Z0-9&Ññ]*$/.test(pastedData)) {
                e.preventDefault();
                return;
            }

            if ((input.value + pastedData).length > 18) {
                e.preventDefault();
            }
        });

        input.addEventListener("blur", function () {
            const rfcValue = input.value.trim().toUpperCase();

            const rfcRegex = /^[A-ZÑ&]{3,4}\d{6}[A-Z0-9]{3}$/;
        });
    });

    // Validation for rfc
    const rfcInputs = document.querySelectorAll('input[data-tipo="rfc"]');
    rfcInputs.forEach(function (input) {
        input.maxLength = 18;

        input.addEventListener("keypress", function (e) {
            const key = e.key;
            if (!/^[a-zA-Z0-9&Ññ]$/.test(key)) {
                e.preventDefault();
                return;
            }

            if (input.value.length >= 18) {
                e.preventDefault();
            }
        });

        input.addEventListener("paste", function (e) {
            const pastedData = (
                e.clipboardData || window.clipboardData
            ).getData("text");

            if (!/^[a-zA-Z0-9&Ññ]*$/.test(pastedData)) {
                e.preventDefault();
                return;
            }

            if ((input.value + pastedData).length > 18) {
                e.preventDefault();
            }
        });

        input.addEventListener("blur", function () {
            const rfcValue = input.value.trim().toUpperCase();

            const rfcRegex = /^[A-ZÑ&]{3,4}\d{6}[A-Z0-9]{3}$/;
        });
    });

    //Validation for Date of birth
    const fechaNacimientoInput = document.getElementById("fecha_na");

    if (fechaNacimientoInput) {
        const hoy = new Date();

        const maxFecha = new Date(hoy);
        maxFecha.setFullYear(maxFecha.getFullYear() - 15);

        const minFecha = new Date(hoy);
        minFecha.setFullYear(minFecha.getFullYear() - 80);

        const formatoFecha = (fecha) => {
            const yyyy = fecha.getFullYear();
            const mm = String(fecha.getMonth() + 1).padStart(2, "0");
            const dd = String(fecha.getDate()).padStart(2, "0");
            return `${yyyy}-${mm}-${dd}`;
        };

        fechaNacimientoInput.min = formatoFecha(minFecha);
        fechaNacimientoInput.max = formatoFecha(maxFecha);
    }

    //Validation For Dual Dates
   
    const fechaInicioInput = document.getElementById("inicio_dual");
    const fechaFinInput = document.getElementById("fin_dual");

    // Crear un div para mostrar errores si no existe
    let errorDiv = document.getElementById("fecha_error");
    if (!errorDiv) {
        errorDiv = document.createElement("div");
        errorDiv.id = "fecha_error";
        errorDiv.classList.add("text-danger", "mt-1");
        fechaFinInput.parentElement.appendChild(errorDiv);
    }

    function validarFechas() {
        const fechaInicioValue = fechaInicioInput.value;
        const fechaFinValue = fechaFinInput.value;

        if (!fechaInicioValue || !fechaFinValue) {
            errorDiv.textContent = "";
            return;
        }

        const fechaInicio = new Date(fechaInicioValue);
        const fechaMinimaFin = new Date(fechaInicio);
        fechaMinimaFin.setFullYear(fechaMinimaFin.getFullYear() + 1);

        const fechaFin = new Date(fechaFinValue);

        if (fechaFin < fechaMinimaFin) {
            errorDiv.textContent = "La fecha de fin debe ser al menos 1 año después de la fecha de inicio.";
            fechaFinInput.setCustomValidity("Fecha no válida");
        } else {
            errorDiv.textContent = "";
            fechaFinInput.setCustomValidity(""); // Borra el mensaje si es válida
        }
    }

    fechaFinInput.addEventListener("blur", validarFechas);

    fechaInicioInput.addEventListener("change", function () {
        if (fechaInicioInput.value) {
            const fechaInicio = new Date(fechaInicioInput.value);
            fechaInicio.setFullYear(fechaInicio.getFullYear() + 1);
            const yyyy = fechaInicio.getFullYear();
            const mm = String(fechaInicio.getMonth() + 1).padStart(2, "0");
            const dd = String(fechaInicio.getDate()).padStart(2, "0");

            fechaFinInput.min = `${yyyy}-${mm}-${dd}`;
            validarFechas(); // Revalida por si ya había fecha de fin escrita
        }
    });



    //Validation for date of entry
    const fechaIngresoInput = document.getElementById("inicio");
    const fechaEgresoInput = document.getElementById("fin");

    const fechaMinima = "2001-09-03";
    fechaIngresoInput.min = fechaMinima;
    fechaIngresoInput.value = fechaMinima;

    fechaEgresoInput.min = fechaIngresoInput.value;

    fechaIngresoInput.addEventListener("change", () => {
        if (fechaIngresoInput.value) {
            fechaEgresoInput.min = fechaIngresoInput.value;

            if (
                fechaEgresoInput.value &&
                fechaEgresoInput.value < fechaIngresoInput.value
            ) {
                fechaEgresoInput.value = "";
            }
        }
    });

    fechaEgresoInput.addEventListener("blur", () => {
        if (fechaEgresoInput.value && fechaIngresoInput.value) {
            if (fechaEgresoInput.value < fechaIngresoInput.value) {
                fechaEgresoInput.value = "";
            }
        }
    });

    //Validation for Address

    const addressInput = document.getElementById("direccion");
});
