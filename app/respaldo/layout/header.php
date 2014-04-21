<?php require_once('../../core/config.php'); ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>BSocial</title>
    <meta name="description" content="SUMA">
    <meta name="author" content="SUMA">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link href="<?php echo $url;?>css/default.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo $url;?>css/bootstrap.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo $url;?>css/bootstrap.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo $url;?>css/style.css" rel="stylesheet" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo $url;?>css/datepicker.css" type="text/css" >
    
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" >
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>   
   
    <script type="text/javascript" src="<?php echo $url;?>js/bootstrap.js"></script>
    <link rel="icon" type="image/png" href="./img/favicon32.png">
    <script type="text/javascript">
	    $('.dropdown-toggle').dropdown();
    </script>
 </head>

 <body data-spy="scroll" data-target=".bs-docs-sidebar">
 
 <!-- Navbar ================================================== -->
 <div class="navbar navbar-inverse">
        <div class="container">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo $url;?>">BSocial</a>
          <div class="nav-collapse collapse navbar-collapse">
            <ul class="nav navbar-nav">
	            <li><a href="<?php echo $url;?>admin/empresas">Empresas</a></li>
	            <li><a href="<?php echo $url;?>admin/usuarios">Usuarios</a></li>
	            <li><a href="<?php echo $url;?>admin/grupos">Grupos</a></li>
          	</ul>
            
          </div><!-- /.nav-collapse -->

          
        </div><!-- /.container -->
      </div>
      <div class="container">