<!DOCTYPE html>

<?php include("functions/functions.php"); ?>

<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Marco's Projects</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="/pages/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="/pages/css/custom.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="/pages/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="/pages/css/animate.css" type="text/css" rel="stylesheet"/>
</head>
<body>
  <nav class="pinned" style="z-index: 1;" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="/index.php" class="brand-logo"></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="/index.php">Home</a></li>
        <?php get_pages(); ?>
      </ul>

      <ul id="nav-mobile" class="side-nav">
        <li><a href="/index.php">Home</a></li>
        <?php get_pages(); ?>

      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse white-text"><i class="material-icons">menu</i></a>
    </div>
  </nav>
  <div style="height: 64px;"></div>
