function toggleSidebar() {
    var sidebar = document.getElementById("mySidebar");
    if (sidebar.style.width === "250px") {
        sidebar.style.width = "0";
    } else {
        sidebar.style.width = "250px";
    }
}




// document.addEventListener('DOMContentLoaded', () => {
//     const menuBtn = document.querySelector('.menu-btn');
//     const navUl = document.querySelector('nav ul');

//     menuBtn.addEventListener('click', () => {
//         navUl.classList.toggle('show');
//     });

//     // Mostrar u ocultar el botón de menú según el ancho de la pantalla
//     window.addEventListener('resize', () => {
//         if (window.innerWidth <= 550) {
//             menuBtn.style.display = 'block';
//         } else {
//             menuBtn.style.display = 'none';
//             navUl.classList.remove('show');
//         }
//     });
// });

// document.addEventListener('DOMContentLoaded', () => {
//     const calendario = document.getElementById('calendario');
//     const tabla = document.getElementById('tabla');
//     const rbtcalendario = document.getElementById('rbt_calendario');
//     const rbttabla = document.getElementById('rbt_tabla');
    
//     if (rbtcalendario.checked) {
//         tabla.classList.add('hiden');
//         calendario.classList.remove('hiden');
        
//     } else if (rbttabla.checked) {
//         calendario.classList.add('hiden');
//         tabla.classList.remove('hiden');
        
//     }

//     rbtcalendario.addEventListener('change', actualizarClaseDiv);
//     rbttabla.addEventListener('change', actualizarClaseDiv);

//     function actualizarClaseDiv() {
//         if (rbtcalendario.checked) {
//             tabla.classList.add('hiden');
//             calendario.classList.remove('hiden');
//             console.log("calendario seleccionado")
//         } else if (rbttabla.checked) {
//             calendario.classList.add('hiden');
//             tabla.classList.remove('hiden');
//             console.log("tabla seleccionado")
//         }
//     }

// });

var Estado='actual'
var Inicio='';
var Final='';
var FechaGlobal;
var Codigo='8805'