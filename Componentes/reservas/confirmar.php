<?php
include_once("../../conexion.php");
$conexion = new conexion();

$p = ($_GET['p']);
$q = ($_GET['q']);
$c = ($_GET['c']);
$cc = ($_GET['cc']);
$qk = ($_GET['qk']);

   
    $m=''; //for error messages
    $id_event=''; //id event created 
    $link_event = ""; 
        
        date_default_timezone_set('America/Guayaquil');
        include_once '../google-calendar/google-api-php-client-2.2.4/vendor/autoload.php';
    
        //configurar variable de entorno / set enviroment variable
        putenv('GOOGLE_APPLICATION_CREDENTIALS=credenciales.json');
    
        $client = new Google_Client();
        $client->useApplicationDefaultCredentials();
        $client->setScopes(['https://www.googleapis.com/auth/calendar']);
    
        //define id calendario
        $id_calendar='tofm1jc0o9r87ii1vo55lsikf0@group.calendar.google.com';//

        $time_start = str_replace(" ", "T", $p, $contador);
        $time_end = str_replace(" ", "T", $q, $contador);

        $time_start  = substr($time_start,0,19);
        $time_end  = substr( $time_end,0,19);
        
        $time_start = $time_start."-05:00";
        $time_end  =  $time_end ."-05:00";



        $canchasTotalConsulta = " select nombre from cancha WHERE id = '".$c."'";
        $canchasTotalResultadoConsulta = $conexion->consulta($canchasTotalConsulta);
        $fila = mysqli_fetch_row($canchasTotalResultadoConsulta["resultado"]);
        $canchasTotal =  $fila[0];


        $clienteConsulta = " select nombre from cliente WHERE id = (SELECT MAX(id) FROM cliente)";
        $clienteConsultaResultado = $conexion->consulta($clienteConsulta);
        $fila = mysqli_fetch_row($clienteConsultaResultado["resultado"]);
        $clienteTotal =  $fila[0];

        $clienteConsultacelular = " select celular from cliente WHERE id = (SELECT MAX(id) FROM cliente)";
        $clienteConsultaResultadocelular = $conexion->consulta($clienteConsultacelular);
        $fila = mysqli_fetch_row($clienteConsultaResultadocelular["resultado"]);
        $clienteTotalcelular =  $fila[0];

        $clienteConsultaid = " select (id+1) from reserva WHERE id = (SELECT MAX(id) FROM reserva)";
        $clienteConsultaResultadoid = $conexion->consulta($clienteConsultaid);
        $fila = mysqli_fetch_row($clienteConsultaResultadoid["resultado"]);
        $clienteTotalid =  $fila[0];

        

        
     
       
        try{        
            //instanciamos el servicio
             $calendarService = new Google_Service_Calendar($client);
          
                $event = new Google_Service_Calendar_Event();
                $event->setSummary("👤 ".$clienteTotal);
                $event->setDescription("🥏 ".$canchasTotal.
            "
 📱 ". $clienteTotalcelular."
📌 Reserva #". $clienteTotalid."

".$qk."
");
    
                //fecha inicio
                $start = new Google_Service_Calendar_EventDateTime();
                $start->setDateTime($time_start);
                $event->setStart($start);
                $event->setColorId($cc);
    
                //fecha fin
                $end = new Google_Service_Calendar_EventDateTime();
                $end->setDateTime($time_end);
                $event->setEnd($end);
    
                $createdEvent = $calendarService->events->insert($id_calendar, $event);
                // $calendarService->events->delete($id_calendar, 'rvi0ek7jhuu5d70fo4noo4njm0');
                $id_event= $createdEvent->getId();
                $link_event= $createdEvent->gethtmlLink();
                
        }catch(Google_Service_Exception $gs){
          $m = json_decode($gs->getMessage());
          $m= $m->error->message;
    
        }catch(Exception $e){
            $m = $e->getMessage();
        }

        $canchasTotalConsulta = "INSERT INTO `reserva` (`comentarios`, `id`, `fecha_inicio`, `fecha_fin`, `id_cliente`, `id_cancha`, `fecha_creacion`, `link`, `id_calendar`  ) VALUES ('".$qk."',NULL, '".$p."', '".$q."', (SELECT MAX(id) FROM cliente),'".$c."',NOW(), '".$link_event."', '".$id_event."');";

        $canchasTotalResultadoConsulta = $conexion->consulta($canchasTotalConsulta);
    

        //  echo $canchasTotalConsulta." errores: ".$m;
$id = substr($link_event,42);
// echo $id;
echo ('https://calendar.google.com/calendar/u/0/r/eventedit/duplicate/'.$id);

?>