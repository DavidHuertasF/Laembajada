$(document).ready( function () {
    $('#customers').DataTable();
} );

// Get the modal
var modal = document.getElementById("myModal");


// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

function modalCliente(id, nombre, celular, correo) {
  modal.style.display = "block";
  $('#id_cliente').text(id);
  $('#nombre_cliente').text(nombre);
  $('#celular_cliente').text(celular);
  $('#correo_cliente').text(correo);
}

// When the user clicks on <span> (x), close the modal
try {
  span.onclick = function() {
    modal.style.display = "none";
  }
} catch (error) {
  
}


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

function cambio(id) {

 var es = $('#'+id+'_es').val();
 var en = $('#'+id+'_en').val();

 es= encodeURIComponent(es);
 en= encodeURIComponent(en); 

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp = new XMLHttpRequest();
  } else {
    // code for IE6, IE5
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }


  
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     alert("Contenido actualizado");
    }
  };

  xmlhttp.open("GET", "cambioContenido.php?p=" + id+ "&q=" + es+ "&r=" + en, false);
  xmlhttp.send();
}

function actualizarCancha(id) {

  var nuevoNombre = $('#'+id+'_nombre-cancha').val();
 
  nuevoNombre= encodeURIComponent(nuevoNombre);
 
   if (window.XMLHttpRequest) {
     // code for IE7+, Firefox, Chrome, Opera, Safari
     xmlhttp = new XMLHttpRequest();
   } else {
     // code for IE6, IE5
     xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
   }
 
 
   
   xmlhttp.onreadystatechange = function() {
     if (this.readyState == 4 && this.status == 200) {
      alert("Cancha actualizada");
     }
   };
 
   xmlhttp.open("GET", "actualizarNombreCancha.php?p=" + id+ "&q=" + nuevoNombre, false);
   xmlhttp.send();
 }


