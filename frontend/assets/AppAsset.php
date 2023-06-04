<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        // 'css/site.css',
        'css/bootstrap.min.css',
        'css/owl.carousel.min.css',
        'css/ticker-style.css',
        'css/flaticon.css',
        'css/slicknav.css',
        'css/animate.min.css',
        'css/magnific-popup.css',
        'css/fontawesome-all.min.css',
        'css/themify-icons.css',
        'css/slick.css',
        'css/nice-select.css',
        'css/style.css'
    ];
    public $js = [
        // 'js/vendor/modernizr-3.5.0.min.js',
        // 'js/vendor/jquery-1.12.4.min.js',
        // 'js/popper.min.js',
        'js/bootstrap.min.js',
        // 'js/jquery.slicknav.min.js',
        // 'js/owl.carousel.min.js',
        // 'js/slick.min.js',
        // 'js/gijgo.min.js',
        // 'js/wow.min.js',
        // 'js/animated.headline.js',
        // 'js/jquery.magnific-popup.js',
        // 'js/jquery.ticker.js',
        'js/main.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}
