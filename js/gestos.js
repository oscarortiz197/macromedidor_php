var btnactual = document.getElementById("btnactual");
btnactual.addEventListener("click", ()=>{lista("./vista/buscar.php?estado=actual")});

var btnanterior = document.getElementById("btnanterior");
btnanterior.addEventListener("click", ()=>{ lista("./vista/buscar.php?estado=anterior")});

var btnanterior = document.getElementById("btnlista");
btnanterior.addEventListener("click", ()=>{ lista("./vista/index.php")});

document.querySelectorAll('tr').forEach(img => {
    img.addEventListener('click', () => {
      
   alert("gola")
    })
  })


