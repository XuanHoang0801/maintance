<?php

use app\models\Menu;
use yii\helpers\Url;

?>
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="<?= Url::toRoute('/',true) ?>">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li>
  <!-- End Dashboard Nav -->
  <?php foreach(Menu::menuParent() as $parent): ?>
  <li class="nav-item">

    <a class="nav-link collapsed" data-bs-target="#components-nav-<?=$parent->id?>" data-bs-toggle="collapse" href="#">
        <?= $parent->icon ?><span><?= $parent->name ?></span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="components-nav-<?=$parent->id?>" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <?php foreach (Menu::menuChild($parent->id) as $child) :  ?>
        <li>
          <a href="/<?= $child->slug ?>">
            <span><?= $child->name?></span>
          </a>
        </li>
        <?php endforeach ?>
    </ul>
  </li> 

  <?php endforeach ?>
  <!-- End Components Nav -->

</ul>

</aside><!-- End Sidebar-->
