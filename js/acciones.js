document.getElementById('anterior').addEventListener('click', anterior)
document.getElementById('siguiente').addEventListener('click', siguiente)
document.getElementById('buscar').addEventListener('click', buscar)


async function anterior() {
    Estado = '';
    let anio = new Date(FechaGlobal).getFullYear();
    let mes = new Date(FechaGlobal).getMonth();
    if(mes===0){
        anio = anio - 1;
        mes = 12;
    }
    Inicio = `${anio}-${mes}-1`;
    Final = `${anio}-${mes}-${new Date(anio, mes, 0).getDate()}`;
    FechaGlobal = Inicio
    llenarTabla();
         

}



async function siguiente() {
    Estado = '';
    let anio = new Date(FechaGlobal).getFullYear();
    let mes = new Date(FechaGlobal).getMonth();
    mes++;
    if(mes===12){
        anio = anio +1;
        mes = 1;
    }
    mes++;
    Inicio = `${anio}-${mes}-1`;
    Final = `${anio}-${mes}-${new Date(anio, mes, 0).getDate()}`;
    FechaGlobal = Inicio
    llenarTabla();
}


async function buscar(){
    Estado='';
    Inicio=document.getElementById('desde').value
    Final=document.getElementById('hasta').value
    console.log(`Inicio: ${Inicio}  ${Final}`)
    if(Inicio!=''&& Final!=''){
        llenarTabla();
        return;
    }

   await Swal.fire({
        title: '¡Error!',
        text: 'Selecciona las fechas.',
        icon: 'error', // Puedes cambiar 'success' por 'warning', 'error', 'info', etc.
        confirmButtonText: 'Ok'
      });

      document.getElementById('desde').classList.add('error')
      document.getElementById('hasta').classList.add('error')
      setTimeout(()=>{
        document.getElementById('desde').classList.remove('error')
      document.getElementById('hasta').classList.remove('error')
      },3000)
      

}



//   row2.insertCell(0).innerHTML = `<input class="hiden inputshow" id="text-fecha" type="date" />`
// row2.insertCell(1).innerHTML = `<input type="text" class="hiden" value="Lectura:">`
// row2.insertCell(2).innerHTML = `<input class="hiden inputshow" id="text-lectura" type="number" />`
// row2.insertCell(3).innerHTML = `<input class="hiden inputshow" id="file" type="file" accept="image/png, image/jpeg" />`
