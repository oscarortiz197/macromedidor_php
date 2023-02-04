
async function lista(url) {
    const response = await fetch(url, { method: 'GET' });
    const data = await response.json();
    var total = 0;
    let body = "";
    if (data[0]['Fecha'] != 0) {
        var mes = data[0]['Fecha'];
        mes=mes[5]+mes[6]
       
        document.getElementById('mes').innerHTML=obtenerNombreMes(mes)
        var img="";
        var clas="";
        icono="";
        data.forEach(element => {
            if (element['Img']!=null){
                img=element['Img'];
                var clas="disponible";
                icono="./recursos/si.png";
            }else{
                img="nodisponible.png";
                var clas="nodisponible";
                icono="./recursos/no.png";
            }
            body +=  `
           
            <tr > 
            <td class="${clas}"> ${element['Fecha']}</td> 
            <td> ${element['Inicio']}</td> 
            <td> ${element['Final']}</td>
            <td><a href="./vista/img/${img}"TARGET=”_blank”> ${element['Consumo']}  <img class="icono" src="${icono}">
            </a>
            </td>
            
            </tr>
            
            `
            total += element['Consumo'];
        });
        document.getElementById('bodytable').innerHTML = body;
        document.getElementById('Consumo').innerHTML = "Consumo: " + total;
        
    }
}

function obtenerNombreMes (numero) {
    let miFecha = new Date();
    if (0 < numero && numero <= 12) {
      miFecha.setMonth(numero - 1);
      return new Intl.DateTimeFormat('es-ES', { month: 'long'}).format(miFecha);
    } else {
if(numero==0){
return "Diciembre";
}else{
      return null;
    }
}
  }


  function mes_btn(){
    const fecha = new Date();
    let mesActual = fecha.getMonth() + 1
    
    document.getElementById('btnactual').innerHTML=obtenerNombreMes(mesActual);
    document.getElementById('btnanterior').innerHTML=obtenerNombreMes(mesActual-1);

  }

