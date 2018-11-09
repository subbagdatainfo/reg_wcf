<?php

namespace app\widget;

use Yii;
use yii\web\View;
use app\widget\AssetBundle;

class GaleryAssets extends AssetBundle
{
    public function init()
    {
        $this->setSourcePath('@app/widget/assets/galery/');

        $this->setupAssets('css', [
            'nanogallery.min',
        ]);

        $this->setupAssets('js', [
            'jquery.min',
            'jquery.nanogallery.min'
        ]);

        parent::init();
    }
}