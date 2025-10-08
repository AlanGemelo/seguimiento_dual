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
            if (!/^[0-9\s]+$/.test(pastedData)) {
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

    const inicioDualInput = document.getElementById("inicio_dual");
    const finDualInput = document.getElementById("fin_dual");

    function crearFechaSinHora(dateString) {
        const [year, month, day] = dateString.split("-").map(Number);
        return new Date(year, month - 1, day);
    }

    if (inicioDualInput && finDualInput) {
        inicioDualInput.addEventListener("change", function () {
            const inicio = crearFechaSinHora(this.value);

            // Solo continuar si la fecha es válida
            if (!isNaN(inicio)) {
                // Calcular fecha de fin (+1 año)
                let fin = new Date(inicio);
                fin.setFullYear(fin.getFullYear() + 1);

                // Ajustar si la fecha era 29 de febrero
                if (inicio.getDate() === 29 && inicio.getMonth() === 1) {
                    if (fin.getMonth() !== 1) {
                        fin.setDate(28);
                        fin.setMonth(1);
                    }
                }

                // Formatear la fecha a YYYY-MM-DD
                const year = fin.getFullYear();
                const month = String(fin.getMonth() + 1).padStart(2, "0");
                const day = String(fin.getDate()).padStart(2, "0");
                finDualInput.value = `${year}-${month}-${day}`;
            }
        });
    }




    //Validation for date of entry
    const fechaIngresoInput = document.getElementById("inicio");
    const fechaEgresoInput = document.getElementById("fin");

    const fechaMinima = "2001-09-03";
    fechaIngresoInput.min = fechaMinima;


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



    //get born date
    const curpInput = document.getElementById("curp");
    const fechaInput = document.getElementById("fecha_na");

    curpInput.addEventListener("input", function () {
        const curp = curpInput.value.toUpperCase();

        if (curp.length >= 10) {
            const year = curp.substring(4, 6);
            const month = curp.substring(6, 8);
            const day = curp.substring(8, 10);

            // Si el año es mayor a la fecha actual, se asume 1900s, si no 2000s
            const currentYear = new Date().getFullYear() % 100;
            const fullYear = parseInt(year) > currentYear ? `19${year}` : `20${year}`;

            const fechaNacimiento = `${fullYear}-${month}-${day}`;
            // Validamos si es una fecha real
            const fechaValida = !isNaN(new Date(fechaNacimiento).getTime());

            if (fechaValida) {
                fechaInput.value = fechaNacimiento;
            }
        }
    });

});
