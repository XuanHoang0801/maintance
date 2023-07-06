<?php

use frontend\assets\BackendAsset;
use backend\models\Setting;
use frontend\models\Category;
$backend = BackendAsset::register($this);
?>
 <!-- ======= Footer ======= -->
 <footer id="footer" class="footer">

<div class="footer-content">
  <div class="container">

    <div class="row g-5">
      <div class="col-lg-4">
        <h3 class="footer-heading"><?= Setting::widgetOne()->content ?></h3>
        <img src="<?= $backend->baseUrl ?>/<?= Setting::logo()->content?>" width="100rem">
        <p class="mt-3"><?= Setting::title()->content ?></p>
      </div>
      <div class="col-6 col-lg-2">
        <h3 class="footer-heading"><?= Setting::widgetTwo()->content ?></h3>
        <ul class="footer-links list-unstyled">
          <?php foreach(Category::getAll() as $category): ?>
          <li><a href="/<?= $category->slug ?>"><i class="bi bi-chevron-right"></i> <?= $category->name ?></a></li>
          <?php endforeach ?>
          
        </ul>
      </div>
      <div class="col-6 col-lg-2">
        <h3 class="footer-heading"><?= Setting::widgetThree()->content ?></h3>
        <ul class="footer-links list-unstyled">
          <li><a href="category.html"><i class="bi bi-chevron-right"></i> Business</a></li>
          <li><a href="category.html"><i class="bi bi-chevron-right"></i> Culture</a></li>
          <li><a href="category.html"><i class="bi bi-chevron-right"></i> Sport</a></li>
          <li><a href="category.html"><i class="bi bi-chevron-right"></i> Food</a></li>
          <li><a href="category.html"><i class="bi bi-chevron-right"></i> Politics</a></li>
          <li><a href="category.html"><i class="bi bi-chevron-right"></i> Celebrity</a></li>
          <li><a href="category.html"><i class="bi bi-chevron-right"></i> Startups</a></li>
          <li><a href="category.html"><i class="bi bi-chevron-right"></i> Travel</a></li>

        </ul>
      </div>

      <!-- <div class="col-lg-4">
        <h3 class="footer-heading">Recent Posts</h3>

        <ul class="footer-links footer-blog-entry list-unstyled">
          <li>
            <a href="single-post.html" class="d-flex align-items-center">
              <img src="assets/img/post-sq-1.jpg" alt="" class="img-fluid me-3">
              <div>
                <div class="post-meta d-block"><span class="date">Culture</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                <span>5 Great Startup Tips for Female Founders</span>
              </div>
            </a>
          </li>

          <li>
            <a href="single-post.html" class="d-flex align-items-center">
              <img src="assets/img/post-sq-2.jpg" alt="" class="img-fluid me-3">
              <div>
                <div class="post-meta d-block"><span class="date">Culture</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                <span>What is the son of Football Coach John Gruden, Deuce Gruden doing Now?</span>
              </div>
            </a>
          </li>

          <li>
            <a href="single-post.html" class="d-flex align-items-center">
              <img src="assets/img/post-sq-3.jpg" alt="" class="img-fluid me-3">
              <div>
                <div class="post-meta d-block"><span class="date">Culture</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                <span>Life Insurance And Pregnancy: A Working Mom’s Guide</span>
              </div>
            </a>
          </li>

          <li>
            <a href="single-post.html" class="d-flex align-items-center">
              <img src="assets/img/post-sq-4.jpg" alt="" class="img-fluid me-3">
              <div>
                <div class="post-meta d-block"><span class="date">Culture</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                <span>How to Avoid Distraction and Stay Focused During Video Calls?</span>
              </div>
            </a>
          </li>

        </ul>

      </div> -->
    </div>
  </div>
</div>

<div class="footer-legal bg-secondary mt-3 p-3">
  <div class="container">

    <div class="row justify-content-between ">
      <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
        <div class="copyright text-white ">
            <?= Setting::copyRight()->content ?>
        </div>
      </div>

    </div>

  </div>
</div>

</footer>