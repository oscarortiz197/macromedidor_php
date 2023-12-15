
async function obtenerEstadistica() {
    const inicio =document.getElementById('desde').value;
    const final = document.getElementById('hasta').value;
    
    if (isNaN(new Date(inicio)) || isNaN(new Date(inicio))) return console.log('error');

    let datos = await data(inicio, final) ?? 0;

    // Destruir el gráfico existente si hay uno
    if (window.myChart) {
        window.myChart.destroy();
    }

    // Limpiar el contenido del lienzo
    const canvas = document.getElementById('miGrafica');
    const ctx = canvas.getContext('2d');
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    if (datos != 0) {
        mostrarGrafica(datos);
    }
}

async function data(inicio, final) {
    const parametros = {
        inicio: inicio,
        final: final
    };

    const queryString = new URLSearchParams(parametros).toString();
    const respuesta = await fetch(`./api/estadisticas/estadistica.php?${queryString}`);
    // console.log(respuesta.json);
    if (respuesta.status == 200) {
        const datos = await respuesta.json();

        return datos;
    } else if (respuesta.status == 201) {

        return 0;
    } else {
        return 1;
    }

}


function mostrarGrafica(datos) {
    let labels = []; // Nombres de los meses
    let data = []; // Datos de consumo para cada mes
    let countData = []; // Datos de COUNT para cada mes

    for (const year in datos) {
        const months = datos[year];

        for (const month in months) {
            const stats = months[month];
            
            labels.push(`${month} ${year}`);
            data.push(stats.TOTAL);
            countData.push(stats.COUNT); // Agregar datos de COUNT
        }
    }

    // Configurar el contexto del gráfico
    const ctx = document.getElementById('miGrafica').getContext('2d');

    // Configurar el conjunto de datos
    const dataset = {
        labels: labels,
        datasets: [{
            label: 'Consumo',
            backgroundColor: '#9AD0C2', // Color de fondo de las barras
            borderColor: '#2D9596', // Color del borde de las barras
            borderWidth: 1, // Ancho del borde de las barras
            data: data,
            countData: countData, // Datos de COUNT
        }],
    };

    // Configurar las opciones del gráfico
    const options = {
        scales: {
            y: {
                beginAtZero: true,
            },
        },
        plugins: {
            tooltip: {
                callbacks: {
                    label: (context) => {
                        const label = context.dataset.label || '';
                        const value = context.parsed.y || 0;
                        const countValue = context.dataset.countData[context.dataIndex] || 0;
                        return `${label}: ${value} - Días suministrados: ${countValue}`;
                    },
                },
            },
        },
    };

    // Crear el gráfico de barras
    window.myChart = new Chart(ctx, {
        type: 'bar',
        data: dataset,
        options: options,
    });

    
}

function printChart(chart) {
    
    const canvas = chart.canvas;
    
    window.print(canvas);
}
