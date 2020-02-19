<?php include("header.php"); ?>
  <div class="container">
    <div class="section">

      <?php
      $directory = htmlspecialchars($_GET["dir"]);
      get_content($directory,"top.txt");
      get_carousel($directory);
      get_content($directory,"readme.txt");
      get_projects($directory);
      get_content($directory,"bottom.txt");
      ?>

    </div>
  </div>
<?php include("footer.php"); ?>
