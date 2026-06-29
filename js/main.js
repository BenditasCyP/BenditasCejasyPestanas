document.addEventListener("DOMContentLoaded", function () {

    const fecha = document.querySelector('input[name="fecha"]');

    fecha.addEventListener("change", function () {

        const seleccion = new Date(this.value);

        if (seleccion.getDay() === 0) {

            alert("No atendemos los domingos. Por favor selecciona otro día.");

            this.value = "";

        }

    });

});