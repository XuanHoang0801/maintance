<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
use frontend\assets\BackendAsset;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\BaseUrl;

$backend = BackendAsset::register($this);


$this->title = 'Thông tin';
?>

<section class="section profile mt-5 mb-5">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <!-- <img src="<?= $backend->baseUrl?>/<?= $model->avt ?>" alt="Profile" class="rounded-circle"> -->
              <img src="<?= $backend->baseUrl?>/<?= $model->avt ?>" alt="Profile" class="rounded-circle">
              <h2><?= $model->username ?></h2>
              <h3><?=$model->fullname?></h3>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered" role="tablist">

                <li class="nav-item" role="presentation">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview" aria-selected="true" role="tab"><?= $this->title ?></button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview" role="tabpanel">
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Tên đăng nhập</div>
                    <div class="col-lg-9 col-md-8"><?= $model->username ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?= $model->email ?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Họ tên</div>
                    <div class="col-lg-9 col-md-8"><?= $model->fullname ?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Ngày sinh</div>
                    <div class="col-lg-9 col-md-8"><?= $model->birthday ?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Giới tính</div>
                    <div class="col-lg-9 col-md-8"><?= $model->gender ?></div>
                  </div>

                </div>
            </div><!-- End Bordered Tabs -->
            
        </div>
    </div>
    <p>
        <?= Html::a(Yii::t('app', 'Cập nhật thông tin'), ['update'], ['class' => 'btn btn-success mt-3']) ?>
    </p>

        </div>
      </div>
    </section>
