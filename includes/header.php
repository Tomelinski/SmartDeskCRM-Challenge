<?php 
    ob_start();
    require("functions.php");
    session_start();
    
    $message = isset($_SESSION['message']) ? $_SESSION['message']:"";
    //$campaignDetails = isset($_SESSION['campaign']) ? $_SESSION['campaign'] : null;
    $campaignDetails = isset($_SESSION['campaignDetails']) ? unserialize($_SESSION['campaignDetails']) : new stdClass;
    unset($_SESSION['message']);
    //$campaignDetails = "";



    ?>
    
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Tom Zielinski">

    <title>SmartDeskCRM App</title>

    <!--
	Author: Tom Zielinski
	-->

    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    
    <link href="./css/style.css" rel="stylesheet">
  </head>

  

  <body>
  <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="./create.php">SmartDeskCRM</a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a  class="nav-link" aria-current="page" href="./create.php">Create a Campaign</a>
          </li>

          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="./dashboard.php">Campaign Dashboard</a>
          </li>

        </ul>
      </div>
    </div>
  </nav>

    <main class="row">
      <div class="offset-md-2 col-md-8 col-sm-12">