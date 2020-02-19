<script>var menu_item = "menu_home";</script>
<?php include "header.php";    ?>
<?php include "slideshow.php"; ?>




<div id="about">
<h1>About</h1>
<?php get_contents_limit("text/about.txt", 500);?>
<p><a href="about.php">Click here to read more!</a></p>
</div>

<div id="news">
<h1>Updates</h1>

<?php get_contents("text/news.txt");?>
</div>


<?php include "footer.php";?>