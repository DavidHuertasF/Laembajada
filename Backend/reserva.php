

<?php
include_once("conexion.php");
$conexion = new conexion();


date_default_timezone_set('America/Caracas');
$fecha_actual = date("Y-m-d H:i:s");

// Trae las reservas para mostrarlas en la tabla
$mostrar = "select  * from reserva";
$resultado_mostrar = $conexion->consulta($mostrar);
$dato = array();
$reservas = array();

while ($fila = mysqli_fetch_row($resultado_mostrar["resultado"])) {
  $dato["id"] = $fila[0];
  $dato["fecha_inicio"] = $fila[1];
  $dato["fecha_fin"] = $fila[2];
  $dato["id_cliente"] = $fila[3];
  $dato["id_cancha"] = $fila[4];
  $dato["fecha_creacion"] = $fila[5];
  array_push($reservas, $dato);
}


// Trae los clientes para mostrarlos en el registro de reservas
$mostrar_clientes = "select * from cliente";
$resultado_mostrar = $conexion->consulta($mostrar_clientes);
$dato = array();
$clientes = array();
while ($fila = mysqli_fetch_row($resultado_mostrar["resultado"])) {
  $dato["id"] = $fila[0];
  $dato["nombre"] = $fila[1];
  array_push($clientes, $dato);
}

// Trae los clientes para mostrarlos en el registro de reservas
$mostrar_cancha = "select * from cancha";
$resultado_mostrar = $conexion->consulta($mostrar_cancha);
$dato = array();
$canchas = array();
while ($fila = mysqli_fetch_row($resultado_mostrar["resultado"])) {
  $dato["id"] = $fila[0];
  $dato["nombre"] = $fila[1];
  array_push($canchas, $dato);
}

// Si se registra un ticket
if (isset($_POST["enviar"])) {
  $consulta = "INSERT INTO `reserva` 
  
		VALUES (NULL,
			'" . $_POST["horainicio"] . "', 
			'" . $_POST["horafin"] . "',
			'" . $_POST["id_cliente"] . "', 
			'" . $_POST["id_cancha"] . "',
			NOW())";
  $resultado = $conexion->consulta($consulta);
  echo "<meta http-equiv='refresh' content='0'>";
}



// Sistema de reservas 
  //Total de canchas existentes
   $canchasTotalConsulta = " select count(*) from cancha";
   $canchasTotalResultadoConsulta = $conexion->consulta($canchasTotalConsulta);
   $fila = mysqli_fetch_row($canchasTotalResultadoConsulta["resultado"]);
   $canchasTotal =  $fila[0];
   echo'<script type="text/javascript">
    var canchasTotal = parseInt('.$canchasTotal.');
   </script>';
?>

<!DOCTYPE html>
<html>

<head>
  <title>Tickets</title>
  <link href="recursos/css/bootstrap-datetimepicker.css" rel="stylesheet" media="screen" />






</head>

<body>
  <div id="txtHint"><b>Person info will be listed here...</b></div>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">Sistema de reservas</a>
      </div>
      <ul class="nav navbar-nav">
        <li><a href="index.php">Clientes</a></li>
        <li class="active"><a href="tickets.php">Reservas</a></li>
        <li><a href="cobros.php">Canchas</a></li>
      </ul>
    </div>
  </nav>


  <div class="row">

  <h3> <?= $canchasTotal ?>  canchas </h3> 
        
    <div class="col-sm-4" style="background-color:lavender;">
      <form class="formt" action="reserva.php" method="POST">
        <h3>Registro de reserva</h3>
        <br />

        <div class="input-group date form_date col-md-5" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">

      
        <p>Fecha de reserva</p>  

          <input class="form-control" size="16" type="text" value="" readonly />
          <span class="input-group-addon" style="
                    padding: 0px;
                    font-size: 0px;
                    font-weight: normal;
                    line-height: 0;
                    text-align: center;
                    background-color: white;
                    border: 0px solid #cccccc;
                    border-radius: 4px;
                    cursor: pointer;
                    width: 0px;
                "><span class="glyphicon glyphicon-calendar"></span></span>
        </div>
        <input type="hidden" id="dtp_input2" value="" /><br />

       
    </div>

    <div  style="display:none" id="time_div" class="input-group date form_time col-md-5" data-date="" data-date-format="hh" data-link-field="dtp_input3" data-link-format="hh">

    <div>
          <p>Número canchas</p>
          <select class="form-control" id="selectCanchas">
            <?php
           for  ($i = 1; $i < $canchasTotal +1; $i++) { ?>
              <option value="<?php echo $i?>"><?php echo $i?></option>
            <?php } ?>
          </select>
      </div> 
      
    <p>Hora de reserva</p>  
    <input class="form-control" size="16" type="text" value="" readonly />
      <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>

      <input type="hidden" id="dtp_input3" value="" /><br />
    </div>

   <input  style="display: none" type="datetime" class="form-control" name="horafin" value="<?= $fecha_actual ?>"> <br />
   
      <div style="display: none" id="div_cancha">
          <p>Cancha</p>
          <select class="form-control" name="id_cancha">
            <?php
            for ($i = 0; $i < count($canchas); $i++) { ?>
              <option value="<?php echo $canchas[$i]["id"]; ?>"><?php echo $canchas[$i]["nombre"]; ?></option>
            <?php } ?>
          </select>
      </div> 

     

    <br />
    Cliente
    <select class="form-control" name="id_cliente">
      <?php
      for ($i = 0; $i < count($clientes); $i++) { ?>
        <option value="<?php echo $clientes[$i]["id"]; ?>"><?php echo $clientes[$i]["nombre"]; ?></option>
      <?php } ?>
    </select>
    <input class="btn btn-info" type="submit" name="enviar" value="Enviar">

    </form>
    <br />
  </div>




  <div class="panel-body">
    <table class="table table-bordered">
      <thead align="center">
        <tr>
          <th>id</th>
          <th>Hora inicial</th>
          <th>Hora final</th>
          <th>Cliente</th>
          <th>Cancha</th>
          <th>Fecha creación</th>
        </tr>

      </thead>

      <tbody align="center">
        <?php for  ($i = 0; $i < count($reservas); $i++) { ?>
          <tr>
            <td><?php echo $reservas[$i]["id"]; ?></td>
            <td><?php echo $reservas[$i]["fecha_inicio"]; ?></td>
            <td><?php echo $reservas[$i]["fecha_fin"]; ?></td>
            <td><?php echo $reservas[$i]["id_cliente"]; ?></td>
            <td><?php echo $reservas[$i]["id_cancha"]; ?></td>
            <td><?php echo $reservas[$i]["fecha_creacion"]; ?></td>
          </tr>
        <?php } ?>

      </tbody>

    </table>

    <input type="text" id="myInput" value="ok">

    <button onclick="xx()" ></button>
    <script>
      function xx(){
        alert($("#myInput").val());
      }
    </script>

  </div>
</body>

<script type="text/javascript" src="recursos/jquery-1.8.3.min.js" charset="UTF-8"></script>

<script type="text/javascript" src="recursos/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="recursos/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>
<script type="text/javascript">
 
  var e = new Date();
  e.setMonth(e.getMonth() + 4);

  var f = new Date();
  f.setHours(f.getHours() - 4);

  $(".form_date").datetimepicker({
    language: "es",
    weekStart: 2,
    autoclose: 1,
    daysOfWeekDisabled: [0, 1],
    endDate: e,
    startView: 2,
    startDate: new Date(),
    minView: 2
  });

  var hours = [
    0,
    1,
    2,
    3,
    4,
    5,
    6,
    7,
    8,
    9,
    10,
    11,
    12,
    13,
    14,
    15,
    23,
    24
  ];
  $(".form_time").datetimepicker({
    format: "HH:00 P",
    language: "en",
    showMeridian: 1,
    weekStart: 1,
    autoclose: 1,
    useCurrent: false,
    startView: 1,
    minView: 1,
    maxView: 1,
    forceParse: 0,
    hoursDisabled: hours,
    initialDate: null
  });

  $(".form_date").on("click", function(e) {
    if (
      $(".form_date")
      .find("input")
      .val() == ""
    ) {
      $(".active").removeClass("active");
    }
  });

  $(".form_time").on("click", function(e) {
    if (
      $(".form_time")
      .find("input")
      .val() == ""
    ) {
      $(".active").removeClass("active");
    }

    getHoursAvailables();

  });

  $(".form_date").on("changeDate", function(e) {
    reservationDate = new Date($("#dtp_input2").val());
    reservationDate.addDays(1);
   
    var x = new Date();
    var today = getDayOfYear(new Date());
    var hourToday = x.getHours() + 1;
    var dayReservation = getDayOfYear(reservationDate) + 1;

    reservationIsCurrentDay = today == dayReservation;
    var hours = [
      0,
      1,
      2,
      3,
      4,
      5,
      6,
      7,
      8,
      9,
      10,
      11,
      12,
      13,
      14,
      15,
      23,
      24
    ];

    if (reservationIsCurrentDay) {
      for (i = 0; i < hourToday; i++) {
        var exist = hours.find(element => element == i);
        if (exist === undefined) {
          hours.push(i);
        }
      }
      $(".form_time").datetimepicker("setHoursDisabled", hours);
      $(".form_time").datetimepicker("reset");
    } else {
      $(".form_time").datetimepicker("setHoursDisabled", hours);
      $(".form_time").datetimepicker("reset");
    }
    document.getElementById("div_cancha").style.display = "none";
    document.getElementById("time_div").style.display = "block";
  });

  $(".form_time").on("changeDate", function(e) {
    var hourSelected = $("#dtp_input3").val();
      if(hourSelected != ''){
        document.getElementById("div_cancha").style.display = "block";
        reservationDate.setHours(hourSelected);  
        d = reservationDate.addDays(1);
        $('#dtp_input2').val(d.getFullYear()+"-"+zeroPadded(d.getMonth() + 1)+"-"+zeroPadded(d.getDate())+" "+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds());
        reservationDate = new Date($("#dtp_input2").val());
         alert ("Fecha seleccionada:  --> " + reservationDate);
      }
  });

  Date.prototype.addDays = function(days) {
    var date = new Date(this.valueOf());
    date.setDate(date.getDate() + days);
    return date;
}



  function zeroPadded(val) {
  if (val >= 10)
    return val;
  else
    return '0' + val;
}



  function getDayOfYear(now) {
    var start = new Date(now.getFullYear(), 0, 0);
    var diff = now - start;
    var oneDay = 1000 * 60 * 60 * 24;
    var day = Math.floor(diff / oneDay);
    return day;
  }

  $('#dtp_input2').attr('name', 'horainicio');

  function getHoursAvailables(){
    var canchas = $( "#selectCanchas option:selected" ).text();
    var hoursavailables =[];

    for (var i = 0; i < 24; i++) {
      if(!hours.includes(i)){
        hoursavailables.push(i);
      }
  }
    
    
  hoursavailables.forEach( 
  function(valor, indice, array) {
   
        
          var dateExtra = reservationDate;
          dateExtra.setHours(valor); 
          d = dateExtra.addDays(1);
          varstringDate = (d.getFullYear()+"-"+zeroPadded(d.getMonth() + 1)+"-"+zeroPadded(d.getDate())+" "+d.getHours()+":"+dateExtra.getMinutes()+":"+d.getSeconds());

           var consulta = "";
           var xx = [];
           showUser(varstringDate);
           alert("Canchas reservadas para el " + varstringDate + " --> " + $("#myInput").val());
          //  xx.push(showUser(varstringDate));
          //  alert(xx);
        });

        

   

  
  }

  function showUser(day) {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
                // alert($(this).siblings("h2").text());
                $('#myInput').val(this.responseText);
            }
        };
        xmlhttp.open("GET","getuser.php?q="+day,false);
        xmlhttp.send();
  }


</script>

</html>