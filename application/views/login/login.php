<!DOCTYPE html>
<html  ng-app>
  <head>
    <title>Login</title>
    <style type="text/css">
      .red{
        color: red;
      }
    </style>
    <!-- Bootstrap -->
    <link href="<?php echo base_url('public/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" media="screen">
    <link href="<?php echo base_url('public/bootstrap/css/bootstrap-responsive.min.css');?>" rel="stylesheet" media="screen">
    <link href="<?php echo base_url('public/assets/styles.css');?>" rel="stylesheet" media="screen">
    <script src="<?php echo base_url('public/vendors/jquery-1.9.1.min.js');?>"></script>
    <script src="<?php echo base_url('public/bootstrap/js/bootstrap.min.js');?>"></script>
    <script src="<?php echo base_url('public/vendors/jGrowl/jquery.jgrowl.js');?>"></script>
    <link href="<?php echo base_url('public/vendors/jGrowl/jquery.jgrowl.css');?>" rel="stylesheet" media="screen">
        
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="<?php echo base_url('public/vendors/modernizr-2.6.2-respond-1.1.0.min.js');?>"></script>

    <!-- ANGULARJS!-->
    <script src="<?php echo base_url('public/angular/angularJs-min-1.2.20.js');?>"></script>
    <!-- Controladores Angular -->
    <script src="<?php echo base_url('public/angular/controladores/loginController.js');?>"></script>

  </head>
  <body id="login" ng-controller="loginController">
    <div class="container">

      <form class="form-signin">
        <h2 class="form-signin-heading">Iniciar Sesión</h2>

        <small class="red">{{msjerrorusr}}</small>
        <input type="text" class="input-block-level" placeholder="Usuario" ng-model="usr">

        <small class="red">{{msjerrorpass}}</small>
        <input type="password" class="input-block-level" placeholder="Clave" ng-model="pass">
   
        <button class="btn btn-large btn-success  btn-block" ng-click="log()">Ingresar</button>
      </form> 

    </div> <!-- /container -->
    
  </body>
</html>