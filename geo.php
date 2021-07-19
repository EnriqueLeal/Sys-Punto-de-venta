<?php
  $page_title = 'Lista de categorías';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page

  page_require_level(1);
  
  $loc = find_by_location('products',$_GET['id']);

// $pNombre=$_POST["latitud"];
// $pAp_paterno=$_POST["longitud"];
// $pAp_materno=$_POST["comparacion"];

  echo $loc['latitud'];

// echo $pNombre;
?>

     <?php echo display_msg($msg); 

     // $s_total   = $db->escape($_POST['id']);
    ?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Geolocalización</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=true"></script>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>

    <article id="mapa">
    </article>
    <input type="button" id="parar" value="Parar" onclick="detener();"/>
</body>
<script type="text/javascript">
	var watchId;
var mapa = null;
var mapaMarcador = null;    

if (navigator.geolocation) {
    watchId = navigator.geolocation.watchPosition(mostrarPosicion, mostrarErrores, opciones);   
} else {
    alert("Tu navegador no soporta la geolocalización, actualiza tu navegador.");
}

function mostrarPosicion(posicion) {


    
    var latitud2 = posicion.coords.latitude;
     var longitud2 = posicion.coords.longitude;
     var precision2 = posicion.coords.accuracy;
     var precision = <?php echo $loc['comparacion'];?>;
     var latitud = <?php echo $loc['latitud'];?>;
     var longitud = <?php echo $loc['lontitud'];?>;
     // console.log(latitud2)
     console.log(longitud2)
// console.log(<?php echo $loc['latitud'];?>)
console.log(<?php echo $loc['lontitud'];?>)




  // var latitud = document.getElementById($loc['latitud']).value;
// getElementsByTagName('latitud').value = a
   //  var longitud = $loc['longitud'];
   //  var precision = $loc['comparacion'];
     // alert('Latitud'+ '' );

    var miPosicion = new google.maps.LatLng(latitud,longitud,precision);

    // Se comprueba si el mapa se ha cargado ya 
    if (mapa == null) {
        // Crea el mapa y lo pone en el elemento del DOM con ID mapa
        var configuracion = {center: miPosicion, zoom: 16, mapTypeId: google.maps.MapTypeId.HYBRID};
        mapa = new google.maps.Map(document.getElementById("mapa"), configuracion);

        // Crea el marcador en la posicion actual
        mapaMarcador = new google.maps.Marker({position: miPosicion, title:"Esta es tu posición"});
        mapaMarcador.setMap(mapa);
    } else {
        // Centra el mapa en la posicion actual
        mapa.panTo(miPosicion);
        // Pone el marcador para indicar la posicion
        mapaMarcador.setPosition(miPosicion);
    }
}

function mostrarErrores(error) {
    switch (error.code) {
        case error.PERMISSION_DENIED:
            alert('Permiso denegado por el usuario'); 
            break;
        case error.POSITION_UNAVAILABLE:
            alert('Posición no disponible');
            break; 
        case error.TIMEOUT:
            alert('Tiempo de espera agotado');
            break;
        default:
            alert('Error de Geolocalización desconocido :' + error.code);
    }
}

var opciones = {
    enableHighAccuracy: true,
    timeout: 10000,
    maximumAge: 1000
};

function detener() {
    navigator.geolocation.clearWatch(watchId);
}

</script>
</html>