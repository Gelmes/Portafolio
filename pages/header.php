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

<!-- Hotjar Tracking Code for rubiomarco.com -->
<script>
    (function(h,o,t,j,a,r){
	            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
		            h._hjSettings={hjid:1603920,hjsv:6};
		            a=o.getElementsByTagName('head')[0];
			            r=o.createElement('script');r.async=1;
			            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
				            a.appendChild(r);
				        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-37855354-4"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-37855354-4');
</script>

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
