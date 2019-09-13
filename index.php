
 <?php
 include("encabezado.php");
  session_start();
  require_once('vendor/autoload.php');
  require_once('App/Auth/Auth.php');  
 ?>



<body>


     <div class="container">
       <h2 align="center" >Bienvenido</h2>
       <h3 align="center" >Inicia sesión con:</h3>
       <div class="row" align="center"  >
           <?php if (Auth::isLogin()): ?>
              <h2>Hola <?php echo $_SESSION['user']['name'] ?></h2>
                  <a href="logout.php">Cerrar Sesion</a>
            <?php else: ?>
          <?php
            Auth::getUserAuth();
           ?>
        
           <br><br>
        
           <div class="col-md-4"></div>

          <div class="col-md-4">
            <div class="row">
        
            <a href="?login=Facebook" class="btn btn-block btn-social btn-facebook" ><span class="fa fa-facebook"></span> Inicia sesion con Facebook</a>
            <a href="?login=Google" class="btn btn-block btn-social btn-google"><span class="fa fa-google"></span> Inicia sesion con Google</a>
            <a href="?login=Twitter" class="btn btn-block btn-social btn-twitter"><span class="fa fa-twitter"></span> Inicia sesion con Twitter</a>
          </div>
       

       </div>
         <?php endif; ?>
     </div>

</body>

