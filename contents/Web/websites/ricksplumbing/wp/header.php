<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title>
<?php wp_title('&laquo;', true, 'right'); ?>
<?php bloginfo('name'); ?>
</title>
<!-- Main WordPress Stylesheet -->
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<!-- WYSIWYG CSS -->
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/wysiwyg.css" type="text/css" media="screen" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700,300,600,800' rel='stylesheet' type='text/css'>

<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/slider.css" />

<script language="javascript" type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/mootools.svn.js"></script>
<script language="javascript" type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/lofslidernews.mt11.js"></script>
<?php  wp_head(); ?>
</head>

<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<body onload="MM_preloadImages('<?php bloginfo('stylesheet_directory'); ?>/images/logos/delta.png','<?php bloginfo('stylesheet_directory'); ?>/images/logos/franke.png','<?php bloginfo('stylesheet_directory'); ?>/images/logos/Grohe.png','<?php bloginfo('stylesheet_directory'); ?>/images/logos/moen.png','<?php bloginfo('stylesheet_directory'); ?>/images/logos/noritz.png','<?php bloginfo('stylesheet_directory'); ?>/images/logos/Pfister.png','<?php bloginfo('stylesheet_directory'); ?>/images/logos/Takagi.png','<?php bloginfo('stylesheet_directory'); ?>/images/logos/toto.png','<?php bloginfo('stylesheet_directory'); ?>/images/logos/watts.png')">



<div id="wrapper">

	<div id="header">
    <div id="logo">
    
    
    <a href="<? bloginfo('home'); ?>"><img src="<?php echo get_option('of_logo') ?>" border="0" /></a></div>
    <div id="free">TOLL FREE:</div>
    <div id="phone"><?php echo get_option('of_phone') ?></div>
    <div id="license">Licensed & Insured</div>
    
    <div id="nav">
    
    <?php wp_nav_menu(array('theme_location' => 'primary-menu')); ?>
    
    <!--<ul>    
    
    <li><a href="<? bloginfo('home'); ?>">Home</a> |</li>
    <li><a href="<?php the_permalink(); ?>">About</a> |</li>
    <li><a href="services.php">Services</a> |</li>
    <li><a href="#">Quotes</a> |</li>
    <li><a href="contact.php">Contact Us</a> |</li>    
    <li><a href="faq.php">Gallery</a></li>
    
    </ul>-->
    </div>  
     
    </div>

<div style="border-top-style:solid; border-top-width:2px; border-top-color:#0033cc;"></div><br/>