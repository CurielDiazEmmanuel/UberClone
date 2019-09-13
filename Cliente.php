<?php
  include("encabezado.php");
  session_start();
  require_once('vendor/autoload.php');
  require_once('App/Auth/Auth.php');
$enlace = mysqli_connect("localhost", "root", "", "emergentes");
 ?>


<?php if (Auth::isLogin()):  ?>



<body>
<h2 align="center" >Bienvenido Cliente</h2>
            

            <h2>Hola <?php echo $_SESSION['user']['name']; ?></h2>
            <a href="logout.php">Cerrar Sesion</a>
            
           

 <div class="row" >
  <div  class="col-md-1"> </div>
   <div class="col-md-10" align="center">
      
                    <h3> <b> Pedidos </b> </h3>
                                <table id="dtVerticalScrollExample" class="table table-striped table-bordered table-sm" cellspacing="20" width="10%"  >
                                    <tr>
                                        <td><b>Pedidos</b></td>
                                        <td><b>Descripción </b></td>                                         
                                        <td><b>Origen</b></td>
                                        <td><b>Destino</b></td>
                                        <td><b>Distancia</b></td>
                                        <td><b>Costo</b></td>
                                         <td><b>Nombre Mensajero</b></td>
                                        <td> <b>Pendiente</b></td>
                                        <td>  Cancelar </td>
                                    </tr>

                                      <?php                                                   
                                                    $consulta_texto = 'select e.id,user_id, descripcion,origen,destino,distancia,costo,u.name, pendiente from entregas as e inner join users as u   on e.cliente= u.id ' ;
                                                    $resultado = $enlace->query($consulta_texto);
                                                   
                                                    while ($row = mysqli_fetch_array($resultado)) {
                                                            echo '  <tr>
                                                                <td >  '.$row['id'].'</td>
                                                                <td >  '.$row['descripcion'].'</td>
                                                                <td >  '.$row['origen'].'</td>
                                                                <td >  '.$row['destino'].'</td>
                                                                <td >  '.$row['distancia'].' mts</td>
                                                                <td >  '.$row['costo'].'.00</td>
                                                                <td >  '.$row['cliente'].'</td>
                                                                <td >  '.$row['pendiente'].'</td>
                                                               <td>    <a href="http://localhost/socialauthphp/consultas.php? id='.$row['id'].'" >  Eliminar </a>   </td>
                                   </tr>';
                                                                       
                                                            }
                                                    $enlace->close();
 
                                          ?>

                                </table>
  
  </div>

 

</div>


  <br><br>
    <div  >                    
          <input id="origin-input" class="controls" type="text" placeholder="Ingrese el lugar de origen" autocomplete="off" style="z-index: 0; position: absolute; left: 0px; top: 0px;" onchange="origen.value.toUpperCase() onselect="origen.value=origin-input.value"> 
          <input id="destination-input" class="controls" type="text" placeholder="Ingrese el lugar de destino" autocomplete="off" style="z-index: 0; position: absolute; left: 212px; top: 0px;">

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







<div class="row">


  <div  class="col-md-4" align="center">
    <form  action="http://localhost/socialauthphp/consultas.php" method="post">   
       <div>     Mensajero:</div>        
        <div> 
          <select name="mensajero" id="mensajero">
                    <option  id="0" selected="">Seleccione un mensajero...   </option>
                       <?php
                                                   $enlace = mysqli_connect("localhost", "root", "", "emergentes");
                                                    $consulta_texto = 'select id, name from users where tipo=0';
                                                    $resultado = $enlace->query($consulta_texto);
                                                   
                                                    while ($row = mysqli_fetch_array($resultado))     {
                                                            echo '<option value=" '.$row['id'].'">' .$row['name']. '</option>';
                                                                       
                                                            }
                                                    $enlace->close();
                               ?>
          </select>   
        
        </div> <br><br> 
        <div>     Descripción:</div>
        <div>   <textarea rows="3" cols="50" id="descripcion" name="descripcion" ></textarea> </div>  <br>

        <div>     Origen:</div>
        <div>   <textarea rows="3" cols="50"  id="origen"  name="origen" ></textarea> </div>  <br>

        <div>     Destino:</div>
        <div>   <textarea rows="3" cols="50" id="destino"  name="destino" ></textarea> </div>  <br>


        <div>     Distancia</div>
        <div>    <textarea rows="1" cols="12"  id="distancia" name="distancia"   ></textarea>   </div>  <br>

        <div>     Costo de envío</div>
        <div>    <textarea rows="1" cols="12"  id="costo" name="costo"    ></textarea>  </div>  <br>

  
        <div>   <button class="btn btn-primary" type="submit" id="guardaPedido">Guardar</button> </div>  <br>
        </form>





     <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" target=»_blank» method="post" >
        <input type="hidden" name="cmd" value="_s-xclick">
        <input type="hidden" name="hosted_button_id" value="">
        <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
        <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
     </form>






  </div>
  
 


 
 <div  class="col-md-1">
<div id="map" style="width: 700px; height: 500px;">
   <script src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyAXTM8tcD_fVL09AEKUKhFyundS8el6C70&libraries=places&callback=initMap"  async defer > </script>
</div>
 </div>

         
 </div>
  




<br><br>
<script >
function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    mapTypeControl: false,
    center: {lat: 17.0685816, lng: -96.7347838},
    zoom: 13
  });
   var geocoder = new google.maps.Geocoder();
  new AutocompleteDirectionsHandler(geocoder,map);
}

/**
 * @constructor
 */
function AutocompleteDirectionsHandler(geocoder,map) {
  this.map = map;
  this.geocoder = geocoder;
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

  var destinationAutocomplete =  new google.maps.places.Autocomplete(destinationInput);
  // Specify just the place data fields that you need.s
  destinationAutocomplete.setFields(['place_id']);

  this.setupClickListener('changemode-walking', 'WALKING');
  this.setupClickListener('changemode-transit', 'TRANSIT');
  this.setupClickListener('changemode-driving', 'DRIVING');

  this.setupPlaceChangedListener(originAutocomplete, 'ORIG');
  this.setupPlaceChangedListener(destinationAutocomplete, 'DEST');


  this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(originInput);
  this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(destinationInput);
  this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(modeSelector);
}

// Sets a listener on a radio button to change the filter type on Places
// Autocomplete.
AutocompleteDirectionsHandler.prototype.setupClickListener = function( id, mode) {
  var radioButton = document.getElementById(id);
  var me = this;

  radioButton.addEventListener('click', function() {
    me.travelMode = mode;
    me.route();
  });
};

AutocompleteDirectionsHandler.prototype.setupPlaceChangedListener = function(autocomplete, mode) {
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

  this.directionsService.route(  { 
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

  var ran= Math.random() * (1200 - 500) + 500;
  var $costo =ran*0.1;


var auxo= document.getElementById('origin-input').value;
var auxd= document.getElementById('destination-input').value;
document.getElementById('origen').innerHTML=auxo;
document.getElementById('destino').innerHTML=auxd;
document.getElementById('distancia').innerHTML=ran;
document.getElementById('costo').innerHTML=$costo;

};


 function geocodeAddress(geocoder, resultsMap) {
        var address = document.getElementById('address').value;

        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: resultsMap,
              position: results[0].geometry.location
            });

            document.getElementById('distancia').innerHTML= results[0].geometry.location.lng();
            document.getElementById('costo').innerHTML= results[1].geometry.location.lat();

          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
        
      }




</script>










</body>


<?php else: header('Location: index.php');?>
          <?php Auth::getUserAuth();?>
           <?php endif; ?>














           