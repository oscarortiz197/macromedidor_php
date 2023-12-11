
document.addEventListener('DOMContentLoaded', async function () {
    await llenarTabla();
});


async function borrar(id) {

    let respuesta = await Swal.fire({
        title: '¡Atención!',
        text: 'Desea Eliminar el registro',
        icon: 'question', // Puedes cambiar 'success' por 'warning', 'error', 'info', etc.
        confirmButtonText: 'Borrar',
        cancelButtonText: 'cancelar',
        showCancelButton: true,
    });

    console.log(respuesta)
    if (respuesta.isConfirmed) {
        let response = await fetch('./api/lecturas/delete.php', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                id: id
            }),

        })

        if (response.status == 200) {

        }
        llenarTabla();
    }

}






async function llenarTabla() {
    let data = await actual(Estado, Inicio, Final);
    let tbody = document.querySelector('tbody');
    tbody.innerHTML = ''
    document.getElementById('total').innerHTML = "";
    document.getElementById('promedio').innerHTML = "";

    if (data == 0) {
        document.getElementById('promedio').innerHTML = "No se encuentran registros ";

        return;
    } else if (data == 1) {
        document.getElementById('promedio').innerHTML = "Error";

        return;
    } else {

        for (var i = 0; i < data.length - 1; i++) {
            let row = tbody.insertRow();
            row.insertCell(0).innerHTML = `<input id='txt-fecha-${data[i].ID}'  type="date" valor=${data[i].Fecha} value="${data[i].Fecha}" readonly>`;
            row.insertCell(1).innerHTML = `<input id='txt-inicio-${data[i].ID}'type="text" valor=${data[i].Inicio} value="${data[i].Inicio}" readonly>`;
            row.insertCell(2).innerHTML = `<input id='txt-final-${data[i].ID}'type="number" valor=${data[i].Final} value="${data[i].Final}" readonly>`;
            row.insertCell(3).innerHTML = `<input id='txt-consumo-${data[i].ID}'type="text" valor=${data[i].Consumo} value="${data[i].Consumo}" readonly>`;
            // Agregar celda de acciones con botones
            let accionesCell = row.insertCell(4);
            accionesCell.appendChild(createButton(data[i].ID, 'btn-editar', '', '&#9998;'));
            accionesCell.appendChild(createButton(data[i].ID, 'btn-borrar', '', '&#128465;'));
            accionesCell.appendChild(createButton(data[i].ID, 'btn-guardar', 'hiden', '🖫'));
            accionesCell.appendChild(createButton(data[i].ID, 'btn-cancelar', 'hiden', '&#10006;'));


            document.getElementById(`btn-borrar-${data[i].ID}`).addEventListener('click', async function (event) {
                await borrar(event.target.getAttribute('data-id'));
            })

            document.getElementById(`btn-editar-${data[i].ID}`).addEventListener('click', async function (event) {
                await editar(event.target.getAttribute('data-id'));

            })
            document.getElementById(`btn-cancelar-${data[i].ID}`).addEventListener('click', async function (event) {
                await cancelar(event.target.getAttribute('data-id'));

            })
            document.getElementById(`btn-guardar-${data[i].ID}`).addEventListener('click', async function (event) {
                await guardar(event.target.getAttribute('data-id'));

            })

        }

        let row2 = tbody.insertRow();
        row2.insertCell(0).innerHTML = `<input class="hiden inputshow" id="text-fecha" type="date" />`
        row2.insertCell(1).innerHTML = `<input type="text" class="hiden" id="texto" value="Lectura:">`
        row2.insertCell(2).innerHTML = `<input class="hiden inputshow" id="text-lectura" type="number" />`
        row2.insertCell(3).innerHTML = `<input class="hiden inputshow" id="img-file" type="file" accept="image/png, image/jpeg" />`
        row2.insertCell(4).innerHTML = `<button id="btn-agregar" class="insert">+</button> <button class='hiden btn-guardar' id="btn-save" class="insert">🖫</button> <button id="btn-cancelar" class="btn-cancelar hiden">&#10006;</button>`
        row2.classList.add('add');
        row2.id = "tr-agregar"
        document.getElementById("btn-agregar").addEventListener('click', agregar)

        FechaGlobal = data[data.length - 2].Fecha;
        document.getElementById('total').innerHTML = "Total " + data[data.length - 1].Total + ' m³';
        document.getElementById('promedio').innerHTML = "Promedio " + data[data.length - 1].Promedio + ' m³';
    }
}


function createButton(id, clase, clase2, nombre) {
    let btn = document.createElement('button')
    btn.className += clase + ' ' + clase2;
    btn.setAttribute('data-id', id)
    btn.id = `${clase}-${id}`;
    btn.innerHTML = nombre

    return btn;
}

// Función para obtener datos de la API de manera asíncrona
async function actual() {
    const parametros = {
        estado: Estado,
        inicio: Inicio,
        final: Final
    };
    // console.log(parametros )
    const queryString = new URLSearchParams(parametros).toString();
    const respuesta = await fetch(`./api/lecturas/search.php?${queryString}`);
    // console.log(respuesta)
    if (respuesta.status == 200) {
        const datos = await respuesta.json();
        return datos;
    } else if (respuesta.status == 201) {

        return 0;
    } else {
        return 1;
    }
}

async function cancelar(id) {
    document.getElementById(`btn-borrar-${id}`).classList.remove('hiden');
    document.getElementById(`btn-editar-${id}`).classList.remove('hiden');
    document.getElementById(`btn-cancelar-${id}`).classList.add('hiden');
    document.getElementById(`btn-guardar-${id}`).classList.add('hiden');

    document.getElementById(`txt-fecha-${id}`).value = document.getElementById(`txt-fecha-${id}`).getAttribute('valor');
    document.getElementById(`txt-final-${id}`).value = document.getElementById(`txt-final-${id}`).getAttribute('valor');

    document.getElementById(`txt-final-${id}`).setAttribute('readonly', 'readonly');
    document.getElementById(`txt-fecha-${id}`).setAttribute('readonly', 'readonly');

    document.getElementById(`txt-final-${id}`).classList.add('inputhiden');
    document.getElementById(`txt-fecha-${id}`).classList.add('inputhiden');

    document.getElementById(`txt-fecha-${id}`).classList.remove('inputshow');
    document.getElementById(`txt-final-${id}`).classList.remove('inputshow');

}

// metodo para guardar  valida datos y ademas vuelve a llenar la tabla 
async function guardar(id) {
    const lectura = document.getElementById(`txt-final-${id}`).value;
    const fecha = document.getElementById(`txt-fecha-${id}`).value;

    if (!fecha.trim() || isNaN(new Date(fecha)) || !/^[0-9]+$/.test(lectura) || !lectura.trim()) {
        cancelar(id);
        await Swal.fire({
            title: '¡Error!',
            text: 'Datos ingresados no validos',
            icon: 'error', // Puedes cambiar 'success' por 'warning', 'error', 'info', etc.
            confirmButtonText: 'Ok'
        });

        document.getElementById(`txt-final-${id}`).classList.add('error')
        document.getElementById(`txt-fecha-${id}`).classList.add('error')
        setTimeout(() => {
            document.getElementById(`txt-final-${id}`).classList.remove('error')
            document.getElementById(`txt-fecha-${id}`).classList.remove('error')
        }, 3000)

        return

    }

    datos = new URLSearchParams();
    datos.append('id', id);
    datos.append('fecha', fecha);
    datos.append('codigoEmpleado', '8805');
    datos.append('lectura', lectura);
    datos.append('img', 'img');
    console.log(datos)
    if (await httpPost('./api/lecturas/update.php', datos)) {
        // 
    }
    cancelar(id);
    llenarTabla();

}
// metodo para las peticiones http post para update y guardar 
async function httpPost(uri, datos) {
    let response = await fetch(uri, {
        method: 'POST',

        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: datos
    })

    if (response.status == 200) {
        return true;
    }
    return false;
}




// El boton de aditar dentro de la tabla solamente habilita los campos a editar a y los botones de guardar y eliminar
async function editar(id) {
    document.getElementById(`btn-borrar-${id}`).classList.add('hiden');
    document.getElementById(`btn-editar-${id}`).classList.add('hiden');
    document.getElementById(`btn-cancelar-${id}`).classList.remove('hiden');
    document.getElementById(`btn-guardar-${id}`).classList.remove('hiden');

    document.getElementById(`txt-final-${id}`).removeAttribute('readonly');
    document.getElementById(`txt-fecha-${id}`).removeAttribute('readonly');

    document.getElementById(`txt-fecha-${id}`).classList.add('inputshow');
    document.getElementById(`txt-final-${id}`).classList.add('inputshow');
}




async function agregar() {

    let fecha = document.getElementById("text-fecha");
    let texto = document.getElementById("texto");
    let lectura = document.getElementById("text-lectura");
    let img = document.getElementById("img-file");
    let agregar = document.getElementById("btn-agregar");
    let save = document.getElementById("btn-save");
    let cancelar = document.getElementById("btn-cancelar");

    fecha.classList.remove('hiden')
    texto.classList.remove('hiden')
    lectura.classList.remove('hiden')
    img.classList.remove('hiden')
    save.classList.remove('hiden')
    cancelar.classList.remove('hiden')
    agregar.classList.add('hiden')

    

    document.getElementById('btn-save').addEventListener('click',async function(){
        if(!fecha.value.trim() || isNaN(new Date(fecha.value)) || !/^[0-9]+$/.test(lectura.value) || !lectura.value.trim() ) {
          
            await Swal.fire({
                title: '¡Atención!',
                text: 'Ingrese todos los datos',
                icon: 'error', // Puedes cambiar 'success' por 'warning', 'error', 'info', etc.
                confirmButtonText: 'OK',
                
            });
            return
        }
        const formData = new FormData();
    formData.append("fecha", fecha.value);
    formData.append("codigo", Codigo);
    formData.append("lectura", lectura.value);
    formData.append("img", img.files[0]);

    const response = await fetch('./api/lecturas/insert.php', {
        method: 'POST',
        body: formData
    });
    if(response.status==200){
    fecha.classList.add('hiden')
    texto.classList.add('hiden')
    lectura.classList.add('hiden')
    img.classList.add('hiden')
    save.classList.add('hiden')
    cancelar.classList.add('hiden')
    agregar.classList.remove('hiden')
    await llenarTabla();
    return
    }
    llenarTabla();


    })
    document.getElementById('btn-cancelar').addEventListener('click',async function(){
    fecha.classList.add('hiden')
    texto.classList.add('hiden')
    lectura.classList.add('hiden')
    img.classList.add('hiden')
    save.classList.add('hiden')
    cancelar.classList.add('hiden')
    agregar.classList.remove('hiden')
    })

}


