
<?php 
include_once("conexion.php");
$conexion = new conexion();

$email = ($_GET['email']);
$name = ($_GET['name']);
$summary = ($_GET['summary']);
$calendar = ($_GET['calendar']);

$dias_cierre = "Select  
contenido_es
from 
textos where id = '7'
LIMIT 1;";
$resultado_mostrar = $conexion->consulta($dias_cierre);
while ($fila = mysqli_fetch_row($resultado_mostrar["resultado"])) {
  $texto = $fila[0];
//   echo($dia);
}

$texto = str_replace(array("\r\n", "\n\r", "\r", "\n"), "<br />", $texto);


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require_once('PHPMailer/src/PHPMailer.php');

    //Create a new PHPMailer instance
    // $mail = new PHPMailer(); 

    // $mail->IsSMTP(); 
    // $mail->SMTPDebug = 1; 


    // $mail->SMTPAuth = true; 
    // $mail->SMTPSecure = 'ssl'; 
    // $mail->Host = "smtp.gmail.com";
    // $mail->Port = 465; 

    
    #Godaddy configuration

        $mail->Host = 'localhost';
        $mail->Port = 25;
        $mail->SMTPSecure = FALSE;
        $mail->SMTPAuth = FALSE;
        $mail->SMTPAutoTLS = FALSE;

    
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Body=$template['html'];
    //Username to use for SMTP authentication
    $mail->Username = "reservastejolaembajada@gmail.com";
    $mail->Password = "reservastejolaembajadaadmin";
    //Set who the message is to be sent from
    $mail->setFrom('reservastejolaembajada@gmail.com', 'Tejo La Embajada');
    //Set an alternative reply-to address
    $mail->addReplyTo('david.huertas@uptc.edu.co', 'Confirmar reserva');
    //Set who the message is to be sent to
    $mail->addAddress($email, $name);
    $mail->AddEmbeddedImage('img/logo.png', 'logo_2u');
    //Set the subject line
    $mail->Subject = 'Completa tu reserva';
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    $mail->msgHTML(
    " <html>
    <head>
<style>
*{
    font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Oxygen,Ubuntu,Cantarell,'Fira Sans','Droid Sans','Helvetica Neue',sans-serif;
}
span, p {
    color: rgb(119,119,119);
    line-height: 24px;
    font-size: 16px;
    margin: 0px;
}

h1,h2,h3{
    color: #151230;
}

hr{
    border-top: 1px dashed red;
}

</style>
</head>
    <body style='margin:5vw;'>
        <div style='margin-left:4vw'>
            <img src='cid:logo_2u'> <h2>".$name.", recibimos tu solicitud de reserva </h2><br/><div>"
            .$texto."</div>
        </div>
        <br/>
        <hr>
        <p>


       <a href='".$calendar."'> 📆  Programa tu reserva en google Calendar </a>
        </p>


        <div style='margin-left:4vw'> <h3> Resumen de la reserva </h3> <p>
            ".$summary.
            "</p>
        </div>
        <br/>
        <hr>
        <div style='margin-left:4vw'> 
            <h3> Información del cliente </h3> <p>"
            .$name."<br/>".$email."</p>
        </div>
    </body>
    </html>
    "

    );
    //Replace the plain text body with one created manually
    $mail->AltBody = 'Confirma tu reserva de Tejo la Embajada';

    //send the message, check for errors
    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Message sent!";
    }
?>