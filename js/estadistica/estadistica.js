

async function obtenerEstadistica() {
    var fechaInicialString = document.getElementById('desde').value;

    // Cortar los últimos dos dígitos
    fechaInicialString = fechaInicialString.slice(0, -2);

    // Añadir '01' al final para obtener el primer día del mes
    fechaInicialString += '01';

    var fechaInicial = new Date(fechaInicialString);

    // Fecha final: 2023-07-24
    var fechaFinalString = document.getElementById('hasta').value;

    // Cortar los últimos dos dígitos
    fechaFinalString = fechaFinalString.slice(0, -2);

    // Añadir '01' al final para obtener el último día del mes
    fechaFinalString += '01';

    var fechaFinal = new Date(fechaFinalString);

    // Establecer el día al último día del mes
    fechaFinal.setMonth(fechaFinal.getMonth() + 1);
    fechaFinal.setDate(0);

    // Obtener la fecha en formato deseado (YYYY-MM-DD)
    var resultadoInicial = fechaInicial.toISOString().split('T')[0];
    var resultadoFinal = fechaFinal.toISOString().split('T')[0];

    const parametros = {
        inicio: resultadoInicial,
        final: resultadoFinal
    };
     console.log(parametros )
    const queryString = new URLSearchParams(parametros).toString();
    const respuesta = await fetch(`./api/estadisticas/estadistica.php?${queryString}`);
     console.log(respuesta)
    if (respuesta.status == 200) {
        const datos = await respuesta.json();
        return datos;
    } else if (respuesta.status == 201) {

        return 0;
    } else {
        return 1;
    }
 
}