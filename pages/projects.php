<?php include("header.php"); ?>

  <div class="container">
    <div class="section">

      <!--   Icon Section   -->
      <?php
      //get_all_projects_divided("../projects", 0, 0);
      get_projects(htmlspecialchars($_GET['dir']));
      ?>


    </div>
  </div>

  <?php include("footer.php"); ?>
