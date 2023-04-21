<?php

use app\models\Menu;
use yii\helpers\Url;

?>
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="<?= Url::toRoute('/',true) ?>">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li>
  <!-- End Dashboard Nav -->
  <?php foreach(Menu::menuParent() as $parent): ?>
  <li class="nav-item">

    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
        <?= $parent->icon ?><span><?= $parent->name ?></span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <?php foreach (Menu::menuChild($parent->id) as $child) :  ?>
        <li>
          <a href="/<?= $child->slug ?>">
            <span><?= $child->name?></span>
          </a>
        </li>
        <?php endforeach ?>
    </ul>
  </li> 

  <!-- <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <?= $parent->icon ?>
                            <?= Yii::t('app',$parent->name) ?>
                        </a>
                        <ul class="dropdown-menu bg-transparent border-0">
                            <?php
                                foreach(Menu::menuChild($parent->id) as $menuItem){
                            ?>
                            <li>
                              <a href="<?= Url::toRoute($menuItem->slug,true)?>" class="dropdown-item"><?= Yii::t('app',$menuItem->name) ?></a>
                            </li>
                            <?php } ?>

                        </ul>
                                </li> -->
  <?php endforeach ?>
  <!-- End Components Nav -->

</ul>

</aside><!-- End Sidebar-->
