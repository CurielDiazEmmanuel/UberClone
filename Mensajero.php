<?php

  session_start();
  require_once('vendor/autoload.php');
  require_once('App/Auth/Auth.php');

$enlace = mysqli_connect("localhost", "root", "", "emergentes");
 ?>

<?php if (Auth::isLogin()):  ?>


<!DOCTYPE html>
<html>
<head>
  <title>Mensajero</title>
  <link rel="stylesheet" href="assets/css/bootstrap.css">
     <link rel="stylesheet" href="assets/css/font-awesome.css">
     <link rel="stylesheet" href="assets/css/bootstrap-social.css">
     <script src="assets/js/jquery.js" charset="utf-8"></script>
     
  <link rel="stylesheet" type="text/css" href="estilo.css">


</head>

<body>

            <h2>Hola <?php echo $_SESSION['user']['name']; ?></h2>
            <a href="logout.php">Cerrar Sesion</a>

 <div class="row" >
  <div  class="col-md-1"> </div>
   <div class="col-md-10" align="center">
      
                    <h3> <b> ENTREGAS</b> </h3>
                    <h5> *Anota  NO en el cuadro de texto de la columna pediente si ya se ha hecho la entrega </h5>
                                <table id="dtVerticalScrollExample" class="table table-striped table-bordered table-sm" cellspacing="20" width="130%"  >
                                    <tr>
                                        <td><b>Entregas</b></td>
                                        <td><b>Descripción </b></td> 
                                        <td><b>Origen</b></td>
                                        <td><b>Destino</b></td>
                                        <td><b>Distancia</b></td>
                                        <td><b>Costo</b></td>
                                        <td><b>Cliente</b></td>
                                        <td> <b>Pendiente</b></td>
                                        <td>  Cancelar </td>
                                    </tr>

                                      <?php
                                                 
                                $consulta_texto = 'select e.id,user_id, descripcion, origen,destino,distancia,costo,pendiente,u.name
                                                        from entregas as e inner join users as u   on u.id= user_id
                                                                                                             where cliente='. $_SESSION['user']['id'] ;
                                                    $resultado = $enlace->query($consulta_texto);
                                                   
                                                    while ($row = mysqli_fetch_array($resultado)) {
                                                            echo '  <tr>
                                                                <td >  '.$row['id'].'</td>
                                                                <td >  '.$row['descripcion'].'</td>
                                                                <td >  '.$row['origen'].'</td>
                                                                <td >  '.$row['destino'].'</td>
                                                                <td >  '.$row['distancia'].' mts</td>
                                                                <td >  '.$row['costo'].'.00</td>
                                                                <td >  '.$row['name'].'</td>

                                                          <td > <input type="text"  id="p" size="2" maxlength="2" placeholder="'.$row['pendiente'].' " >
                                                          <a href="http://localhost/socialauthphp/modificar.php? id='.$row['id'].'" >  Guardar </a> </td>

                                                               <td>    <a href="http://localhost/socialauthphp/consultas.php? id='.$row['id'].'" >  Eliminar </a>   </td>
                                   </tr>';
                                                                       
                                                            }
                                                    $enlace->close();
 
                                          ?>

                                </table>
  
  </div>

 

</div>

  <br><br>


    <div id="llenar" >                    
          <input id="origin-input" class="controls" type="text" value="<?php echo $row['origen']; ?>" autocomplete="off" style="z-index: 0; position: absolute; left: 0px; top: 0px;" onchange="origen.value.toUpperCase() onselect="origen.value=origin-input.value"> 
          <input id="destination-input" class="controls" type="text"  value="<?php echo $row['origen']; ?>" autocomplete="off" style="z-index: 0; position: absolute; left: 212px; top: 0px;">

         <div id="mode-selector" class="controls" style="z-index: 0; position: relative; left: 424px; top: 0px;">
          <input type="radio" name="type" id="changemode-walking" checked="checked">
          <label for="changemode-walking">Walking</label>

          <input type="radio" name="type" id="changemode-transit">
          <label for="changemode-transit">Transit</label>

          <input type="radio" name="type" id="changemode-driving">
          <label for="changemode-driving">Driving</label>
        </div>
    </div>



<br><br> 


<div  class="col-md-1"> </div>
<div  class="col-md-1"> </div>
  <div  class="col-md-1">
<div  class="col-md-1">
<div id="map" style="width: 700px; height: 500px;">
   <script src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyAXTM8tcD_fVL09AEKUKhFyundS8el6C70&libraries=places&callback=initMap"  async defer > </script>
</div>
 </div>


 </div>

 


</div>

 





 <br><br>
<script >
function alertaValue(){ 
    alert(document.getElementById ) 
}


function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    mapTypeControl: false,
    center: {lat: 17.0685816, lng: -96.7347838},
    zoom: 13
  });


  
  new AutocompleteDirectionsHandler(map);
}

/**
 * @constructor
 */
function AutocompleteDirectionsHandler(map) {
  this.map = map;
  this.originPlaceId = null;
  this.destinationPlaceId = null;
  this.travelMode = 'WALKING';
  this.directionsService = new google.maps.DirectionsService;
  this.directionsDisplay = new google.maps.DirectionsRenderer;
  this.directionsDisplay.setMap(map);


  var originInput = document.getElementById('origin-input');
  var destinationInput = document.getElementById('destination-input');
  var modeSelector = document.getElementById('mode-selector');

 

  var originAutocomplete = new google.maps.places.Autocomplete(originInput);
  // Specify just the place data fields that you need.
  originAutocomplete.setFields(['place_id']);

  var destinationAutocomplete =
      new google.maps.places.Autocomplete(destinationInput);
  // Specify just the place data fields that you need.
  destinationAutocomplete.setFields(['place_id']);

  this.setupClickListener('changemode-walking', 'WALKING');
  this.setupClickListener('changemode-transit', 'TRANSIT');
  this.setupClickListener('changemode-driving', 'DRIVING');

  this.setupPlaceChangedListener(originAutocomplete, 'ORIG');
  this.setupPlaceChangedListener(destinationAutocomplete, 'DEST');


  this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(originInput);
  this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(
      destinationInput);
  this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(modeSelector);
}

// Sets a listener on a radio button to change the filter type on Places
// Autocomplete.
AutocompleteDirectionsHandler.prototype.setupClickListener = function(
    id, mode) {
  var radioButton = document.getElementById(id);
  var me = this;

  radioButton.addEventListener('click', function() {
    me.travelMode = mode;
    me.route();
  });
};

AutocompleteDirectionsHandler.prototype.setupPlaceChangedListener = function(
    autocomplete, mode) {
  var me = this;
  autocomplete.bindTo('bounds', this.map);

  autocomplete.addListener('place_changed', function() {
    var place = autocomplete.getPlace();

    if (!place.place_id) {
      window.alert('Please select an option from the dropdown list.');
      return;
    }
    if (mode === 'ORIG') {
      me.originPlaceId = place.place_id;
    } else {
      me.destinationPlaceId = place.place_id;
    }
    me.route();
  });
};

AutocompleteDirectionsHandler.prototype.route = function() {
  if (!this.originPlaceId || !this.destinationPlaceId) {
    return;
  }
  var me = this;

  this.directionsService.route(
      {
        origin: {'placeId': this.originPlaceId},
        destination: {'placeId': this.destinationPlaceId},
        travelMode: this.travelMode
      },
      function(response, status) {
        if (status === 'OK') {
          me.directionsDisplay.setDirections(response);
        } else {
          window.alert('Directions request failed due to ' + status);
        }
      });
    

  var auxo= document.getElementById('origin-input').value;
 var auxd= document.getElementById('destination-input').value;
 document.getElementById('origen').innerHTML=auxo;
 document.getElementById('destino').innerHTML=auxd;





};



</script>




</body>
</html>

<?php else: header('Location: index.php');?>
          <?php Auth::getUserAuth();?>
           <?php endif; ?>