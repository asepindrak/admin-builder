<?php
    require "config/config.php";
    require 'config/pages.php';
    require 'config/routes.php';

?>
    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">
        <?php foreach($pages as $page) { ?>
        
          <?php if($page["isMenu"] === true){ ?>
            <li class="nav-item">
              <a class="nav-link " href="<?=routes($page["route"])?>">
                <i class="<?=$page["icon"]?>"></i>
                <span><?=$page["name"]?></span>
              </a>
            </li>
          <?php } ?>

        <?php } ?>
        <li class="nav-item">
          <a class="nav-link " href="<?=$SERVER.'/config/logout.php'?>">
            <i class="bi bi-box-arrow-right"></i>
            <span>Logout</span>
          </a>
        </li>
      </ul>

    </aside><!-- End Sidebar-->