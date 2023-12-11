
document.addEventListener('DOMContentLoaded', function () {
    
    // Mostrar la fecha actual
    // mostrarFechaActual();

    // Generar el contenido del calendario
    
});

// function mostrarFechaActual() {
//     const fechaActual = new Date();
//     const opcionesFecha = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
//     const fechaTexto = fechaActual.toLocaleDateString('es-ES', opcionesFecha);
//     document.getElementById('fecha-actual').innerText = fechaTexto;
// }

async function generarCalendario(mes, año) {
    const calendario = document.getElementById('calendario');
    const diasSemana = [ 'Domingo','Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];

    // Crear tabla
    const tabla = document.createElement('table');
    calendario.appendChild(tabla);

    // Agregar fila de días de la semana
    const filaDiasSemana = document.createElement('tr');
    diasSemana.forEach(dia => {
        const celda = document.createElement('th');
        celda.textContent = dia;
        filaDiasSemana.appendChild(celda);
    });
    tabla.appendChild(filaDiasSemana);

    // Obtener el primer día del mes
    const primerDia = new Date(año, mes - 1, 1);

    // Obtener la cantidad de días en el mes
    const ultimoDia = new Date(año, mes, 0).getDate();

    // Obtener el día de la semana del primer día del mes
    const primerDiaSemana = primerDia.getDay();

    // Crear filas para los números de los días
    let filaActual = document.createElement('tr');
    for (let i = 0; i < primerDiaSemana; i++) {
        // Celdas en blanco antes del primer día
        filaActual.appendChild(document.createElement('td'));
    }

    // Agregar números de los días
    for (let dia = 1; dia <= ultimoDia; dia++) {
        const celda = document.createElement('td');
        celda.textContent = dia;
        filaActual.appendChild(celda);

        if (filaActual.children.length === 7) {
            // Comenzar nueva fila después de 7 días
            tabla.appendChild(filaActual);
            filaActual = document.createElement('tr');
        }
    }

    // Completar la última fila con celdas en blanco si es necesario
    while (filaActual.children.length < 7) {
        filaActual.appendChild(document.createElement('td'));
    }

    // Agregar la última fila al final de la tabla
    tabla.appendChild(filaActual);

    // Obtener datos de la API
    // const respuesta = await fetch(`api/lecturas/search.php?estado=actual&mes=${mes}&año=${año}`);
    // const datos = await respuesta.json();

    // Colorear las fechas según los datos de la API
    // datos.forEach(lectura => {
    //     const fechaLectura = new Date(lectura.fecha);
    //     const diaLectura = fechaLectura.getDate();
    //     const celda = tabla.querySelector(`tr:nth-child(2) td:nth-child(${diaLectura + primerDiaSemana})`);

    //     if (celda) {
    //         celda.classList.add('lectura');
    //     }
    // });
}


// async function generarCalendario() {
//     const calendario = document.getElementById('calendario');
//     const diasSemana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];

//     // Crear tabla
//     const tabla = document.createElement('table');
//     calendario.appendChild(tabla);

//     // Agregar fila de días de la semana
//     const filaDiasSemana = document.createElement('tr');
//     diasSemana.forEach(dia => {
//         const celda = document.createElement('th');
//         celda.textContent = dia;
//         filaDiasSemana.appendChild(celda);
//     });
//     tabla.appendChild(filaDiasSemana);

//     // Obtener el primer día del mes actual
//     const primerDia = new Date();
//     primerDia.setDate(1);

//     // Obtener la cantidad de días en el mes actual
//     const ultimoDia = new Date(primerDia.getFullYear(), primerDia.getMonth() + 1, 0).getDate();

//     // Obtener el día de la semana del primer día del mes
//     const primerDiaSemana = primerDia.getDay();

//     // Crear filas para los números de los días
//     let filaActual = document.createElement('tr');
//     for (let i = 0; i < primerDiaSemana; i++) {
//         // Celdas en blanco antes del primer día
//         filaActual.appendChild(document.createElement('td'));
//     }

//     // Agregar números de los días
//     for (let dia = 1; dia <= ultimoDia; dia++) {
//         const celda = document.createElement('td');
//         celda.textContent = dia;
//         filaActual.appendChild(celda);

//         if (filaActual.children.length === 7) {
//             // Comenzar nueva fila después de 7 días
//             tabla.appendChild(filaActual);
//             filaActual = document.createElement('tr');
//         }
//     }

//     // Completar la última fila con celdas en blanco si es necesario
//     while (filaActual.children.length < 7) {
//         filaActual.appendChild(document.createElement('td'));
//     }

//     // Agregar la última fila al final de la tabla
//     tabla.appendChild(filaActual);

//     // Obtener datos de la API
//     const respuesta = await fetch('api/lecturas/search.php?estado=actual');
//     const datos = await respuesta.json();

//     // Colorear las fechas según los datos de la API
//     datos.forEach(lectura => {
//         const fechaLectura = new Date(lectura.fecha);
//         const diaLectura = fechaLectura.getDate();
//         const celda = tabla.querySelector(`tr:nth-child(2) td:nth-child(${diaLectura + primerDiaSemana})`);

//         if (celda) {
//             celda.classList.add('lectura');
//         }
//     });
// }

// async function generarCalendario() {
//     const calendario = document.getElementById('calendario');
//     const diasSemana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];

//     // Agregar días de la semana
//     const diasSemanaDiv = document.createElement('div');
//     diasSemana.forEach(dia => {
//         const span = document.createElement('span');
//         span.textContent = dia;
//         diasSemanaDiv.appendChild(span);
//     });
//     calendario.appendChild(diasSemanaDiv);

//     // Obtener el primer día del mes actual
//     const primerDia = new Date();
//     primerDia.setDate(1);

//     // Obtener la cantidad de días en el mes actual
//     const ultimoDia = new Date(primerDia.getFullYear(), primerDia.getMonth() + 1, 0).getDate();

//     // Agregar números de los días
//     for (let dia = 1; dia <= ultimoDia; dia++) {
//         const diaDiv = document.createElement('div');
//         diaDiv.textContent = dia;
//         calendario.appendChild(diaDiv);
//     }

//     // Obtener datos de la API
//     const respuesta = await fetch('api/lecturas/search.php?estado=actual');
//     const datos = await respuesta.json();

//     // Colorear las fechas según los datos de la API
//     datos.forEach(lectura => {
//         const fechaLectura = new Date(lectura.fecha);
//         const diaLectura = fechaLectura.getDate();
//         const diaDiv = calendario.querySelector(`:nth-child(${diasSemana.length + diaLectura})`);

//         if (diaDiv) {
//             diaDiv.classList.add('lectura');
//         }
//     });
// }
