<?php
  if (!isset($page) || $page == null ) {
      $page = '';
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Construction</title>
  <!-- loader-->
  <link href="<?=base_url('assets/css/pace.min.css')?>" rel="stylesheet"/>
  <script src="<?=base_url('assets/js/pace.min.js')?>"></script>
  <!--favicon-->
  <link rel="icon" href="<?=base_url('assets/images/favicon.ico')?>" type="image/x-icon">
  <!--Full Calendar Css-->
  <link href="<?=base_url('assets/plugins/fullcalendar/css/fullcalendar.min.css')?>" rel='stylesheet'/>
  <!-- simplebar CSS-->
  <link href="<?=base_url('assets/plugins/simplebar/css/simplebar.css')?>" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="<?=base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="<?=base_url('assets/css/animate.css')?>" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="<?=base_url('assets/css/icons.css')?>" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="<?=base_url('assets/css/sidebar-menu.css')?>" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="<?=base_url('assets/css/app-style.css')?>" rel="stylesheet"/>
  <link href="<?=base_url('assets/css/places.css')?>" rel="stylesheet"/>
  
</head>

<body class="bg-theme bg-theme2">
 
<!-- Start wrapper-->
 <div id="wrapper">
 
  <!--Start sidebar-wrapper-->
   <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
     <div class="brand-logo">
      <a href="index.html">
       <img style="width: 60px; border-radius: 3px" src="<?=base_url('assets/images/logo-icon2.png')?>" class="logo-icon" alt="logo icon">
       <h5 class="logo-text">CONTRUCTION</h5>
     </a>
   </div>
   <ul class="sidebar-menu do-nicescrol">
      <li class="sidebar-header">MAIN NAVIGATION</li>

      <?php if(!isset($_SESSION['utilisateur'])) {?>
      <li>
        <a href="<?=base_url('Controller/home')?>">
          <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <?php }?>

      <li>
        <a href="<?=base_url('Controller/liste')?>">
          <i class="zmdi zmdi-invert-colors"></i> <span>Creation devis</span>
        </a>
      </li>

      <li>
        <a href="<?=base_url('Controller/form')?>">
          <i class="zmdi zmdi-format-list-bulleted"></i> <span>Insertion de données</span>
        </a>
      </li>

      <?php if(isset($_SESSION['utilisateur'])) {?>
      <li>
        <a href="<?=base_url('Controller/table_client')?>">
          <i class="zmdi zmdi-grid"></i> <span>Liste demande de Devis</span>
        </a>
      </li>
      <?php }?>
      <?php if(!isset($_SESSION['utilisateur'])) {?>
      <li>
        <a href="<?=base_url('Controller/table_admin')?>">
          <i class="zmdi zmdi-grid"></i> <span>Liste demande de Devis</span>
        </a>
      </li>
      <?php }?>

      <?php if(!isset($_SESSION['utilisateur'])) {?>
      <li>
        <a href="<?=base_url('Controller/table')?>">
          <i class="zmdi zmdi-grid"></i> <span>Liste des travaux</span>
        </a>
      </li>
      <?php }?>

      <?php if(!isset($_SESSION['utilisateur'])) {?>
      <li>
        <a href="<?=base_url('Controller/table_finition')?>">
          <i class="zmdi zmdi-grid"></i> <span>Liste des finition</span>
        </a>
      </li>
      <?php }?>
      
      <!-- <li>
        <a href="<?=base_url('Controller/calendar')?>">
          <i class="zmdi zmdi-calendar-check"></i> <span>Calendar</span>
          <small class="badge float-right badge-light">New</small>
        </a>
      </li> -->

      <!-- <li>
        <a href="<?=base_url('Controller/profil')?>">
          <i class="zmdi zmdi-face"></i> <span>Profile</span>
        </a>
      </li>

      <li>
        <a href="<?=base_url('Controller/login')?>" target="_blank">
          <i class="zmdi zmdi-lock"></i> <span>Login</span>
        </a>
      </li> -->

       <li>
        <a href="<?=base_url('Controller/deconnexion')?>" target="_blank">
          <i class="zmdi zmdi-account-circle"></i> <span>Deconnexion</span>
        </a>
      </li>

      <!-- <li class="sidebar-header">LABELS</li>
      <li><a href="javaScript:void();"><i class="zmdi zmdi-coffee text-danger"></i> <span>Important</span></a></li>
      <li><a href="javaScript:void();"><i class="zmdi zmdi-chart-donut text-success"></i> <span>Warning</span></a></li>
      <li><a href="javaScript:void();"><i class="zmdi zmdi-share text-info"></i> <span>Information</span></a></li> -->

    </ul>
   
   </div>
   <!--End sidebar-wrapper-->

   <!--Start topbar header-->
<header class="topbar-nav">
 <nav class="navbar navbar-expand fixed-top">
  <ul class="navbar-nav mr-auto align-items-center">
    <li class="nav-item">
      <a class="nav-link toggle-menu" href="javascript:void();">
       <i class="icon-menu menu-icon"></i>
     </a>
    </li>
    <li class="nav-item">
      <form class="search-bar">
        <input type="text" class="form-control" placeholder="Enter keywords">
         <a href="javascript:void();"><i class="icon-magnifier"></i></a>
      </form>
    </li>
  </ul>
     
  <ul class="navbar-nav align-items-center right-nav-link">
    <li class="nav-item dropdown-lg">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
      <i class="fa fa-envelope-open-o"></i></a>
    </li>
    <li class="nav-item dropdown-lg">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
      <i class="fa fa-bell-o"></i></a>
    </li>
    <li class="nav-item language">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();"><i class="fa fa-flag"></i></a>
      <ul class="dropdown-menu dropdown-menu-right">
          <li class="dropdown-item"> <i class="flag-icon flag-icon-gb mr-2"></i> English</li>
          <li class="dropdown-item"> <i class="flag-icon flag-icon-fr mr-2"></i> French</li>
          <li class="dropdown-item"> <i class="flag-icon flag-icon-cn mr-2"></i> Chinese</li>
          <li class="dropdown-item"> <i class="flag-icon flag-icon-de mr-2"></i> German</li>
        </ul>
    </li>
    <li class="nav-item">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
        <span class="user-profile"><img src="https://via.placeholder.com/110x110" class="img-circle" alt="user avatar"></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-right">
       <li class="dropdown-item user-details">
        <a href="javaScript:void();">
           <div class="media">
             <div class="avatar"><img class="align-self-start mr-3" src="https://via.placeholder.com/110x110" alt="user avatar"></div>
            <div class="media-body">
            <h6 class="mt-2 user-title">Sarajhon Mccoy</h6>
            <p class="user-subtitle">mccoy@example.com</p>
            </div>
           </div>
          </a>
        </li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="icon-envelope mr-2"></i> Inbox</li>
        <li class="dropdown-divider"></li>

        <li class="dropdown-item"><a href="<?=base_url('Controller/panier')?>" target="_blank">
                <i class="icon-wallet mr-2"></i> Panier
            </a></li>

        <li class="dropdown-divider"></li>

        <li class="dropdown-item">
            <a href="<?=base_url('Controller/deconnexion')?>" target="_blank">
                <i class="icon-power mr-2"></i> Logout
            </a>
        </li>

      </ul>
    </li>
  </ul>
</nav>
</header>
<!--End topbar header-->
   
    <?php include($page.".php") ?>
    <?php include("footer.php") ?>




</body>
</html>