<?php
include_once("../../conexion.php");
$conexion = new conexion();

$p = ($_GET['p']);
$q = ($_GET['q']);
$c = ($_GET['c']);
$cc = ($_GET['cc']);

    $canchasTotalConsulta = "INSERT INTO `reserva` (`id`, `fecha_inicio`, `fecha_fin`, `id_cliente`, `id_cancha`, `fecha_creacion`) VALUES (NULL, '".$p."', '".$q."', (SELECT MAX(id) FROM cliente),'".$c."',NOW());";

    $canchasTotalResultadoConsulta = $conexion->consulta($canchasTotalConsulta);

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
        
       
       
        try{        
            //instanciamos el servicio
             $calendarService = new Google_Service_Calendar($client);
          
                $event = new Google_Service_Calendar_Event();
                $event->setSummary("texto ok ok");
                $event->setDescription('Revisión nuevo , Tratamiento');
    
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
                $calendarService->events->delete($id_calendar, 'rvi0ek7jhuu5d70fo4noo4njm0');
                $id_event= $createdEvent->getId();
                $link_event= $createdEvent->gethtmlLink();
                
        }catch(Google_Service_Exception $gs){
          $m = json_decode($gs->getMessage());
          $m= $m->error->message;
    
        }catch(Exception $e){
            $m = $e->getMessage();
        }

        echo $m;
    

?>